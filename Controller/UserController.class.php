<?php
namespace Controller;

use Domain\User;

class UserController extends Controller
{
    public function homeAction()
    {
        $this->loadModel('UserModel');

        $user = new User();

        if ($_POST && isset($_POST['login']))
        {

            $user = $this->UserModel->findByUsername($_POST['name']);
            if ($user && $user->testPassword($_POST['password']))
            {
                $this->addFlashMessage('success', 'Vous etes bien connecte en tant que '.$user->getUsername());
                // TODO : Connect user;
                $this->redirect();
            }
            else
                $this->addFlashMessage('error', 'Le nom d\'utilisateur et le mot de passe ne correspondent pas.');
        }
        else if ($_POST && isset($_POST['register']))
        {
            $form_is_valid = TRUE;

            if (!isset($_POST['name']) || empty($_POST['name']) || !preg_match('/^[a-z0-9 -\@_]{3,45}$/i', $_POST['name']))
            {
                $this->addFlashMessage('error', 'Le nom d\'utilisateur doit etre alpha-numeric et contenir entre 3 et 45 caracteres.');
                $form_is_valid = FALSE;
            }

            if ($this->UserModel->findByUsername($_POST['username']))
            {
                $this->addFlashMessage('error', 'Le nom d\'utilisateur est deja utilise.');
                $form_is_valid = FALSE;
            }

            if (!isset($_POST['password']) || empty($_POST['password']) || $_POST['password'] != $_POST['password-check'])
            {
                $this->addFlashMessage('error', 'Les mots de passe ne correspondent pas.');
                $form_is_valid = FALSE;
            }

            if (!isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] != $_POST['email-check'])
            {
                $this->addFlashMessage('error', 'Les adresses e-mail ne correspondent pas ou ne sont pas valides.');
                $form_is_valid = FALSE;
            }

            if ($this->UserModel->findByEmail($_POST['email']))
            {
                $this->addFlashMessage('error', 'L\'adresse email est deja utilise.');
                $form_is_valid = FALSE;
            }

            $user->setUsername($_POST['name']);
            $user->setEmail($_POST['email']);

            if ($form_is_valid)
            {
                $this->addFlashMessage('success', 'Vous etes inscrit mais pas encore en bdd :)');
                $user->hashPassword($_POST['password']);
                $user->setRole('ROLE_USER');
                $this->UserModel->save($user);
            }
        }

        $this->render('index_form', array(
            'userForm'  => $user,
        ));
    }
}
