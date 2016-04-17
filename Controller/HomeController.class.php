<?php
namespace Controller;

use Model\ChatModel;

class HomeController extends Controller
{
    public function homeAction()
    {
        $this->render('home');
    }

    public function loreAction()
    {
        $this->render('lore');
    }
}