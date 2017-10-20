<?php

Namespace App;

class Database {

    private $db_host;
    private $db_port;
    private $db_name;
    private $db_user;
    private $db_pass;

    public function __construct() {
        global $config;
        $this->db_host = $config['db_host'];
        $this->db_port = $config['db_port'];
        $this->db_name = $config['db_name'];
        $this->db_user = $config['db_user'];
        $this->db_pass = $config['db_pass'];
    }
}