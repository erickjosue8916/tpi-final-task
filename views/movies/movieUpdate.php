<?php 
require_once "config/loginVerifier.php";
if (isset($result["peliculas"][0])) {
  $pelicula = $result["peliculas"][0];
?>
  <div class="container-fluid bg">

<h2 class="text-center"> Actualizar Pelicula </h2>   

<div class="row">
<div class="col-md-4 col-sm-4 col-xs-12"></div>

<div class="col-md-4 col-sm-4 col-xs-12">

        <form class="form-container opacity_fond" action="<?=BASE_DIR?>Peliculas/update" method="post">

          <!-- <h2 class="text-center"> PRODUCT DETAILS </h2>  -->
          <input type="text" hidden='true' name="id_pelicula" value="<?=$pelicula['id_pelicula']?>" >
                <div class="form-group">
                  <label for="mid">Titulo:</label>
                  <input type="text" class="form-control" id="mid" placeholder="Titulo" name="titulo" value="<?=$pelicula['titulo']?>" >
                </div>

                <div class="form-group">
                  <label for="mdate">Descripcion</label>
                  <textarea type="text" class="form-control" id="mdate" placeholder="Descripcion" name="descripcion"><?=$pelicula['descripcion']?></textarea>
                </div>

                <div class="form-group">
                    <label for="mlot">Stock</label>
                    <input type="text" class="form-control" id="mlot" placeholder="Stock" name="stock" value="<?=$pelicula['stock']?>">
                </div>

                <div class="form-group ">
                  <div class="row">
                    <div class="col">
                      <label for="mlot">Precio de alquiler</label>
                      <input type="text" class="form-control" id="precios" name="precio_alquiler" value="<?=$pelicula['precio_alquiler']?>" placeholder="Precio de alquiler">
                    </div>
                    <div class="col">
                      <label for="mlot">Precio de venta</label>
                      <input type="text" class="form-control" id="precios" name="precio_venta"  value="<?=$pelicula['precio_venta']?>" placeholder="Precio de venta">
                    </div>
                  </div>
                 
              </div>
              <div class="form-group">
                <label for="mlot">Disponibilidad</label>
                <input type="text" class="form-control" id="mlot" name="disponibilidad" value="<?=$pelicula['disponibilidad']?>" placeholder="Disponibilidad">
            </div>

                <button type="submit" class="btn btn-primary btn-block btn-update">Actualizar</button>
              </form>


</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-12"></div>

</div>
<?php

} else
  {
   echo "<div class='alert alert-success' role='alert'>
  No se ha encontrado la Pelicula<br><a href='". BASE_DIR . " Peliculas/list'>Regresar a Pelicula</a></div>";
  }
?>

