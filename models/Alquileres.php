<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class Alquileres extends MySqlConnection {

  const TABLE_NAME = 'alquileres';


  private $idTransaccion;
  private $idPelicula;
  private $cantidad;
  private $fecha;
  
  public function getIdTransaccion(){return $this->idTransaccion;}
  public function setIdTransaccion($idTransaccion){$this->idTransaccion = $idTransaccion;return $this;}
  public function getIdPelicula(){return $this->idPelicula;}
  public function setIdPelicula($idPelicula){$this->idPelicula = $idPelicula;return $this;}
  public function getCantidad(){return $this->cantidad;}
  public function setCantidad($cantidad){$this->cantidad = $cantidad;return $this;}
  public function getFecha(){return $this->fecha;}
  public function setFecha($fecha){$this->fecha = $fecha;return $this;}

  public function __construct()
  {
    parent::__construct();
  }

  public function list () {
    $result = [
      'clients' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME;
    $stmt = $this->db->prepare($sql);
    
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              array_push($result['alquileres'], $row);
            }
            
    } else {
      $result['error'] = 'Server Error';
    }
    return json_encode($result);
  }

  public function create () {
    $result = [
      'success' => false,
      'error' => ''
    ];
    $sql = "INSERT INTO " . self::TABLE_NAME . " (id_transaccion, id_pelicula, cantidad, fecha) VALUES (:id_transaccion, :id_pelicula, :cantidad, :fecha) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_transaccion", $this->getIdTransaccion());
    $stmt->bindValue(":id_pelicula", $this->getIdPelicula());
    $stmt->bindValue(":cantidad", $this->getCantidad());
    $stmt->bindValue(":fecha", $this->getFecha());

    try {
      $stmt->execute();
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);
  }

  public function details ($id) {
    $result = [
      'clients' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id", $id);
    if ($stmt->execute()) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($result['alquileres'], $row);
      }
    } else {
      $result['error'] = 'Server Error';
    }
    return json_encode($result);
  }

  public function delete ($id) {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id", $id);
    if ($stmt->execute()) {
      $result['success'] = true;
    } else {
      $result['error'] = 'Server Error';
    }
    return json_encode($result);
  }


}