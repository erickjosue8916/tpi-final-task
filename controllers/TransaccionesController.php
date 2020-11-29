<?php

const RETRASO = 10.00;

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
    
    // ver el detalle de compra de una transaccion
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

    // ver detalle de transaccion (Alquiler)
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
    
    // realizar pago de alquiler 
    public function pagarTransaccion () {
        if ($_COOKIE["sessionId"]) {
            require_once "models/Transacciones.php";
            $id = $_GET["id"];
            $total = $_GET["total"];

            $transaccion = new Transacciones();
            $result = $transaccion->markAsCancelled($id, $total);//Cambiamos el total de acuerdo a la cantidad de dias extra
            
            header("Location: " . BASE_DIR . "Transacciones/list");
        }
    }
}