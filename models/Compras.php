<?php
class Compras extends MySqlConnection {

  const TABLE_NAME = 'compras';


  private $idTransaccion;
  private $idPelicula;
  private $cantidad;
  
  public function getIdTransaccion(){return $this->idTransaccion;}
  public function setIdTransaccion($idTransaccion){$this->idTransaccion = $idTransaccion;return $this;}
  public function getIdPelicula(){return $this->idPelicula;}
  public function setIdPelicula($idPelicula){$this->idPelicula = $idPelicula;return $this;}
  public function getCantidad(){return $this->cantidad;}
  public function setCantidad($cantidad){$this->cantidad = $cantidad;return $this;}

  public function __construct()
  {
    parent::__construct();
  }

  public function list () {
    $result = [
      'compras' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME;
    $stmt = $this->db->prepare($sql);
    
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              array_push($result['compras'], $row);
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
    $sql = "INSERT INTO " . self::TABLE_NAME . " (id_transaccion, id_pelicula, cantidad) VALUES (:id_transaccion, :id_pelicula, :cantidad) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_transaccion", $this->getIdTransaccion());
    $stmt->bindValue(":id_pelicula", $this->getIdPelicula());
    $stmt->bindValue(":cantidad", $this->getCantidad());

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
      'compras' => [],
      'error' => ''
    ];
    $sql = "SELECT c.id_compra, c.cantidad, p.titulo, t.fecha_transaccion, t.total_transaccion FROM " . self::TABLE_NAME . " AS c 
    INNER JOIN peliculas AS p ON c.id_pelicula = p.id_pelicula
    INNER JOIN transacciones AS t ON c.id_transaccion = t.id_transaccion
    WHERE c.id_transaccion = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id", $id);
    if ($stmt->execute()) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($result['compras'], $row);
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