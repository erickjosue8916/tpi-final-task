<?php
abstract class Connection {
    protected $user;
    protected $host;
    protected $database;
    protected $password;
    protected $connection;

    public function __construct ($user, $host, $database, $password) {
        $this->user = $user;
        $this->host = $host;
        $this->database = $database;
        $this->password = $password;
    }
    public function getConnection () {
        return $this->connection;
    }
    abstract public function connect () ;
    abstract public function disconnect () ;
}