<?php
require_once "../config/db.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Transacciones.php";
require_once "../models/Alquileres.php";
require_once "../models/Compras.php";

if (isset($_REQUEST)) {
  $exampleTransaction = [[]];
  $fecha = (isset($_REQUEST['fecha'])) ? $_REQUEST['fecha']: '2020-11-23';
  $total = (isset($_REQUEST['transaction'])) ? $_REQUEST['total']: 0;
  $estado = (isset($_REQUEST['estado'])) ? $_REQUEST['estado']: 'Cancelado';
  $tipo = (isset($_REQUEST['tipo'])) ? $_REQUEST['tipo']: 'Compra';
  $detailsTransaccion = (isset($_REQUEST["details"])) ? $_COOKIE['id_usuario'] : 0;
  $transaction = new Transacciones();
  $transaction->setFecha($fecha);
  $transaction->setTotal($total);
  $transaction->setIdUsuario($_COOKIE['id_usuario']);
  $transaction->setEstado($estado);
  $transaction->setTipo($tipo);
  $result = $transaction->create();
  $result = json_decode($result, true);
  var_dump($_REQUEST["details"]);
  if ($tipo == 'Compra') {
    foreach ($detailsTransaccion as $details) { 
      $compra = new Compras();
      $compra->setIdTransaccion(1);
      $compra->setIdPelicula($details["pelicula_id"]);
      $compra->setCantidad($details["cantidad_id"]);
    }
  } else {
    foreach ($detailsTransaccion as $details) { 
      $compra = new Alquileres();
      $compra->setIdTransaccion(1);
      $compra->setIdPelicula($details["pelicula_id"]);
      $compra->setCantidad($details["cantidad_id"]);
      $compra->setFecha(1);
    }
  }
  echo $result;
}