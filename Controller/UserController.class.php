<?php
namespace Controller;

class UserController extends Controller
{
    public function homeAction()
    {
        $this->loadModel('UserModel');

        /*
         * Connexion user
         * @var Model\UserModel $this->UserModel
         */
        if ($_POST && isset($_POST['login']))
        {

            $user = $this->UserModel->findByUsername($_POST['name']);
            if ($user && $user->testPassword($_POST['password']))
            {
                $this->addFlashMessage('success', 'Vous etes bien connecte en tant que '.$user->getUsername());
                $this->redirect();
            }
            else
                $this->addFlashMessage('errro', 'Le nom d\'utilisateur et le mot de passe ne correspondent pas.');
        }

        $this->render('index_form');
    }
}
