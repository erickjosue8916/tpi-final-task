<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class Reacciones extends MySqlConnection {

  const TABLE_NAME = 'reacciones';


  private $idUsuario;
  private $idPelicula;
  private $reaccion;
  
  public function getIdUsuario(){return $this->idUsuario;}
  public function setIdUsuario($idUsuario){$this->idUsuario = $idUsuario;return $this;}
  public function getIdPelicula(){return $this->idPelicula;}
  public function setIdPelicula($idPelicula){$this->idPelicula = $idPelicula;return $this;}
  public function getReaccion(){return $this->reaccion;}
  public function setReaccion($reaccion){$this->reaccion = $reaccion;return $this;}

  public function __construct()
  {
    parent::__construct();
  }

  public function list () {
    $result = [
      'reacciones' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME;
    $stmt = $this->db->prepare($sql);
    
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              array_push($result['reacciones'], $row);
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
    $sql = "INSERT INTO " . self::TABLE_NAME . " (id_usuario, id_pelicula, reaccion) VALUES (:id_usuario, :id_pelicula, :reaccion) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_usuario", $this->getIdUsuario());
    $stmt->bindValue(":id_pelicula", $this->getIdPelicula());
    $stmt->bindValue(":reaccion", $this->getReaccion());

    try {
      $stmt->execute();
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);
  }

  public function changeState($id) {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "UPDATE reacciones SET reaccion=:reaccion WHERE id_reaccion=:id_reaccion";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":reaccion", $this->reaccion);
    $stmt->bindValue(":id_reaccion", $id);
    try {
      $stmt->execute();
      $edited_id = $id;
      $result['id_reaccion'] = $edited_id;
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    //return json_encode($result);
    return $result;
  }
  public function findUserMovie($idUsuario,$idPelicula) {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_usuario = :id_usuario AND id_pelicula = :id_pelicula";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_usuario", $idUsuario);
    $stmt->bindValue(":id_pelicula", $idPelicula);
    
    if ($stmt->execute()) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!empty($row)){
        //Modificar el registro encontrado
        $editar = new Reacciones();
        $editar->setReaccion( $row['reaccion'] == "Inactivo" ? "Activo" : "Inactivo");
        $editar->changeState($row['id_reaccion']);

      }else{
        //Crear el campo nuevo
        $nuevo = new Reacciones();
        $nuevo->setIdUsuario($idUsuario);
        $nuevo->setIdPelicula($idPelicula);
        $nuevo->setReaccion("Activo");
        $nuevo->create();
      }
      $result['success'] = true;
    } else {
      $result['error'] = 'Server Error';
    }
    return $result;
  }
  public function details ($id) {
    $result = [
      'reacciones' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_reaccion = :id_reaccion";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_reaccion", $id);
    if ($stmt->execute()) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($result['reacciones'], $row);
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