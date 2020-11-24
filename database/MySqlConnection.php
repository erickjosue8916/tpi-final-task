<?php

class MySqlConnection extends Connection
{
  public $db;

  public function __construct()
  {
    parent::__construct(DB_USER, DB_HOST, DB_DATABASE, DB_PASSWORD);
    return $this->connect();
  }

  public function connect()
  {
    try {
      $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE,DB_USER,DB_PASSWORD);//Prepara la sentencia
      $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//Le asigna un atributo
      $this->db->exec("SET CHARACTER SET " . DB_CHARSET);//Ejecuta la sentencia
      return $this->db;//retorna la coneccion si fue exitosa
    } catch (\Throwable $th) {
      print "ERROR! " . $th->getMessage() . "<br>";//Si ocurrio un error imprime cual fue
      die();
    }
  }

  public function disconnect()
  {
  }
}
