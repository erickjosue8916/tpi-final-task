<?php

class ReaccionesController {
    public function __construct()
    {
        
    }

    //Lista todas las reacciones que existen en la tabla
    public function list () {
        require_once "models/Reacciones.php";
        $Reacciones = new Reacciones();
        $result = $Reacciones->list();
        $result = json_decode($result, true);
        //require_once "views/ReaccionesList.php";
    }

    //Crea una nueva reacción con los datos proporcionados
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

    //Si la reaccion no existe la crea, si esta existe entonces la elimina
    public function changeState(){
        require_once "models/Reacciones.php";
        $reacciones = new Reacciones();
        //Tomamos los datos del usuario que dio like y la pelicula a la que le dio like
        $id_usuario = $_POST['id_usuario'];
        $id_pelicula = $_POST['id_pelicula'];
        //Creamos o eliminamos la reaccion y obtenemos si el proceso fue exitoso
        $result = $reacciones->findUserMovie($id_usuario,$id_pelicula);
        header("location: " .BASE_DIR);//Redireccionamos a home
    }

    //Obtiene los datos de una transaccion con datos del get
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

    //Borra una reaccion con el dato que obtenga del get
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