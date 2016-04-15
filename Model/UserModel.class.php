<?php
namespace Model;

use Controller\HomeController;

class UserModel extends Model
{
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