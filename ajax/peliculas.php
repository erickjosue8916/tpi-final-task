<?php
require_once "../config/configControllers.php";
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
  $html = '';
  foreach ($result['peliculas'] as $pelicula) { 
      $html .= "<div class='col-md-4 container_foto '>
      <div class='ver_mas text-center'>
        <span class='lnr lnr-eye'></span>
      </div>
      <article class='text-left'>
        <h2> " . $pelicula["titulo"] . "</h2>
        <h4> " . $pelicula["descripcion"] . "</h4>
      </article>
      <img src='" .BASE_DIR . "assets/img/movies/" . $pelicula["imagen"] ."' alt='imagen-pelicula'>
    </div>";
  }
  $html .= '';
  echo $html;
}