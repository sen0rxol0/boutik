<?php

Namespace App;

use \PDO;

class Database {

    private $pdo;
    private $db_host;
    private $db_port;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $pdo_options;

    public function __construct($connection) {

        extract($connection);

        $this->db_host = $host ?? 'localhost';
        $this->db_port = $port ?? '3306';
        $this->db_name = $name ?? '';
        $this->db_user = $user ?? 'root';
        $this->db_pass = $password ?? '';

        $this->pdo_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];
    }

    private function instantiatePDO() {
        if (!$this->pdo) {
            $db= "mysql:host={$this->db_host};port={$this->db_port};dbname={$this->db_name}";

            $pdo = new PDO($db, $this->db_user, $this->db_pass, $this->pdo_options);
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }

    // private function fettch

    public function select($statement = '') {
        if (!empty($statement)) {
            $req = $this->instantiatePDO()->prepare($statement);
            $req->execute();
            $res = $req->fetchAll();
            return $res;
        }
    }

    public function insert($statement = '') {

    }

    public function update($statement = '') {

    }

    public function delete($statement = '') {

    }
}