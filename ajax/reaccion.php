<?php
require_once "../config/configControllers.php";
require_once "../config/db.php";
require_once "../config/configControllers.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Peliculas.php";
if (isset($_REQUEST)) {
	$pelicula_id = (!isset($_GET['pelicula_id'])) ? 0 : $_GET['pelicula_id'];
	if ($pelicula_id !== 0) {
        $peliculas = new Peliculas();
	    // $result = $peliculas->list($page, $limit, $filter, $sort);
    }
    echo "Pelicula Id : $pelicula_id";
}
