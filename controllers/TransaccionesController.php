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
        require_once "views/transaccionesList.php";
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
            
            $result = json_decode($Transacciones->create(),true);
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Transacciones/list&id_transacciones=".$result['id_transaccion']);
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

    public function changeState(){
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/transacciones.php";
        if (empty($_POST)) {
            $id = $_GET["id"];
            $transacciones = new Transacciones();
            $result = $transacciones->details($id);
            $result = json_decode($result, true);
            require_once "views/transaccionesUpdate.php";
        } else {
            
            $transacciones = new transacciones();
            $id = $_POST["id_transaccion"];
            $transacciones->setEstado($_POST['estado']);
            
            $result = $transacciones->changeState($id);
            if ($result['success']) {
                header("Location: " . BASE_DIR . "transacciones/list");
            } else {
                $error = $result['error'];
                require_once "views/transaccionesList.php";
            } 
        }
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