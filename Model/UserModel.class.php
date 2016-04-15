<?php
namespace Model;

use Domain\User;

class UserModel extends Model
{
    public function save ( User $user )
    {

    }

    public function delete ( User $user)
    {
        
    }


    public function findById ($id)
    {
        $sql = 'SELECT *
                FROM t_user
                WHERE usr_id=:id';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':id', $id, \PDO::PARAM_INT);
        $row = $row->execute();

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
        $row = $row->execute();
        
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
        $row->bindValue(':email', $emai, \PDO::PARAM_STR);
        $row = $row->execute();

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