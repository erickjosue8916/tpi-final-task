<?php

class PeliculasController {
    public function __construct()
    {
        
    }

    public function list () {
        require_once "models/Peliculas.php";
        $page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
        $limit = (!isset($_GET['limit'])) ? 20 : $_GET['limit'];
        $filter = (!isset($_GET['filter'])) ? [] : $_GET['filter'];
        $sort = (!isset($_GET['sort'])) ? [] : $_GET['sort'];
        $peliculas = new Peliculas();
        $result = $peliculas->list($page, $limit, $filter, $sort);
        $result = json_decode($result, true);
        require_once "views/movies/movieList.php";
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
            require_once "views/movies/movieCreate.php";
        } else {
            require_once "models/Peliculas.php";
            $peliculas = new Peliculas();
            $peliculas->setTitulo($_POST['titulo']);
            $peliculas->setDescripcion($_POST['descripcion']);
            $peliculas->setImagen($_FILES['movieImage']['name']);
            $peliculas->setStock($_POST['stock']);
            $peliculas->setPrecioAlquiler($_POST['precio_alquiler']);
            $peliculas->setPrecioVenta($_POST['precio_venta']);
            $peliculas->setDisponibilidad($_POST['disponibilidad']);
            $peliculas->guardarImagen($_FILES['movieImage'][''], $_FILES['movieImage']['name']);
            $result = $Peliculas->create();
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Peliculas/list");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
            
        }
    }
    
    public function update () {
        require_once "models/Peliculas.php";
        $Peliculas = new Peliculas();
        $result = $Peliculas->list();
        $result = json_decode($result, true);
        require_once "views/peliculasList.php";
    }

    public function details () {

        if ($_COOKIE["sessionId"]) {
            session_start();
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }

        require_once "models/Peliculas.php";
        $Peliculas = new Peliculas();
        $result = $Peliculas->details($_GET['id']);
        $result = json_decode($result, true);
        require_once "views/PeliculasDetails.php";
    }
    public function delete () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Peliculas.php";
        $Peliculas = new Peliculas();
        $result = $Peliculas->delete($_GET['id']);
        $result = json_decode($result, true);
        header("Location: " . BASE_DIR . "Peliculas/list");
    }
    
}