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
    
    public function pagarTransaccion () {
        if ($_COOKIE["sessionId"]) {
            require_once "models/Transacciones.php";
            $id = $_POST["id"];
            $total = $_POST["total"];

            $fechaLimite = strtotime($_POST["fecha_transaccion"]);
            $fechaActual = strtotime(date('Y-m-d'));
            $interval = 0.00;
            
            if($fechaActual > $fechaLimite){//La fecha se ha pasado de la limite
                $interval = round(abs($fechaLimite - $fechaActual)/86400);//Obtenemos la cantidad de días de diferencia
            }

            $totalExtra = $interval * RETRASO;//Tomamos a cuanto equivale en cargos esos días
            $transaccion = new Transacciones();
            $total += $totalExtra;//Sumamos el extra adicional por retraso si llega a haber
            $result = $transaccion->markAsCancelled($id,$total);//Cambiamos el total de acuerdo a la cantidad de dias extra
            require_once "views/transacciones/list.php";
        }
    }
}