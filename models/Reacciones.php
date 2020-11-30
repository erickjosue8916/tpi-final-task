<?php

class Reacciones extends MySqlConnection {

  const TABLE_NAME = 'reacciones';

  //Definimos los datos importantes
  private $idUsuario;
  private $idPelicula;
  private $reaccion;

  //Definimos los getters y setters
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

  //Lista todas las reacciones que se encuentran en la tabla
  public function list () {
    $result = [
      'reacciones' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME;
    $stmt = $this->db->prepare($sql);
    
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              //Agregamos cada transaccion a el arreglo result
              array_push($result['reacciones'], $row);
            }
            
    } else {
      $result['error'] = 'Server Error';
    }
    //Devolvemos un arreglo json con los resultados
    return json_encode($result);
  }

  //Crea una nueva reaccion en la pelicula seleccionada
  public function create () {
    $result = [
      'success' => false,
      'error' => ''
    ];
    $sql = "INSERT INTO " . self::TABLE_NAME . " (id_usuario, id_pelicula, reaccion) VALUES (:id_usuario, :id_pelicula, :reaccion) ";
    $stmt = $this->db->prepare($sql);
    //Evitamos la inyeccion de sql
    $stmt->bindValue(":id_usuario", $this->getIdUsuario());
    $stmt->bindValue(":id_pelicula", $this->getIdPelicula());
    $stmt->bindValue(":reaccion", $this->getReaccion());

    try {
      //Intentamos ejectuar la sentecia sql
      $stmt->execute();
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);//Retornamos el arreglo resultado
  }

  //Cambia el estado de la reaccion. Se ha comentado porque al final se decidio eliminar el campo al quitar el like
  /*
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
  */

  //Busca en la tabla si la reacción ya existe. 
  //Si ya existe la elimina, si no exite la crea con el usuario y la peli que se le envio
  public function findUserMovie($idUsuario,$idPelicula) {
    $result = [
      'success' => false,
      'error' => ''
    ];

    //Buscamos en la tabla si la fila ya existe
    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_usuario = :id_usuario AND id_pelicula = :id_pelicula";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id_usuario", $idUsuario);
    $stmt->bindValue(":id_pelicula", $idPelicula);
    
    if ($stmt->execute()) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      //En caso que se encuentre una fila ya creada
      if(!empty($row)){
        //Modificar el registro encontrado
        $reaccion = new Reacciones();
        //Borramos el campo que se selecciono
        $reaccion->delete($row['id_reaccion']);

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

  //Retorna la fila/s en la tabla que coincida con el id insertado
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
        //Agrega cada elemento que coincida con la busqueda al arreglo result
        array_push($result['reacciones'], $row);
      }
    } else {
      $result['error'] = 'Server Error';
    }
    //Devuelve e arreglo resultado
    return json_encode($result);
  }

  //Borra una reaccion en el id que reciba
  public function delete ($id) {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id_reaccion = :id";
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