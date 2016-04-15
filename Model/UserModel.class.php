<?php
namespace Model;

use Domain\User;

class UserModel extends Model
{
    public function save ( User $user )
    {
        if ($user->getId())
        {
            $sql = 'UPDATE t_user 
                    SET usr_username=:username,
                        usr_email=:email,
                        usr_password=:password,
                        usr_salt=:salt,
                        usr_role=:role
                    WHERE usr_id=:userid';
            $row = $this->getDb()->prepare($sql);
            $row->bindValue(':userid', $user->getId(), \PDO::PARAM_INT);
        }
        else
        {
            $sql = 'INSERT INTO t_user (usr_username, usr_email, usr_password, usr_salt, usr_role) 
                VALUES (:username, :email, :password, :salt, :role)';
            $row = $this->getDb()->prepare($sql);
        }
        $row->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $row->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $row->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $row->bindValue(':salt', $user->getSalt(), \PDO::PARAM_STR);
        $row->bindValue(':role', $user->getRole(), \PDO::PARAM_STR);
        $row->execute();
    }

    public function delete ( User $user )
    {
        $id = $user->getId();
        $sql = 'DELETE *
                FROM t_user
                WHERE usr_id=:id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':id', $id, \PDO::PARAM_INT);
        $row->execute();
    }


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

    public function findAll()
    {
        $sql = 'SELECT * FROM t_user';
        $data = $this->getDb()->query($sql);

        $return = array();
        foreach ($data as $row)
            $return[$row['usr_id']] = $this->buildDomainObject($row);
        return $return;
    }

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