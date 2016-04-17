<?php
namespace Domain;

class User implements \JsonSerializable
{
    /**
     * @var integer
     * User ID
     */
    private $_id;

    /**
     * @var string
     * User username
     */
    private $_username;

    /**
     * @var string
     * User email
     */
    private $_email;

    /**
     * @var string
     * User password
     */
    private $_password;

    /**
     * @var string
     * User salt
     */
    private $_salt;

    /**
     * @var string
     * User role
     */
    private $_role;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->_salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->_salt = $salt;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }

    /**
     * @param $raw_password
     * @return bool
     * Test a password with actual user password
     */
    public function testPassword($raw_password)
    {
        $password = hash('whirlpool', $raw_password.$this->getSalt());
        if ($password === $this->getPassword())
            return true;
        return false;

    }

    /**
     * @param $raw_password
     * Hash and save user password
     */
    public function hashPassword($raw_password)
    {
        if (!$this->getSalt())
            $this->setSalt(substr(sha1(time()), 1, 35));
        $this->setPassword(hash('whirlpool', $raw_password.$this->getSalt()));
    }

    public function jsonSerialize()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['username'] = $this->getUsername();
        return $data;
    }
}
