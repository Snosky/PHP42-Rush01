<?php
namespace Model;

use Controller\HomeController;

class UserModel extends Model
{
    public function findAll()
    {
        $sql = 'SELECT * FROM t_user';
    }

}