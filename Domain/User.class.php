<?php
namespace Domain;

class User
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
}
