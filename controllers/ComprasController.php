<?php

class ComprasController {
    public function __construct()
    {
        
    }

    //Lista todas las compras
    public function list () {
        require_once "models/Compras.php";
        $Compras = new Compras();
        $result = $Compras->list();
        $result = json_decode($result, true);
        //require_once "views/ComprasList.php";
    }

    //Crea una compra
    public function create () {
        if ($_COOKIE["sessionId"]) {
        if ($_COOKIE['rol'] != 'Administrador') {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        
        if (empty($_POST)) {
            //require_once "views/ComprasCreate.php";
        } else {
            require_once "models/Compras.php";
            $Compras = new Compras();
            $Compras->setIdTransaccion($_POST['id_transaccion']);
            $Compras->setIdPelicula($_POST['id_pelicula']);
            $Compras->setCantidad($_POST['cantidad']);

            $result = json_decode($Compras->create(),true);
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Compras/list");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
            
        }
    }

    //Actualiza una compra
    public function update () {
        require_once "models/Compras.php";
        $Compras = new Compras();
        $result = $Compras->list();
        $result = json_decode($result, true);
        //require_once "views/ComprasList.php";
    }

    //Retorna los detalles de una compra
    public function details () {
        if ($_COOKIE["sessionId"]) {
            session_start();
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }

        require_once "models/Compras.php";
        $Compras = new Compras();
        $result = $Compras->details($_GET['id']);
        $result = json_decode($result, true);
        //require_once "views/ComprasDetails.php";
    }

    //Borra una compra
    public function delete () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Compras.php";
        $Compras = new Compras();
        $result = $Compras->delete($_GET['id']);
        $result = json_decode($result, true);
        header("Location: " . BASE_DIR . "Compras/list");
    }
    
}