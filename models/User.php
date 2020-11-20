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
<<<<<<< HEAD
  protected $password;
=======
  private $userPassword;
>>>>>>> 5f7f2a1168bf73f536a145a2421ad4f0f5983a4f
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
                setcookie("sessionId", true, time() + (60 * 1), '/'); // time() + (60 * 20)
                setcookie("rol", $result["rol"], time() + (60 * 1), '/');
                $result['success']=true;
            }
            else
            {
                $result['error'] = 'Invalid passoword';
            }
        } else {
          $result['error'] = 'Not found user';
        }
    } else {
      $result['error'] = 'Server Error';
    }
    return json_encode($result);
  }

}