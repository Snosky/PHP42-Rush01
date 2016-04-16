<?php
namespace Domain;

class Game
{
    /**
     * @var integer
     * Game ID
     */
    private $id;

    /**
     * @var string
     * Game Password
     */
    private $password;

    /**
     * @var User
     * Game Password
     */
    private $admin;

    /**
     * @var User array
     * All players != admin
     */
    private $players = array();

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return User
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param User $admin
     */
    public function setAdmin(User $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @param User $player
     */
    public function addPlayer(User $player)
    {
        $this->players[] = $player;
    }

    /**
     * @return User array
     */
    public function getPlayers()
    {
        return $this->players;
    }
}