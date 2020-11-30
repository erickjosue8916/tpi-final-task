<?php

class PeliculasController {
    public function __construct()
    {
        
    }

    //Lista todas las peliculas de acuerdo a un filtro y orden especificado
    public function list () {
        require_once "models/Peliculas.php";
        $page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
        $limit = (!isset($_GET['limit'])) ? 20 : $_GET['limit'];
        $filter = (!isset($_GET['filter'])) ? [] : $_GET['filter'];
        $sort = (!isset($_GET['sort'])) ? [] : $_GET['sort'];
        $peliculas = new Peliculas();
        $result = $peliculas->list($page, $limit, $filter, $sort);
        //retorna la lista de peliculas que cumplen con el sql creado
        $result = json_decode($result, true);
        require_once "views/movies/movieList.php";
    }
    
    //Lista las peliculas para un administrador con campos extra que solo un admin puede ver
    public function listAdmin () {
        require_once "models/Peliculas.php";
        $page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
        $limit = (!isset($_GET['limit'])) ? 20 : $_GET['limit'];
        $filter = (!isset($_GET['filter'])) ? [] : $_GET['filter'];
        $sort = (!isset($_GET['sort'])) ? [] : $_GET['sort'];
        $peliculas = new Peliculas();
        $result = $peliculas->listAdmin($page, $limit, $filter, $sort);
        $result = json_decode($result, true);
        require_once "views/movies/movieListAdmin.php";
    }

    //Crea una nueva pelicula con valores desde POST
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
            $peliculas->setImagen($_FILES['movieImage']['name']);//Tomamos el nombre del archivo de la imagen
            $peliculas->setStock($_POST['stock']);
            $peliculas->setPrecioAlquiler($_POST['precio_alquiler']);
            $peliculas->setPrecioVenta($_POST['precio_venta']);
            $disponibilidad = $_POST['stock'] > 0 ? "Available" : "Unavailable";
            $peliculas->setDisponibilidad($disponibilidad);
            
            //Intentamos guardas la imagen en la carpeta de imagenes de peliculas
            $isSaveImageSucces = $peliculas->guardarImagen($_FILES['movieImage']['tmp_name'], $_FILES['movieImage']['name']);
            if (!$isSaveImageSucces) {
                //Si no se encontro la imagen imprime un error
                $error = "invalid imageFile";
                echo $error;
                require_once "views/movies/movieCreate.php";
            } else {
                //Si la imagen se guardo correctamente crea la pelicula y redirecciona a la lista de peliculas
                $result = json_decode($peliculas->create(),true);
                if ($result['success']) {
                    header("Location: " . BASE_DIR . "Peliculas/list&id_peliculas=".$result['id_pelicula']);
                } else {
                    $error = $result['error'];
                    require_once "views/movies/movieCreate.php";
                }
            }
        }
    }
    
    //Actualiza los datos de una pelicula
    public function update () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'Administrador') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Peliculas.php";
        if (empty($_POST)) {
            $id = $_GET["id"];
            $peliculas = new Peliculas();
            $result = $peliculas->details($id);
            $result = json_decode($result, true);
            require_once "views/movies/movieUpdate.php";
        } else {
            
            $peliculas = new Peliculas();
            $id = $_POST["id_pelicula"];
            $peliculas->setTitulo($_POST['titulo']);
            $peliculas->setDescripcion($_POST['descripcion']);
            $peliculas->setStock($_POST['stock']);
            $peliculas->setPrecioAlquiler($_POST['precio_alquiler']);
            $peliculas->setPrecioVenta($_POST['precio_venta']);
            $disponibilidad = $_POST['stock'] > 0 ? "Available" : "Unavailable";
            $peliculas->setDisponibilidad($disponibilidad);
            
            $result = $peliculas->update($id);
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Peliculas/listAdmin");
            } else {
                $error = $result['error'];
                require_once "views/movies/movieCreate.php";
            } 
        }
    }

    //Obtiene los datos de una pelicula con datos del get
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

    //Borra una pelicula con el id obtenido por get
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
        header("Location: " . BASE_DIR . "Peliculas/listAdmin");
    }
    
}