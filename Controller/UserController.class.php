<?php
namespace Controller;

use Domain\User;
use Model\UserModel;

class UserController extends Controller
{
    public function homeAction()
    {
        if ($this->isConnected())
        {
            $this->addFlashMessage('error', 'You are already logged.');
            $this->redirect();
        }
        
        $userModel = new UserModel();

        $user = new User();
        $user->setEmail('');
        $user->setUsername('');

        if ($_POST && isset($_POST['login']))
        {

            $user = $userModel->findByUsername($_POST['name']);
            if ($user && $user->testPassword($_POST['password']))
            {
                $this->addFlashMessage('success', 'You are logged as '.$user->getUsername());
                $this->connectUser($user);
                $this->redirect();
            }
            else
                $this->addFlashMessage('error', 'Username and Password doesn\'t match.');
        }
        else if ($_POST && isset($_POST['register']))
        {
            $form_is_valid = TRUE;

            if (!isset($_POST['name']) || empty($_POST['name']) || !preg_match('/^[a-z0-9 -\@_]{3,45}$/i', $_POST['name']))
            {
                $this->addFlashMessage('error', 'Username must be alpha-numeric and contain between 3 and 45 characters.');
                $form_is_valid = FALSE;
            }

            if ($userModel->findByUsername($_POST['name']))
            {
                $this->addFlashMessage('error', 'Username already taken.');
                $form_is_valid = FALSE;
            }

            if (!isset($_POST['password']) || empty($_POST['password']) || $_POST['password'] != $_POST['password-check'])
            {
                $this->addFlashMessage('error', 'Passwords doesn\'t match.');
                $form_is_valid = FALSE;
            }

            if (!isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] != $_POST['email-check'])
            {
                $this->addFlashMessage('error', 'E-mails doesn\'t match or are invalids.');
                $form_is_valid = FALSE;
            }

            if ($userModel->findByEmail($_POST['email']))
            {
                $this->addFlashMessage('error', 'E-mail is already taken.');
                $form_is_valid = FALSE;
            }

            $user->setUsername($_POST['name']);
            $user->setEmail($_POST['email']);

            if ($form_is_valid)
            {
                $this->addFlashMessage('success', 'Vous etes inscrit mais pas encore en bdd :)');
                $user->hashPassword($_POST['password']);
                $user->setRole('ROLE_USER');
                $userModel->save($user);
            }
        }

        $this->render('index_form', array(
            'userForm'  => $user,
        ));
    }

    public function disconnectAction()
    {
        $this->disconnectUser();
        $this->addFlashMessage('error', 'You\'re disconnected.');
        $this->redirect();
    }

}
