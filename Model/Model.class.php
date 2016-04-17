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
            $this->db = new \PDO('mysql:host=mysql-kethbad.alwaysdata.net;dbname=kethbad_rush01', 'kethbad_42', 'i_am_42');
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