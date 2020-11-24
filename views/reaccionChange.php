<?php 
if (isset($result["reacciones"][0])) {
  $reacciones = $result["reacciones"][0];
?>
  <div class="container-fluid bg">

<h2 class="text-center"> Actualizar reacciones </h2>   

<div class="row">
<div class="col-md-4 col-sm-4 col-xs-12"></div>

<div class="col-md-4 col-sm-4 col-xs-12">

        <form class="form-container" action="<?=BASE_DIR?>Reacciones/changeState" method="post">
          <!-- <h2 class="text-center"> PRODUCT DETAILS </h2>  -->
                <div class="form-group">
                  <label for="mid">Usuario:</label>
                  <input type="text" name="id_usuario" value="<?=$reacciones['id_usuario']?>" >
                </div>

                <div class="form-group">
                  <label for="mid">Pelicula:</label>
                  <input type="text" name="id_pelicula" value="<?=$reacciones['id_pelicula']?>" >
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-update">Actualizar</button>
              </form>


</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-12"></div>

</div>

<?php } ?>
