<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class User extends MySqlConnection {

  const TABLE_NAME = 'usuarios';

  //Definimos los datos necesarios
  private $nombre;
  private $apellido;
  private $email;
  private $telefono;
  private $direccion;
  private $userName;
  private $userPassword;
  private $rol;

  //Creamos sus getters y setters
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
  
  public function setUserPassword($userPassword) { $this->userPassword = $userPassword;} 
  public function getUserPassword() { return $this->userPassword; }

  public function setRol($rol) { $this->rol = $rol; } 
  public function getRol() { return $this->rol; }

  public function __construct()
  {
    parent::__construct();
  }

  //Cuando el usuario busca iniciar sesion con los datos de usuario y contraseña
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
        if ($nRow == 1) {//Si se trajo solo un dato
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->getUserPassword(), $row["password"])) {

                session_start();
                $_SESSION["nombre"] = $row["nombre"];
                $_SESSION["apellido"] = $row["apellido"];

                setcookie("sessionId", $row["nombre"], strtotime('+1 hour'), '/'); // seteamos las cookies y el session
                setcookie("rol", $row["rol"], strtotime('+1 hour'), '/');
                setcookie("id_usuario", $row["id_usuarios"], strtotime('+1 hour'), '/');
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
    return json_encode($result);//Retornamos los datos en un arreglo json
  }

  //Cuando el usuario cierra su sesion, se borran las cookies y la session que se creo
  public function logOut() {
    unset($_COOKIE);
    unset($_SESSION);
    header('Location: '.BASE_DIR.'Users/login');//Mandamos de regreso a la pagina de login
  }

  //Cuando un nuevo cliente se va a registrar se ejecuta este metodo
  public function register(){
    $result = [
      'id_usuario' => 0,
      'success' => false,
      'error' => ''
    ];
    //
    $sql = "INSERT INTO " . self::TABLE_NAME . " (nombre, apellido, email, telefono, direccion, username, password, rol) VALUES (:nombre, :apellido, :email, :telefono, :direccion, :username, :password, :rol) ";
    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(":nombre", $this->getNombre());//Evitamos la inyección sql
    $stmt->bindValue(":apellido", $this->getApellido());
    $stmt->bindValue(":email", $this->getEmail());
    $stmt->bindValue(":telefono", $this->getTelefono());
    $stmt->bindValue(":direccion", $this->getDireccion());
    $stmt->bindValue(":username", $this->getUserName());
    $stmt->bindValue(":password", password_hash($this->getUserPassword(), PASSWORD_BCRYPT, ['cost' => 4]));
    $stmt->bindValue(":rol", $this->getRol());
    
    try {
      $stmt->execute();
      $last_id = $this->db->lastInsertId();//Obtenemos el id del ultimo cliente agregado
      $result['id_usuario'] = $last_id;//Pasamos ese id a el arreglo result
      $result['success'] = true;
    } catch (\Throwable $th) {
      $result['error'] = "$th";
    }
    return json_encode($result);//Retornamos los datos en un arreglo json
  }
}