<?php
require_once "../config/db.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Transacciones.php";
require_once "../models/Alquileres.php";
require_once "../models/Compras.php";

if (isset($_REQUEST)) {
  $datos = json_decode($_REQUEST['data'], true);
  var_dump($datos);
  $fecha = (isset($datos['fecha'])) ? $datos['fecha']: '2020-11-23';
  $total = (isset($datos['total'])) ? $datos['total']: 0;
  $estado = (isset($datos['estado'])) ? $datos['estado']: 'Cancelado';
  $tipo = (isset($datos['tipo'])) ? $datos['tipo']: 'Compra';
  $detailsTransaccion = (isset($datos["details"])) ? $datos['details'] : 0;
  $transaction = new Transacciones();
  $transaction->setFecha($fecha);
  $transaction->setTotal($total);
  $transaction->setIdUsuario($_COOKIE['id_usuario']);
  $transaction->setEstado($estado);
  $transaction->setTipo($tipo);
  $result = $transaction->create();
  $result = json_decode($result, true);
  var_dump($result);
  if ($tipo == 'Compra') {
    foreach ($detailsTransaccion as $details) { 
      $compra = new Compras();
      $compra->setIdTransaccion($result['id_transaccion']);
      $compra->setIdPelicula($details["id_pelicula"]);
      $compra->setCantidad(1);
      $compra->create();
    }
  } else {
    foreach ($detailsTransaccion as $details) { 
      $alquiler = new Alquileres();
      $alquiler->setIdTransaccion($result['id_transaccion']);
      $alquiler->setIdPelicula($details["id_pelicula"]);
      $alquiler->setCantidad(1);
      $alquiler->setFecha($fecha);
      $alquiler->create();
    }
  }
  // echo $result;
}