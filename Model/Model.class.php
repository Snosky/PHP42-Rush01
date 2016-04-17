<?php
namespace Model;

use Domain\User;

abstract class Model
{
    /**
     * @var \PDO
     */
    private $db;

    public function __construct()
    {
        try
        {
            $this->db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e)
        {
            echo 'Erreur SQL : '.$e.PHP_EOL;
            die();
        }
    }

    /**
     * @return \PDO
     */
    protected function getDb()
    {
        return $this->db;
    }

    abstract protected function buildDomainObject($row);
}