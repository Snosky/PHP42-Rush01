<?php

namespace Model;


use Domain\Game;
use Domain\User;

class GameModel extends Model
{
    public function addPlayer (Game $game, User $user)
    {
        $sql = 'INSERT INTO t_game_has_t_user (game_id, usr_id)
                VALUES (:game_id, :usr_id)';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':game_id', $game->getId(), \PDO::PARAM_INT);
        $row->bindValue(':usr_id', $user->getId(), \PDO::PARAM_INT);
        $row->execute();
    }
    
    public function removePlayer (Game $game, User $user)
    {
        $sql = 'DELETE *
                FROM t_game
                WHERE game_id=:game_id
                    AND usr_id=:usr_id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':game_id', $game->getId(), \PDO::PARAM_INT);
        $row->bindValue(':usr_id', $user->getId(), \PDO::PARAM_INT);
        $row->execute();
    }
    
    /**
     * @param Game $game
     * Adds or Updates game in Database
     */
    public function save ( Game $game )
    {
        if ($game->getId())
            $this->update($game);
        else
            $this->add($game);
    }

    private function update (Game $game)
    {
        $sql = 'UPDATE t_game
                SET game_password=:pwd,
                    usr_id=:admin
                WHERE game_id=:game_id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':game_id', $game->getId() , \PDO::PARAM_INT);
        $row->bindValue(':pwd', $game->getPassword(), \PDO::PARAM_STR);
        $row->bindValue(':admin', $game->getAdmin()->getId() , \PDO::PARAM_INT);
        $row->execute();
    }

    private function add (Game $game)
    {
        $sql = 'INSERT INTO t_game (game_password, usr_id) 
                VALUES (:pwd, :admin)';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':pwd', $game->getPassword(), \PDO::PARAM_STR);
        $row->bindValue(':admin', $game->getAdmin()->getId() , \PDO::PARAM_INT);
        $row->execute();
        $id = $this->getDb()->lastInsertId();
        $game->setId($id);
    }



    /**
     * @param Game $game
     * Removes game from Database
     */
    public function delete ( Game $game )
    {
        $id = $game->getId();
        $sql = 'DELETE *
                FROM t_game
                WHERE game_id=:id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':id', $id, \   PDO::PARAM_INT);
        $row->execute();
    }

    /**
     * @param $admin
     * @return bool|Game
     * Search Database for a game with given admin
     */
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

    /**
     * @param $id
     * @return bool|Game
     * Search Database for a game with given id
     */
    public function findById( $id )
    {
        $sql = 'SELECT t_game.*, GROUP_CONCAT(CONVERT(t_join.usr_id, CHAR(8))) as players_id
                FROM t_game
                JOIN t_game_has_t_user
                  AS t_join ON t_join.game_id = t_game.game_id
                WHERE t_game.game_id = 1
                GROUP BY game_id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':id', $id, \PDO::PARAM_INT);
        $row->execute();
        $row = $row->fetch();

        if ($row)
            return $this->buildDomainObject($row);
        else
            return false;
    }

    /**
     * @return array
     * Returns all games in Database
     */
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

    /**
     * @param $row
     * @return Game
     * Creates new PHP Object 'game' from a given Database entry
     */
    protected function buildDomainObject($row)
    {
        $game = new Game();
        $game->setId($row['game_id']);
        $game->setPassword($row['game_password']);
        $userModel = new UserModel();
        $user = $userModel->findById($row['usr_id']);
        $game->setAdmin($user);
        if (array_key_exists('players_id', $row))
        {
            $list = explode(',', $row['players_id']);
            foreach ($list AS $user)
            {
                $user = $userModel->findById($user);
                $game->addPlayer($user);
            }
        }
        return $game;
    }

}