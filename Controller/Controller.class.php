<?php
namespace Controller;

use Model\UserModel;

abstract class Controller
{

    protected function redirect($url = '')
    {
        $url = WEBROOT.$url;
        header('Location:'.$url);
        die();
    }

    protected function render($filename, $vars = array())
    {
        $vars['flash_message'] = $_SESSION['flash_message'];
        $vars['isConnected'] = $this->isConnected();
        unset($_SESSION['flash_message']);
        extract($vars);
        ob_start();
        $filename = ROOT.'view'.DS.$filename.'.html.php';
        if (file_exists($filename))
            include $filename;
        $content_for_layout = ob_get_clean();
        include (ROOT.'view'.DS.'layout.html.php');
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

    protected function isConnected()
    {
        return (!empty($_SESSION['user']));
    }

    protected function getActualUser()
    {
        $userModel = new UserModel();
        return $userModel->findById($_SESSION['user']['id']);
    }

    abstract public function homeAction();
}