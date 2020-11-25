<?php

class TransaccionesController {
    public function __construct()
    {
        
    }

    public function list () {
        require_once "models/Transacciones.php";
        $page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
        $limit = (!isset($_GET['limit'])) ? 20 : $_GET['limit'];
        $filter = (!isset($_GET['filter'])) ? [] : $_GET['filter'];
        $sort = (!isset($_GET['sort'])) ? [] : $_GET['sort'];
        $Transacciones = new Transacciones();
        $result = $Transacciones->list($page, $limit, $filter, $sort);
        $result = json_decode($result, true); 
        require_once "views/transacciones/transaccionesList.php";
    }
    
    public function detalleCompra () {
         if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            } else {
                require_once "models/Compras.php";
                $id = $_GET["id"];
                $compra = new Compras();
                $result = $compra->details($id);
                $result = json_decode($result, true);
                require_once "views/transacciones/comprasList.php";
            }
        }
    }

    public function detalleAlquiler () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            } else {
                require_once "models/Alquileres.php";
                $id = $_GET["id"];
                $alquiler = new Alquileres();
                $result = $alquiler->details($id);
                $result = json_decode($result, true);
                require_once "views/transacciones/alquileresList.php";
            }
        }
    }
    
    
}