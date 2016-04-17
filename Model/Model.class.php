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
            $this->db = new \PDO('mysql:host=e2r7p13.42.fr:3307;dbname=snosky_rush01', 'root', 'root');
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