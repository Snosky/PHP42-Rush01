<?php
namespace Controller;

abstract class Controller
{
    private $flash_message = array();

    protected function redirect($url = '')
    {
        $url = WEBROOT.$url;
        header('Location:'.$url);
        die();
    }

    protected function render($filename, $vars = array())
    {
        $vars['flash_message'] = $this->flash_message;
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
        $modelName = 'Model\\'.$modelName;
        $this->$modelName = new $modelName;
    }

    protected function addFlashMessage($type, $message)
    {
        $this->flash_message[$type][] = $message;
    }


    abstract public function homeAction();
}
