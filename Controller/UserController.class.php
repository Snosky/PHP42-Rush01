<?php
namespace Controller;

class UserController extends Controller
{
    public function homeAction()
    {
        $this->render('index_form');
    }
}
