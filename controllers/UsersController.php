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
}