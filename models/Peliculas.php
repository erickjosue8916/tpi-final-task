<?php
/* SELECT pe.id, pe.titulo, pe.descripcion, IF (re.id_usuario = 0, 'Yes', 'No') as reaction FROM `peliculas` pe left JOIN reacciones re on re.id_pelicula = pe.id */

class Peliculas extends MySqlConnection {

  const TABLE_NAME = 'peliculas';

  //Definimos los campos por los que podemos filtrar los resultados
  private $filterFields = ['titulo', 'disponibilidad'];
  //Definimos los campos por los que podemos ordenar los resultados devueltos
  private $sortFields = ['titulo', 'stock', 'precio_alquiler', 'precio_venta', 'disponibilidad','likes'];

  //Definimos los datos necesarios
  private $titulo;
  private $descripcion;
  private $imagen;
  private $stock;
  private $precioAlquiler;
  private $precioVenta;
  private $disponibilidad;

  //Definimos los getters y setters
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

  //Lista todas las peliculas de acuerdo a cierto filtro y orden especificado
  public function list ($page = 1, $limit = 20, $filter = [], $sort = []) {
    $result = [
      'peliculas' => [],
      'error' => ''
    ];
    $usuarioId = (isset($_COOKIE['id_usuario'])) ? $_COOKIE['id_usuario']: 0;//Obtenemos el id del usuario actual si existe
    $offset = ($page - 1) * $limit;
    //Creamos la sentencia sql
    $sql = "SELECT p.id_pelicula, p.titulo, p.descripcion,  p.imagen, p.stock, p.precio_alquiler, p.precio_venta, p.disponibilidad, count(re.id_pelicula) as likes, IF (re.id_usuario = $usuarioId, 'Activo', 'Inactivo') as reaccion FROM " . self::TABLE_NAME . " p";
    $sql .= " LEFT JOIN reacciones re on re.id_pelicula = p.id_pelicula ";
    $sql .= $this->createSqlFilter($filter);
    $sql .= " GROUP BY p.id_pelicula";
    $sql .= $this->createSqlSort($sort);
    $sql .= " limit $limit offset $offset";
    $stmt = $this->db->prepare($sql);
    $this->setPrepareValues($stmt, $filter);
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              array_push($result['peliculas'], $row);//Agregamos cada fila al arreglo resultado
            }
            
    } else {
      $result['error'] = 'Server Error';
    }
    //Retorna un arreglo json
    return json_encode($result);
  }

  //Busca todas las peliculas a las que el usuario actual les ha dado like
  public function likedbyUser(){
    $result = [
      'peliculas' => [],
      'error' => ''
    ];

    //Tomamos el id del usuario actual, si no hay ningun usuario entonces tomamos el valor de -1
    $usuarioId = (isset($_COOKIE['id_usuario'])) ? $_COOKIE['id_usuario']: -1;

    //Tomamos los campos necesarios donde el id_usuario en en la tabla reacciones coincide con el id del usuario actual (el usuario le ha dado like)
    $sql = "SELECT p.id_pelicula, p.titulo, p.descripcion,  p.imagen, p.stock, p.precio_alquiler, p.precio_venta, p.disponibilidad, IF (re.id_usuario = $usuarioId, 'Activo', 'Inactivo') as reaccion FROM " . self::TABLE_NAME . " p";
    $sql .= " LEFT JOIN reacciones re on re.id_pelicula = p.id_pelicula ";
    $sql .= " WHERE re.id_usuario = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $usuarioId);

    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              //Obtenemos todos los campos que coinciden con la busqueda y los agregamos al arreglo
              array_push($result['peliculas'], $row);
            }
            
    } else {
      $result['error'] = 'Server Error';
    }
    return json_encode($result);//Devuelve todas las peliculas que el usuario actual le dio like
  }

  //Lista todas las peliculas con valores adicionales que solo un administrador deberia tener acceso
  public function listAdmin ($page = 1, $limit = 20, $filter = [], $sort = []) {
    $result = [
      'peliculas' => [],
      'error' => ''
    ];

    //Creamos la sentencia con los filtros y ordenes especificados
    $offset = ($page - 1) * $limit;
    $sql = "SELECT p.id_pelicula, p.titulo, p.descripcion,  p.imagen, p.stock, p.precio_alquiler, p.precio_venta, p.disponibilidad, count(re.id_pelicula) as likes FROM " . self::TABLE_NAME . " p";
    $sql .= " LEFT JOIN reacciones re on re.id_pelicula = p.id_pelicula ";
    $sql .= $this->createSqlFilter($filter);
    $sql .= $this->createSqlSort($sort);
    $sql .= " GROUP BY p.id_pelicula";
    $sql .= " limit $limit offset $offset";
    $stmt = $this->db->prepare($sql);

    $this->setPrepareValues($stmt, $filter);
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              //Agregamos cada fila al arreglo resultado
              array_push($result['peliculas'], $row);
            }
            
    } else {
      $result['error'] = 'Server Error';
    }
    //Retornamos un arreglo json
    return json_encode($result);
  }

  //Creamos la parte de la sentencia que se encarga de los filtros
  private function createSqlFilter($filter) {
    $sql = "";
    $filters = $this->filterFields; // set available filters here
    if (count($filter)) {
      $i = 0;
      //Por cada filtro ingresado
      foreach ($filter as $key => $value) {
        //Contamos cuandos de ellos son válidos (estan en la lista de filtros definida anteriormente)
        $searchInFilters = array_search($key, $filters);
        if ($searchInFilters === false) $searchInFilters = -1;
        //Si no se encontro el filtro omite el proceso
        if ($searchInFilters >= 0) {
          //Anexa WHERE (condicion) AND (condicion) dependiendo de la cantidad de filtros ingresados
          $sql .= ($i == 0 ) ? " WHERE " : " AND ";
          switch ($key) {
            case 'titulo':
              $sql .= "p.titulo LIKE :titulo"; 
              break;
            case 'disponibilidad':
              $sql .= "p.disponibilidad LIKE :disponibilidad"; 
              break;        
            default:
              # code...
              break;
          }
        }
        $i++;
      }
    }
    return $sql;
  }

  //Cambia los :campo por el valor correcto, evitando la inyeción sql
  private function setPrepareValues ($stmt, $filter) {
    $filters = $this->filterFields;
      //Por cada filtro ingresado
      foreach ($filter as $key => $value) {
        //Contamos cuandos de ellos son válidos (estan en la lista de filtros definida anteriormente)
        $searchInFilters = array_search($key, $filters);
        if ($searchInFilters === false) $searchInFilters = -1;
        //Si no se encontro el filtro omite el proceso
        if ($searchInFilters >= 0  ) {
        switch ($key) {
          case 'titulo':
            $nombre = "%$value%";
            $stmt->bindParam(':titulo', $nombre);
            break;
          case 'disponibilidad':
            $rol = $value;
            $stmt->bindParam(':disponibilidad', $rol);
            break;
          
          default:
            # code...
            break;
        }
      }
    }
  }

  //Anexa los campos por los que se ordenaran los resultados
  private function createSqlSort($rules) {
    $sql = "";
    $fields = $this->sortFields; // set available filters here
    if (count($rules)) {
      $i = 0;
      //Por cada regla ingresada
      foreach ($rules as $key => $value) {
        //Contamos cuandos de ellos son válidos (estan en la lista de reglas definida anteriormente)
        $searchInFilters = array_search($key, $fields);
        if ($searchInFilters === false) $searchInFilters = -1;
        //Si no se encontro la regla/s omite el proceso
        echo "<br>";
        if ($searchInFilters >= 0  ) {
          //Pasamos el valor recibido a mayuscula (asc -> ASC)
          $value = strtoupper($value);
          //Anexa ORDER BY (condicion) , (condicion) dependiendo de la cantidad de reglas ingresadas
          if ($value == 'ASC' || $value == 'DESC') $sql .= ($i == 0) ? " ORDER BY " : " , ";
          switch ($key) {
            case 'titulo':
              if ( $value == 'ASC' || $value == 'DESC' ) $sql .= " p.titulo " . $value ." "; 
              break;
            case 'stock':
              if ( $value == 'ASC' || $value == 'DESC' ) $sql .= " p.stock " . $value ." "; 
              break;
            case 'precio_alquiler':
              if ( $value == 'ASC' || $value == 'DESC' ) $sql .= " p.precio_alquiler " . $value ." "; 
              break;
            case 'precio_venta':
              if ( $value == 'ASC' || $value == 'DESC' ) $sql .= " p.precio_venta " . $value ." "; 
              break;
            case 'disponibilidad':
              if ( $value == 'ASC' || $value == 'DESC' ) $sql .= " p.disponibilidad " . $value ." "; 
              break;
              case 'likes':
                if ( $value == 'ASC' || $value == 'DESC' ) $sql .= " likes " . $value ." , titulo ASC "; 
                break;
            default:
              # code...
              break;
          }
        }
        $i++;
      }
    }
    return $sql;
  }

  //Actualiza los datos de una pelicula segun el id ingresado
  public function update ($id) {
    $result = [
      'id_pelicula' => 0,
      'success' => false,
      'error' => ''
    ];
    //Busca actualizar los datos en la fila del id correspondiente
    $sql = "UPDATE " . self::TABLE_NAME . " SET titulo=:titulo,descripcion=:descripcion,stock=:stock,precio_alquiler=:precio_alquiler,precio_venta=:precio_venta,disponibilidad=:disponibilidad WHERE id_pelicula=:id_pelicula ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":titulo", $this->getTitulo());
    $stmt->bindValue(":descripcion", $this->getdescripcion());
//    $stmt->bindValue(":imagen", $this->getImagen());
    $stmt->bindValue(":stock", $this->getstock());
    $stmt->bindValue(":precio_alquiler", $this->getprecioAlquiler());
    $stmt->bindValue(":precio_venta", $this->getprecioVenta());
    $stmt->bindValue(":disponibilidad", $this->getDisponibilidad());
    $stmt->bindValue(":id_pelicula", $id);

    try {
      $stmt->execute();
      $edited_id = $id;
      $result['id_pelicula'] = $edited_id;//Tomamos el id de la pelicula editada
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    //return json_encode($result);
    return $result;
  }

  //Crea una pelicula con los datos definidos en el objeto
  public function create () {
    $result = [
      'id_peliculas' => 0,
      'success' => false,
      'error' => ''
    ];
    //Creamos la sentencia que ingresara los datos a la bd
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
      $last_id = $this->db->lastInsertId();
      $result['id_peliculas'] = $last_id;//Retornamos el id de la pelicula ingresada
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);
  }

  //Agrega la imagen de una pelicula a la carpeta ./assets/img/movies/ para poder ser leida luego
  public function guardarImagen($file, $name) {
    if (move_uploaded_file($file,  "assets/img/movies/" . $name)){
      return true;
    }else{
      return false;
    }
  }

  //Obtiene las peliculas que coincidan con el id ingresado
  public function details ($id) {
    $result = [
      'peliculas' => [],
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_pelicula = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id", $id);
    if ($stmt->execute()) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //Anexa la fila a el arreglo resultado
        array_push($result['peliculas'], $row);
      }
    } else {
      $result['error'] = 'Server Error';
    }
    //Retorna el arreglo de resultado
    return json_encode($result);
  }

  //Borra una pelicula en el id ingresado
  public function delete ($id) {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id_pelicula = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":id", $id);
    if ($stmt->execute()) {
      $result['success'] = true;
    } else {
      $result['error'] = 'Server Error';
    }
    //Retorna el arreglo resultado
    return json_encode($result);
  }
}