<?php
namespace Model;

use Domain\User;

class UserModel extends Model
{
    /**
     * @param User $user
     * Adds or Updates user in Database
     */
    public function save (User $user)
    {
        if ($user->getId())
            $this->update($user);
        else
            $this->add($user);
    }

    private function update (User $user)
    {
        $sql = 'UPDATE t_user 
                SET usr_username=:username,
                    usr_email=:email,
                    usr_password=:pwd,
                    usr_salt=:salt,
                    usr_role=:role
                WHERE usr_id=:userid';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':userid', $user->getId(), \PDO::PARAM_INT);
        $row->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $row->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $row->bindValue(':pwd', $user->getPassword(), \PDO::PARAM_STR);
        $row->bindValue(':salt', $user->getSalt(), \PDO::PARAM_STR);
        $row->bindValue(':role', $user->getRole(), \PDO::PARAM_STR);
        $row->execute();
    }

    private function add (User $user)
    {
        $sql = 'INSERT INTO t_user (usr_username, usr_email, usr_password, usr_salt, usr_role) 
                    VALUES (:username, :email, :pwd, :salt, :role)';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $row->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $row->bindValue(':pwd', $user->getPassword(), \PDO::PARAM_STR);
        $row->bindValue(':salt', $user->getSalt(), \PDO::PARAM_STR);
        $row->bindValue(':role', $user->getRole(), \PDO::PARAM_STR);
        $row->execute();
        $id = $this->getDb()->lastInsertId();
        $user->setId($id);
    }

    /**
     * @param User $user
     * Removes user from Database
     */
    public function delete (User $user)
    {
        $id = $user->getId();
        $sql = 'DELETE *
                FROM t_user
                WHERE usr_id=:id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':id', $id, \   PDO::PARAM_INT);
        $row->execute();
    }

    /**
     * @param $id
     * @return bool|User
     * Search Database for a user with given id
     */
    public function findById ($id)
    {
        $sql = 'SELECT *
                FROM t_user
                WHERE usr_id=:id';
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
     * @param $username
     * @return bool|User
     * Search Database for a user with given username
     */
    public function findByUsername ($username)
    {
        $sql = 'SELECT *
                FROM t_user
                WHERE usr_username=:username';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':username', $username, \PDO::PARAM_STR);
        $row->execute();
        $row = $row->fetch();

        if ($row)
            return $this->buildDomainObject($row);
        else 
            return false;
    }

    /**
     * @param $email
     * @return bool|User
     * Search Database for a user with given email
     */
    public function findByEmail ($email)
    {
        $sql = 'SELECT *
                FROM t_user
                WHERE usr_email=:email';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':email', $email, \PDO::PARAM_STR);
        $row->execute();
        $row = $row->fetch();

        if ($row)
            return $this->buildDomainObject($row);
        else
            return false;
    }

    /**
     * @return array
     * Returns all users in Database
     */
    public function findAll()
    {
        $sql = 'SELECT *
                FROM t_user';
        $data = $this->getDb()->query($sql);

        $return = array();
        foreach ($data as $row)
            $return[$row['usr_id']] = $this->buildDomainObject($row);
        return $return;
    }


    /**
     * @param $row
     * @return User
     * Creates new PHP Object 'User' from a given Database entry
     */
    protected function buildDomainObject($row)
    {
        $user = new User();
        $user->setId($row['usr_id']);
        $user->setUsername($row['usr_username']);
        $user->setEmail($row['usr_email']);
        $user->setPassword($row['usr_password']);
        $user->setSalt($row['usr_salt']);
        $user->setRole($row['usr_role']);
        return $user;
    }
}