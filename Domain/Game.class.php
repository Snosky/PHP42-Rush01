<?php
namespace Domain;

class Game implements \JsonSerializable
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
     * @var array User
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
        $this->players[$player->getId()] = $player;
    }

    /**
     * @return array User
     */
    public function getPlayers()
    {
        return $this->players;
    }
    public function jsonSerialize() {
        $array = array();
        $array['id'] = $this->id;
        $array['password'] = $this->password;
        $array['admin'] = $this->admin;
        $array['player'] = $this->players;
        return $array;
    }
}