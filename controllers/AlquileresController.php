<?php

class AlquileresController {
    public function __construct()
    {
        
    }

    public function list () {
        require_once "models/Alquileres.php";
        $Alquileres = new Alquileres();
        $result = $Alquileres->list();
        $result = json_decode($result, true);
        //require_once "views/AlquileresList.php";
    }
    
    public function create () {
        if ($_COOKIE["sessionId"]) {
        if ($_COOKIE['rol'] != 'Administrador') {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        
        if (empty($_POST)) {
            //require_once "views/AlquileresCreate.php";
        } else {
            require_once "models/Alquileres.php";
            $Alquileres = new Alquileres();
            $Alquileres->setIdTransaccion($_POST['id_transaccion']);
            $Alquileres->setIdPelicula($_POST['id_pelicula']);
            $Alquileres->setCantidad($_POST['cantidad']);
            $Alquileres->setFecha($_POST['fecha']);

            $result = $Alquileres->create();
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Alquileres/list");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
            
        }
    }
    
    public function update () {
        require_once "models/Alquileres.php";
        $Alquileres = new Alquileres();
        $result = $Alquileres->list();
        $result = json_decode($result, true);
        //require_once "views/AlquileresList.php";
    }

    public function details () {

        if ($_COOKIE["sessionId"]) {
            session_start();
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }

        require_once "models/Alquileres.php";
        $Alquileres = new Alquileres();
        $result = $Alquileres->details($_GET['id']);
        $result = json_decode($result, true);
        //require_once "views/AlquileresDetails.php";
    }
    public function delete () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Alquileres.php";
        $Alquileres = new Alquileres();
        $result = $Alquileres->delete($_GET['id']);
        $result = json_decode($result, true);
        header("Location: " . BASE_DIR . "Alquileres/list");
    }
    
}