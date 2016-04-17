<?php
namespace Controller;

use Model\ChatModel;

class HomeController extends Controller
{
    public function homeAction()
    {
        $chatModel = new ChatModel();
        $chatMessages = $chatModel->findByGame(NULL);

        $this->render('home', array(
            'chatMessages'   => $chatMessages,
        ));
    }

    public function loreAction()
    {
        $this->render('lore');
    }
}