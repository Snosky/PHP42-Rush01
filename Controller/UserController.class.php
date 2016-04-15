<?php
namespace Controller;

class UserController extends Controller
{
    public function homeAction()
    {
        $this->loadModel('UserModel');

        $this->render('index_form');
    }
}
