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
  $usuarioId = (isset($_REQUEST["id_usuario"])) ? $_REQUEST["id_usuario"] : 0;
  $detalleTransaccion = (isset($_REQUEST["detalle"])) ? $_REQUEST["id_usuario"] : 0;
  
  $transaction = new Transacciones();
  $transaction->setFecha($fecha);
  $transaction->setTotal($total);
  $transaction->setIdUsuario($usuarioId);
  $transaction->setEstado($estado);
  $transaction->setTipo($tipo);

  $result = $transaction->create();

  if ($tipo == 'Compra') {
    foreach ($detalleTransaccion as $detalle) { 
      $compra = new Compras();
      $compra->setIdTransaccion(1);
      $compra->setIdPelicula($detalle["pelicula_id"]);
      $compra->setCantidad($detalle["cantidad_id"]);
    }
  } else {
    foreach ($detalleTransaccion as $detalle) { 
      $compra = new Alquileres();
      $compra->setIdTransaccion(1);
      $compra->setIdPelicula($detalle["pelicula_id"]);
      $compra->setCantidad($detalle["cantidad_id"]);
      $compra->setFecha(1);
    }
  }
  // $result = json_decode($result, true);
  $html = '<div>';
  
  $html .= '</div>';
  echo $html;
}