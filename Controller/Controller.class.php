<?php
namespace Controller;

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


    abstract public function homeAction();
}
