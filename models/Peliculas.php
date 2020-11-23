<?php
/* SELECT pe.id, pe.titulo, pe.descripcion, IF (re.id_usuario = 0, 'Yes', 'No') as reaction FROM `peliculas` pe left JOIN reacciones re on re.id_pelicula = pe.id */

class Peliculas extends MySqlConnection {

  const TABLE_NAME = 'peliculas';
  private $filterFields = ['titulo', 'disponibilidad'];
  private $sortFields = ['titulo', 'stock', 'precio_alquiler', 'precio_venta', 'disponibilidad'];

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

  public function list ($page = 1, $limit = 20, $filter = [], $sort = []) {
    $result = [
      'peliculas' => [],
      'error' => ''
    ];
    $usuarioId = (isset($_COOKIE['usuario_id'])) ? $_COOKIE['usuario_id']: 0;
    $offset = ($page - 1) * $limit;
    $sql = "SELECT p.id_pelicula, p.titulo, p.descripcion,  p.imagen, p.stock, p.precio_alquiler, p.precio_venta, p.disponibilidad, IF (re.id_usuario = $usuarioId, 'Yes', 'No') as reaccion FROM " . self::TABLE_NAME . " p";
    $sql .= " LEFT JOIN reacciones re on re.id_pelicula = p.id_pelicula ";
    $sql .= $this->createSqlFilter($filter);
    $sql .= $this->createSqlSort($sort);
    $sql .= " limit $limit offset $offset";
    $stmt = $this->db->prepare($sql);

    $this->setPrepareValues($stmt, $filter);
    if ($stmt->execute()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              array_push($result['peliculas'], $row);
            }
            
    } else {
      $result['error'] = 'Server Error';
    }
    return json_encode($result);
  }

  private function createSqlFilter($filter) {
    $sql = "";
    $filters = $this->filterFields; // set available filters here
    if (count($filter)) {
      $i = 0;
      foreach ($filter as $key => $value) {
        $searchInFilters = array_search($key, $filters);
        if ($searchInFilters === false) $searchInFilters = -1;
        if ($searchInFilters >= 0) {
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

  private function setPrepareValues ($stmt, $filter) {
    $filters = $this->filterFields;
    foreach ($filter as $key => $value) {
      $searchInFilters = array_search($key, $filters);
      if ($searchInFilters === false) $searchInFilters = -1;
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
     // $i++;
    }
  }

  private function createSqlSort($rules) {
    $sql = "";
    $fields = $this->sortFields; // set available filters here
    if (count($rules)) {
      $i = 0;
      foreach ($rules as $key => $value) {
        $searchInFilters = array_search($key, $fields);
        if ($searchInFilters === false) $searchInFilters = -1;
        echo "<br>";
        if ($searchInFilters >= 0  ) {
          $value = strtoupper($value);
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

  public function guardarImagen($file, $name) {
    if (move_uploaded_file($file,  "assets/img/movies/" . $name)){
      return true;
    }else{
      return false;
    }
  }

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

    $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id_pelicula = :id";
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