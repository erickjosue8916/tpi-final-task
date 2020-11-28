<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class User extends MySqlConnection {

  const TABLE_NAME = 'usuarios';


  private $nombre;
  private $apellido;
  private $email;
  private $telefono;
  private $direccion;
  private $userName;

  private $userPassword;
  private $rol;

  public function setNombre($nombre){$this->nombre = $nombre;}
  public function getNombre() { return $this->nombre; } 
  
  public function setApellido($apellido) { $this->apellido = $apellido; } 
  public function getApellido() { return $this->apellido; } 
  
  public function setEmail($email) { $this->email = $email; } 
  public function getEmail() { return $this->email; } 
  
  public function setTelefono($telefono){$this->telefono = $telefono;}
  public function getTelefono() { return $this->telefono; } 
  
  public function setDireccion($direccion){$this->direccion = $direccion;}
  public function getDireccion() { return $this->direccion; } 
  
  public function setUserName($userName) { $this->userName = $userName; } 
  public function getUserName() { return $this->userName; } 
  
  public function setUserPassword($userPassword) { $this->userPassword = $userPassword; } 
  public function getUserPassword() { return $this->userPassword; }

  public function setRol($rol) { $this->rol = $rol; } 
  public function getRol() { return $this->rol; }

  public function __construct()
  {
    parent::__construct();
  }

  public function login () {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE username = :username";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":username", $this->getUserName());
    if ($stmt->execute()) {
        $nRow = $stmt->rowCount();
        if ($nRow == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($this->getUserPassword() === $result["password"]) {
                session_start();
                $_SESSION["nombre"] = $result["nombre"];
                $_SESSION["apellido"] = $result["apellido"];
                setcookie("sessionId", true, strtotime('+3000 hour'), '/'); // time() + (60 * 20)
                setcookie("rol", $result["rol"], strtotime('+3000 hour'), '/');
                setcookie("id_usuario", $result["id_usuarios"], strtotime('+3000 hour'), '/');
                $result['success']=true;
            }
            else
            {
                $result['error'] = 'Contraseña incorrecta';
            }
        } else {
          $result['error'] = 'Usuario no encontrado';
        }
    } else {
      $result['error'] = 'Se produjo un error, inténtalo de nuevo más tarde';
    }
    return json_encode($result);
  }

  public function logOut() {
    unset($_COOKIE);
    unset($_SESSION);
    header('Location: '.BASE_DIR.'Users/login');//Mandamos de regreso a la pagina de login
  }

  public function register(){
    $result = [
      'id_usuario' => 0,
      'success' => false,
      'error' => ''
    ];
    //
    $sql = "INSERT INTO " . self::TABLE_NAME . " (nombre, apellido, email, telefono, direccion, username, password, rol) VALUES (:nombre, :apellido, :email, :telefono, :direccion, :username, :password, :rol) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":nombre", $this->getNombre());
    $stmt->bindValue(":apellido", $this->getApellido());
    $stmt->bindValue(":email", $this->getEmail());
    $stmt->bindValue(":telefono", $this->getTelefono());
    $stmt->bindValue(":direccion", $this->getDireccion());
    $stmt->bindValue(":username", $this->getUserName());
    $stmt->bindValue(":password", $this->getUserPassword());
    $stmt->bindValue(":rol", $this->getRol());

    try {
      $stmt->execute();
      $last_id = $this->db->lastInsertId();
      $result['id_usuario'] = $last_id;
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);
  }
}