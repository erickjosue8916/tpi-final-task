<?php

class TransaccionesController {
    public function __construct()
    {
        
    }

    public function list () {
        require_once "models/Transacciones.php";
        $Transacciones = new Transacciones();
        $result = $Transacciones->list();
        $result = json_decode($result, true);
        //require_once "views/TransaccionesList.php";
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
            //require_once "views/TransaccionesCreate.php";
        } else {
            require_once "models/Transacciones.php";
            $Transacciones = new Transacciones();
            $Transacciones->setFecha($_POST['fecha']);
            $Transacciones->setTotal($_POST['total']);
            $Transacciones->setIdUsuario($_POST['id_usuario']);
            $Transacciones->setEstado($_POST['estado']);
            $Transacciones->setTipo($_POST['tipo']);
            
            $result = $Transacciones->create();
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Transacciones/list");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
        }
    }
    
    public function update () {
        require_once "models/Transacciones.php";
        $Transacciones = new Transacciones();
        $result = $Transacciones->list();
        $result = json_decode($result, true);
        //require_once "views/TransaccionesList.php";
    }

    public function details () {

        if ($_COOKIE["sessionId"]) {
            session_start();
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }

        require_once "models/Transacciones.php";
        $Transacciones = new Transacciones();
        $result = $Transacciones->details($_GET['id']);
        $result = json_decode($result, true);
        //require_once "views/TransaccionesDetails.php";
    }
    public function delete () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Transacciones.php";
        $Transacciones = new Transacciones();
        $result = $Transacciones->delete($_GET['id']);
        $result = json_decode($result, true);
        header("Location: " . BASE_DIR . "Transacciones/list");
    }
    
}