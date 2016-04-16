<?php

namespace Model;


use Domain\Game;

class GameModel extends Model
{

    public function save ( Game $game )
    {
        if ($game->getId())
        {
            $sql = 'UPDATE t_game
                    SET game_password=:pwd,
                        usr_id=:admin
                    WHERE game_id=:game_id';
            $row = $this->getDb()->prepare($sql);
            $row->bindValue(':game_id', $game->getId() , \PDO::PARAM_INT);
        }
        else
        {
            $sql = 'INSERT INTO t_game (game_password, usr_id) 
                    VALUES (:pwd, :admin)';
            $row = $this->getDb()->prepare($sql);
        }
        $row->bindValue(':pwd', $game->getPassword(), \PDO::PARAM_STR);
        $row->bindValue(':admin', $game->getAdmin() , \PDO::PARAM_INT);
        $row->execute();
    }

    public function findByAdmin( $admin )
    {
        $sql = 'SELECT *
                FROM t_game
                WHERE usr_id=:admin';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':admin', $admin, \PDO::PARAM_STR);
        $row->execute();
        $row = $row->fetch();

        if ($row)
            return $this->buildDomainObject($row);
        else
            return false;
    }

    public function findById( $id )
    {
        $sql = 'SELECT *
                FROM t_game
                WHERE game_id=:id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':id', $id, \PDO::PARAM_INT);
        $row->execute();
        $row = $row->fetch();

        if ($row)
            return $this->buildDomainObject($row);
        else
            return false;
    }

    public function findAll()
    {
        $sql = 'SELECT *
                FROM t_game';
        $data = $this->getDb()->query($sql);

        $return = array ();
        foreach ($data as $row)
            $return[$row['game_id']] = $this->buildDomainObject($row);
        return $return;
    }

    protected function buildDomainObject($row)
    {
        $game = new Game();
        $game->setId($row['game_id']);
        $game->setPassword($row['game_password']);
        $userModel = new UserModel();
        $user = $userModel->findById($row['usr_id']);
        $game->setAdmin($user);
        return $game;
    }



















}