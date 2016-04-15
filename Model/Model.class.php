<?php
namespace Model;

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
            $this->db = new \PDO('mysql:host=mysql1.alwaysdata.com;dbname=snosky_rush01', 'snosky_42', 'i_am_42');
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

}
