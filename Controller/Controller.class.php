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
        $this->$modelName = new $modelName;
    }

    abstract public function homeAction();
}
