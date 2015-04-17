<?php


namespace App;

use \PDO;


class Database
{

    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $pdo;


    public function __construct($db_name, $db_host = 'localhost', $db_user = 'christina', $db_pass = 'systeme88')
    {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    private function getPDO()
    {
        if ($this->pdo === null) {
            // Connect to DB and display errors
            $pdo = new PDO('mysql:dbname=blog;host=localhost', 'christina', 'systeme88');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }

        return $this->pdo;


    }

    public function query($statement, $class_name)
    {
        $query = $this->getPDO()->query($statement);
        $datas = $query->fetchAll(PDO::FETCH_CLASS, $class_name);
        return $datas;
    }

    public function prepare($statement, $attributes, $class_name, $one = false)
    {
        $query = $this->getPDO()->prepare($statement);
        $query->execute($attributes);
        $query->setFetchMode(PDO::FETCH_CLASS, $class_name);

        if ($one) {
            $datas = $query->fetch();
        } else {
            $datas = $query->fetchAll();
        }

        return $datas;
    }
}