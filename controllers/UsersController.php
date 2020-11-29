<?php

class UsersController {
    public function __construct()
    {
        
    }

    //Realiza el proceso de inicio de sesion
    public function login () {
        if (empty($_POST)) {
            //Si no hay datos redirecciona a la pagina de inicio de sesion
            require_once "views/loginUser.php";
        } else {
            //Si ya trae datos por post los toma y realiza el inicio de sesion
            require_once "models/User.php";
            $user = new User();
            $user->setUserName($_POST['username']);
            $user->setUserPassword($_POST['password']);

            $result = $user->login();
            $result = json_decode($result, true);
            if ($result['success']) {
                //Si logro iniciar sesion correctamente lo manda a home
                header("Location: " . BASE_DIR);
            } else {
                //De otra forma muestra un error
                $error = $result['error'];
                require_once "views/loginUser.php";
            }
        }
    }

    //Realiza el proceso de "cerrar sesion" de un usuario
    public function logOut(){
        require_once "models/User.php";
        $user = new User();

        //Eliminamos las cookies y el session
        setcookie("id_usuario", null, strtotime('+10 second'),'/');
        setcookie("sessionId", null, strtotime('+10 second'),'/');
        setcookie("rol",null, strtotime('+10 second'),'/');
        unset($_SESSION);
        $user->logOut();
        //header("Location: " . BASE_DIR);
    } 

    //Registra un nuevo usuario tipo cliente
    public function register(){
        if (empty($_POST)) {
            //Si no tiene valores post redirecciona a registrarUser
            require_once "views/registerUser.php";
        } else {
            //Si trae datos del post, los toma y registra el nuevo usuario
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

            //Totamos el arreglo resultado de crear el registro
            $result = json_decode($User->register(),true);
            if ($result['success']) {
                //Si el proceso es un exito retorna a la pagina de iniciar sesion
                header("Location: " . BASE_DIR . "Users/login");
            } else {
                //Si ocurrio un fallo, imprime ese error
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
        }
    }
}