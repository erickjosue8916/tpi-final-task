<?php

class ReaccionesController {
    public function __construct()
    {
        
    }

    public function list () {
        require_once "models/Reacciones.php";
        $Reacciones = new Reacciones();
        $result = $Reacciones->list();
        $result = json_decode($result, true);
        //require_once "views/ReaccionesList.php";
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
            //require_once "views/ReaccionesCreate.php";
        } else {
            require_once "models/Reacciones.php";
            $Reacciones = new Reacciones();
            $Reacciones->setIdUsuario($_POST['id_usuario']);
            $Reacciones->setIdPelicula($_POST['id_pelicula']);
            $Reacciones->setReaccion($_POST['reaccion']);

            $result = json_decode($Reacciones->create(),true);
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Reacciones/list");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
            
        }
    }
    
    public function update () {
        require_once "models/Reacciones.php";
        $Reacciones = new Reacciones();
        $result = $Reacciones->list();
        $result = json_decode($result, true);
        //require_once "views/ReaccionesList.php";
    }

    public function changeState(){
        require_once "models/Reacciones.php";
        $reacciones = new Reacciones();
        if (empty($_POST)) {
            $id = $_GET["id"];
            $result = $reacciones->details($id);
            $result = json_decode($result, true);
            require_once "views/reaccionChange.php";//View de prueba de la funcion
        } else {
            $id_usuario = $_POST['id_usuario'];
            $id_pelicula = $_POST['id_pelicula'];
            $result = $reacciones->findUserMovie($id_usuario,$id_pelicula);
            header("location: " .BASE_DIR);
            //var_dump($result);
        }
    }

    public function details () {

        if ($_COOKIE["sessionId"]) {
            session_start();
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }

        require_once "models/Reacciones.php";
        $Reacciones = new Reacciones();
        $result = $Reacciones->details($_GET['id']);
        $result = json_decode($result, true);
        //require_once "views/ReaccionesDetails.php";
    }
    public function delete () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Reacciones.php";
        $Reacciones = new Reacciones();
        $result = $Reacciones->delete($_GET['id']);
        $result = json_decode($result, true);
        header("Location: " . BASE_DIR . "Reacciones/list");
    }
    
}