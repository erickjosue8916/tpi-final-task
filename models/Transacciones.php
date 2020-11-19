<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class Transacciones extends MySqlConnection {

  const TABLE_NAME = 'transacciones';


  private $fecha;
  private $total;
  private $idUsuario;
  private $estado;
  private $tipo;
  
  public function getFecha(){return $this->fecha;}
  public function setFecha($fecha){$this->fecha = $fecha;return $this;}
  public function getTotal(){return $this->total;}
  public function setTotal($total){$this->total = $total;return $this;}
  public function getIdUsuario(){return $this->idUsuario;}
  public function setIdUsuario($idUsuario){$this->idUsuario = $idUsuario;return $this;}
  public function getEstado(){return $this->estado;}
  public function setEstado($estado){$this->estado = $estado;return $this;}
  public function getTipo(){return $this->tipo;}
  public function setTipo($tipo){$this->tipo = $tipo;return $this;}

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
              array_push($result['transacciones'], $row);
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
    $sql = "INSERT INTO " . self::TABLE_NAME . " (fecha, total, id_usuario, estado, tipo) VALUES (:fecha, :total, :id_usuario, :estado, :tipo) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":fecha", $this->getFecha());
    $stmt->bindValue(":total", $this->getTotal());
    $stmt->bindValue(":id_usuario", $this->getIdUsuario());
    $stmt->bindValue(":estado", $this->getEstado());
    $stmt->bindValue(":tipo", $this->getTipo());

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
        array_push($result['transacciones'], $row);
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