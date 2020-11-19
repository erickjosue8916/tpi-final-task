<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class User extends MySqlConnection {

  const TABLE_NAME = 'usuarios';


  private $name;
  private $lastName;
  private $email;
  private $rol;
  private $userPassword;

  public function setName($name){$this->name = $name;}
  public function getName() { return $this->name; } 
  public function setLastName($lastName) { $this->lastName = $lastName; } 
  public function getLastName() { return $this->lastName; } 
  public function setEmail($email) { $this->email = $email; } 
  public function getEmail() { return $this->email; } 
  public function setUserName($rol) { $this->rol = $rol; } 
  public function getUserName() { return $this->userName; } 
  public function setPassword($password) { $this->userPassword = $password; } 
  public function getPassword() { return $this->userPassword; }

  public function __construct()
  {
    parent::__construct();
  }

  public function login () {
    $result = [
      'success' => false,
      'error' => ''
    ];

    $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":email", $this->getEmail());
    if ($stmt->execute()) {
        $nRow = $stmt->rowCount();
        if ($nRow == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($this->getPassword() === $result["password"]) {
                session_start();
                $_SESSION["name"] = $result["nombre"];
                $_SESSION["latname"] = $result["apellidos"];
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