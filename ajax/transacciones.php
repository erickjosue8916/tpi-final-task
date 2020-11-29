<?php
require_once "../config/db.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Transacciones.php";
require_once "../models/Alquileres.php";
require_once "../models/Compras.php";
require_once "../models/Peliculas.php";


if (isset($_REQUEST)) {
  
  $datos = json_decode($_REQUEST['data'], true);
  //var_dump($datos);
  $fecha = (isset($datos['fecha'])) ? $datos['fecha']: '2020-11-23';
  $fechaEntrega = (isset($datos['fechaEntrega'])) ? $datos['fechaEntrega']: '2020-11-23';
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

  foreach ($detailsTransaccion as $details) {//Por cada pelicula que el usuario selecciono
    $pelicula = new Peliculas();
    $resultP = json_decode($pelicula->details($details["id_pelicula"]),true);//Obtenemos los datos de esa pelicula

    // Seteamos los datos de la pelicula que se obtuvo
    $pelicula->setTitulo($resultP['peliculas'][0]['titulo']);
    $pelicula->setDescripcion($resultP['peliculas'][0]['descripcion']);
    $pelicula->setStock($resultP['peliculas'][0]['stock'] - 1);//Le quitamos uno al stock
    $pelicula->setPrecioAlquiler($resultP['peliculas'][0]['precio_alquiler']);
    $pelicula->setPrecioVenta($resultP['peliculas'][0]['precio_venta']);
    $pelicula->setDisponibilidad($resultP['peliculas'][0]['disponibilidad']);
    
    if ($tipo == 'Compra' && $pelicula->getStock() >= 0) {//Si la transaccion es de tipo compras y aun hay stock de esa pelicula
      $compra = new Compras();
      $compra->setIdTransaccion($result['id_transaccion']);
      $compra->setIdPelicula($details["id_pelicula"]);
      $compra->setCantidad(1);
      $compra->create();//Creamos una compra
    } else if ($tipo == 'Alquiler' && $pelicula->getStock() >= 0) {//Si la transaccion es de tipo compras y aun hay stock de esa pelicula
      $alquiler = new Alquileres();
      $alquiler->setIdTransaccion($result['id_transaccion']);
      $alquiler->setIdPelicula($details["id_pelicula"]);
      $alquiler->setCantidad(1);
      $alquiler->setFecha($fecha);
      $alquiler->create();//Creamos un alquiler
    }else if ($tipo == 'Compra'){
      $totalFinal = $transaction->getTotal() - $pelicula->getPrecioVenta();//Le restamos el valor de la pelicula que no se facturada
      $transaction->setTotal($totalFinal);
      $transaction->update($result['id_transaccion']);
    }else if ($tipo == 'Alquiler'){
      $totalFinal = $transaction->getTotal() - $pelicula->getPrecioAlquiler();//Le restamos el valor de la pelicula que no se facturada
      $transaction->setTotal($totalFinal);
      $transaction->update($result['id_transaccion']);
    }
    
    if($pelicula->getStock() <= 0){
      $pelicula->setStock(0);
      $pelicula->setDisponibilidad('Unavailable');//Si ya no hay stock, entonces deja de estar disponible
    }

    $pelicula->update($details["id_pelicula"]);//Actualizamos la tabla con la nueva cantidad de stock de la pelicula
  }
  // echo $result;
}