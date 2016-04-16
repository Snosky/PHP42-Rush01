<?php
namespace Controller;

use Domain\Game;
use Model\GameModel;
use Model\UserModel;

class GameController extends Controller
{
    public function homeAction()
    {
        // TODO: Implement homeAction() method.
    }
    
    public function createAction()
    {
        if (!$this->isConnected())
        {
            $this->addFlashMessage('error', 'Vous devez etre connecte pour cree une partie.');
            $this->redirect('user');
        }

        // Models
        $gameModel = new GameModel();

        $game = new Game();

        if ($_POST)
        {
            if (isset($_POST['password']))
                $game->setPassword($_POST['password']);

            $user = $this->getActualUser();
            $game->setAdmin($user);
            $gameModel->save($game);
            $this->addFlashMessage('success', 'Partie creee.');
            $this->redirect('game/join/'.$game->getId());
        }

        $this->render('create_game', array(
            'gameForm'  => $game,
        ));
    }

    public function joinAction($game_id)
    {
        if (!$this->isConnected())
        {
            $this->addFlashMessage('error', 'Vous devez etre connecte pour rejoindre une partie.');
            $this->redirect('user');
        }

        // Models
        $gameModel = new GameModel();

        $game = $gameModel->findById($game_id);
        if (!$game) // If game doesn't exist
        {
            $this->addFlashMessage('error', 'Cette partie n\'existe pas.');
            $this->redirect();
        }

        $this->render('game', array(
            'game'  => $game,
        ));
    }
}