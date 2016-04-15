<?php
namespace Model;

use Controller\HomeController;

class UserModel
{
    public function findAll()
    {
        $sql = 'SELECT * FROM t_user';
        $this->getDb()->fetchAll($sql);
    }

}