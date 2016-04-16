<?php
namespace Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
        $this->loadModel('UserModel');
        $this->render('home');
    }
}