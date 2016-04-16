<?php
namespace Controller;

use Domain\User;
use Model\UserModel;

abstract class Controller
{

    protected function redirect($url = '')
    {
        if ($this->isAjax())
            $this->render(NULL);
        else
        {
            $url = WEBROOT . $url;
            header('Location:' . $url);
            die();
        }
    }

    protected function render($filename, $vars = array())
    {
        $vars['flash_message'] = $_SESSION['flash_message'];
        $vars['isConnected'] = $this->isConnected();
        $vars['user'] = $this->getActualUser();
        unset($_SESSION['flash_message']);

        if ($this->isAjax())
        {
            echo json_encode($vars);
            die();
        }
        else
        {
            extract($vars);
            ob_start();
            $filename = ROOT . 'view' . DS . $filename . '.html.php';
            if (file_exists($filename))
                include $filename;
            $content_for_layout = ob_get_clean();
            include(ROOT . 'view' . DS . 'layout.html.php');
        }
    }

    protected function loadModel($modelName)
    {
        $model = 'Model\\'.$modelName;
        $this->$modelName = new $model;
    }

    protected function addFlashMessage($type, $message)
    {
        $_SESSION['flash_message'][$type][] = $message;
    }

    protected function connectUser(User $user)
    {
        $_SESSION['user']['name'] = $user->getUsername();
        $_SESSION['user']['id'] = $user->getId();
    }

    protected function disconnectUser()
    {
        unset($_SESSION['user']);
    }


    protected function isConnected()
    {
        return (!empty($_SESSION['user']));
    }

    protected function getActualUser()
    {
        if ($this->isConnected())
        {
            $userModel = new UserModel();
            return $userModel->findById($_SESSION['user']['id']);
        }
        return NULL;
    }

    protected function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']));
    }


    abstract public function homeAction();
}   