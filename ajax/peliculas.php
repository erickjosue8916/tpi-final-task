<?php
require_once "../config/db.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Peliculas.php";
if (isset($_REQUEST)) {
  $page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
  $limit = (!isset($_GET['limit'])) ? 20 : $_GET['limit'];
  $filter = (!isset($_GET['filter'])) ? [] : $_GET['filter'];
  $sort = (!isset($_GET['sort'])) ? [] : $_GET['sort'];
  $peliculas = new Peliculas();
  $result = $peliculas->list($page, $limit, $filter, $sort);
  $result = json_decode($result, true);
  $html = '<div>';
  foreach ($result['peliculas'] as $pelicula) { 
      $html .= $pelicula['id'] . ' ' . $pelicula['titulo'] . ' ' . $pelicula['descripcion'] . ' ' . $pelicula['stock'] . ' ' . $pelicula['disponibilidad'] . ' ' . $pelicula['reaccion'] . '<br>';
  }
  $html .= '</div>';
  echo $html;
}