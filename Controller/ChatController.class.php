<?php
namespace Controller;

use Domain\ChatMessage;
use Model\ChatModel;

class ChatController extends Controller
{
    public function homeAction($chat_id = 0)
    {
        $chatModel = new ChatModel();
        $chatMessages = $chatModel->findByGame($chat_id);

        $this->render('chat', array(
            'chat_id'        => $chat_id,
            'chatMessages'   => $chatMessages,
        ), NULL);
    }

    public function addMessageAction()
    {
        if (!$this->isConnected())
        {
            $this->addFlashMessage('error', 'You need to be connected.');
            $this->redirect();
        }

        $form_is_valid = FALSE;
        if ($_POST)
        {
            $form_is_valid = TRUE;
            if (!isset($_POST['content']) || empty($_POST['content']))
            {
                $this->addFlashMessage('error', 'The message can\'t be empty.');
                $form_is_valid = FALSE;
            }

            if ($form_is_valid)
            {
                $message = new ChatMessage();
                $message->setContent($_POST['content']);
                $message->setUser($this->getActualUser());
                $chat_id = (int)$_POST['chat_id'];
                if ($_POST['chat_id'] == 0)
                    $chat_id = NULL;
                $message->setChatId($chat_id);
                $chatModel = new ChatModel();
                $chatModel->save($message);
                $this->addFlashMessage('success', 'Message envoye');
                $this->redirect('chat/home/'.$chat_id);
            }
        }

        $this->render(NULL, array(
            'form_is_valid' => $form_is_valid,
        ));
    }

    public function getMessagesAction($chat_id = NULL)
    {
        $chatModel = new ChatModel();
        $messages = $chatModel->findByGame($chat_id);

        $this->render(NULL, array(
            'chatMessages'  => $messages,
        ));
    }
}