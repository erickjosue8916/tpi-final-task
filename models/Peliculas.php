<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class Peliculas extends MySqlConnection {

  const TABLE_NAME = 'peliculas';


  private $titulo;
  private $descripcion;
  private $imagen;
  private $stock;
  private $precioAlquiler;
  private $precioVenta;
  private $disponibilidad;
  
  public function setTitulo($titulo){$this->titulo = $titulo;}
  public function getTitulo() { return $this->titulo; } 
  
  public function setDescripcion($descripcion) { $this->descripcion = $descripcion; } 
  public function getDescripcion() { return $this->descripcion; } 
  
  
  public function setImagen($imagen) { $this->imagen = $imagen; } 
  public function getImagen() { return $this->imagen; }
  
  public function setStock($stock) { $this->stock = $stock; } 
  public function getStock() { return $this->stock; } 
  
  public function setPrecioAlquiler($precioAlquiler) { $this->precioAlquiler = $precioAlquiler; } 
  public function getPrecioAlquiler() { return $this->precioAlquiler; } 

  public function setPrecioVenta($precioVenta) { $this->precioVenta = $precioVenta; } 
  public function getPrecioVenta() { return $this->precioVenta; } 
  
  public function setDisponibilidad($disponibilidad) { $this->disponibilidad = $disponibilidad; } 
  public function getDisponibilidad() { return $this->disponibilidad; } 
  
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
              array_push($result['peliculas'], $row);
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
    $sql = "INSERT INTO " . self::TABLE_NAME . " (titulo, descripcion, imagen, stock, precio_alquiler, precio_venta, disponibilidad) VALUES (:titulo, :descripcion, :imagen, :stock, :precio_alquiler, :precio_venta, :disponibilidad) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":titulo", $this->getTitulo());
    $stmt->bindValue(":descripcion", $this->getdescripcion());
    $stmt->bindValue(":imagen", $this->getImagen());
    $stmt->bindValue(":stock", $this->getstock());
    $stmt->bindValue(":precio_alquiler", $this->getprecioAlquiler());
    $stmt->bindValue(":precio_venta", $this->getprecioVenta());
    $stmt->bindValue(":disponibilidad", $this->getDisponibilidad());

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
        array_push($result['peliculas'], $row);
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