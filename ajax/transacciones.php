<?php
require_once "../config/db.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Peliculas.php";
if (isset($_REQUEST)) {
  $date = (isset($_REQUEST['fecha'])) ? $_REQUEST['fecha']: '2020-11-23';
  $total = (isset($_REQUEST['transaction'])) ? $_REQUEST['total']: 0;
  $estado = (isset($_REQUEST['estado'])) ? $_REQUEST['estado']: 'Cancelado';
  $tipo = (isset($_REQUEST['tipo'])) ? $_REQUEST['tipo']: 'Compra';

  $peliculas = new Peliculas();
  $result = $peliculas->list($page, $limit, $filter, $sort);
  $result = json_decode($result, true);
  $html = '<div>';
  
  $html .= '</div>';
  echo $html;
}