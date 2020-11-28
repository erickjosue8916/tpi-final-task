<?php

class UsersController {
    public function __construct()
    {
        
    }

    public function login () {
        if (empty($_POST)) {
            require_once "views/loginUser.php";
        } else {
            require_once "models/User.php";
            $user = new User();
            $user->setUserName($_POST['username']);
            $user->setUserPassword($_POST['password']);

            $result = $user->login();
            $result = json_decode($result, true);
            if ($result['success']) {
                
                header("Location: " . BASE_DIR);
            } else {
                $error = $result['error'];
                require_once "views/loginUser.php";
            }
        }
    }

    public function logOut(){
        require_once "models/User.php";
        $user = new User();
        setcookie("id_usuario", null, strtotime('+10 second'),'/');
        setcookie("sessionId", null, strtotime('+10 second'),'/');
        setcookie("rol",null, strtotime('+10 second'),'/');
        unset($_SESSION);
        $user->logOut();
        //header("Location: " . BASE_DIR);
    } 

    public function register(){
        if (empty($_POST)) {
            require_once "views/registerUser.php";
        } else {
        require_once "models/User.php";
            $User = new User();
            $User->setNombre($_POST['nombre']);
            $User->setApellido($_POST['apellido']);
            $User->setEmail($_POST['email']);
            $User->setTelefono($_POST['telefono']);
            $User->setDireccion($_POST['direccion']);
            $User->setUserName($_POST['username']);
            $User->setUserPassword($_POST['password']);
            $User->setRol("Cliente");

            $result = json_decode($User->register(),true);
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Users/login");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
        }
    }
}