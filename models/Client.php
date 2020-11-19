<?php

require_once "database/MySqlConnection.php";
require_once "database/IMySqlActions.php";
class Client extends MySqlConnection {

  const TABLE_NAME = 'clientes';


  private $name;
  private $lastName;
  private $address;
  private $email;
  private $image;

  public function setName($name){$this->name = $name;}
  public function getName() { return $this->name; } 
  public function setLastName($lastName) { $this->lastName = $lastName; } 
  public function getLastName() { return $this->lastName; } 
  public function setEmail($email) { $this->email = $email; } 
  public function getEmail() { return $this->email; } 
  public function setAddress($address) { $this->address = $address; } 
  public function getAddress() { return $this->address; } 
  public function setImage($image) { $this->image = $image; } 
  public function getImage() { return $this->image; }

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
              array_push($result['clients'], $row);
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
    $sql = "INSERT INTO " . self::TABLE_NAME . " (nombre,apellidos,direccion,email) VALUES (:name,:lastname,:address,:email) ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":name", $this->getName());
    $stmt->bindValue(":lastname", $this->getLastName());
    $stmt->bindValue(":address", $this->getAddress());
    $stmt->bindValue(":email", $this->getEmail());
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
        array_push($result['clients'], $row);
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