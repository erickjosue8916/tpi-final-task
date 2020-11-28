<?php

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
      'alquileres' => [],
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
      'id_alquileres' => 0,
      'success' => false,
      'error' => ''
    ];
    $sql = "INSERT INTO " . self::TABLE_NAME . " (id_transaccion, id_pelicula, cantidad, fecha_devolucion) VALUES (:id_transaccion, :id_pelicula, :cantidad, :fecha) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_transaccion", $this->getIdTransaccion());
    $stmt->bindValue(":id_pelicula", $this->getIdPelicula());
    $stmt->bindValue(":cantidad", $this->getCantidad());
    $stmt->bindValue(":fecha", $this->getFecha());
    
    try {
      $stmt->execute();
      $last_id = $this->db->lastInsertId();
      $result['id_alquileres'] = $last_id;
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);
  }

  public function details ($id) {
    $result = [
      'alquileres' => [],
      'error' => ''
    ];
    $sql = "SELECT a.id_alquiler, a.cantidad, p.titulo, t.fecha_transaccion, a.fecha_devolucion, t.total_transaccion FROM alquileres AS a 
    INNER JOIN peliculas AS p ON a.id_pelicula = p.id_pelicula
    INNER JOIN transacciones AS t ON a.id_transaccion = t.id_transaccion
    WHERE a.id_transaccion = :id";

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