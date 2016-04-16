<?php
namespace Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
        $this->loadModel('UserModel');

        echo '<pre>';
        print_r($this->UserModel->findAll());
        $this->render('home');
    }
}