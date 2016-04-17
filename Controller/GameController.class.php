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

        // Si le mec est pas deja dans la game et qu'un pwd est requis
        if (!$gameModel->userInGame($this->getActualUser(), $game) && $game->getPassword())
        {
            $this->addFlashMessage('success', 'A password is required to join this game.');
            return $this->render('game_password', array(
                'game'  => $game,
            ));
        }

        if ($gameModel->userAlreadyPlay($this->getActualUser(), $game))
        {
            $this->addFlashMessage('error', 'You already playing in another game.');
            $this->redirect();
        }
        
        if ($game->getPassword() && $_POST)
        {
            if (!isset($_POST['password']) || empty($_POST['password']) || $_POST['password'] != $game->getPassword())
            {
                $this->addFlashMessage('error', 'Wrong password.');
                $this->redirect('game/join/'.$game->getId());
            }
        }
        
        if (!$gameModel->userInGame($this->getActualUser(), $game))
            $gameModel->addPlayer($game, $this->getActualUser());

        $this->render('game', array(
            'game'  => $game,
        ));
    }
}