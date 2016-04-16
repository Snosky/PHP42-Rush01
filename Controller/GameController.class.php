<?php
namespace Controller;

use Domain\Game;
use Model\GameModel;
use Model\UserModel;

class GameController extends Controller
{
    public function homeAction()
    {
        $gameModel = new GameModel();
        $games = $gameModel->findAll();

        $this->render('game_home', array(
            'games' => $games,
        ));
    }
    
    public function createAction()
    {
        if (!$this->isConnected())
        {
            $this->addFlashMessage('error', 'You need to be connected to access to this page.');
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
            $this->addFlashMessage('success', 'Game created.');
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
            $this->addFlashMessage('error', 'You need to be connected to access to this page.');
            $this->redirect('user');
        }

        // Models
        $gameModel = new GameModel();

        $game = $gameModel->findById($game_id);
        if (!$game) // If game doesn't exist
        {
            $this->addFlashMessage('error', 'This game doesn\'t exist.');
            $this->redirect();
        }

        if (count($game->getPlayers()) == 3) // If game is full 1 admin + 3 players
        {
            $this->addFlashMessage('error', 'This game is full.');
            $this->redirect();
        }

        $user = $this->getActualUser();
        if (!key_exists($user->getId(), $game->getPlayers()) && $game->getAdmin()->getId() != $user->getId()) // If new player
        {
            //$game->addPlayer($user);
            $gameModel->addPlayer($game, $user);
        }

        $this->render('game', array(
            'game'  => $game,
        ));
    }
}