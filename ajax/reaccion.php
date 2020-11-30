<?php
require_once "../config/configControllers.php";
require_once "../config/db.php";
require_once "../config/configControllers.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Reacciones.php";
if (isset($_REQUEST)) {
	$pelicula_id = (!isset($_GET['pelicula_id'])) ? 0 : $_GET['pelicula_id'];
	if ($pelicula_id !== 0) {
        $reacciones = new Reacciones();
        $id_usuario = isset($_COOKIE['id_usuario']) ? $_COOKIE['id_usuario'] : -1;
	    $result = $reacciones->findUserMovie($id_usuario,$pelicula_id);
    }
    echo "Pelicula Id : $pelicula_id";
}
