<?php 
if (isset($result["transacciones"][0])) {
  $transacciones = $result["transacciones"][0];
?>
  <div class="container-fluid bg">

<h2 class="text-center"> Actualizar transacciones </h2>   

<div class="row">
<div class="col-md-4 col-sm-4 col-xs-12"></div>

<div class="col-md-4 col-sm-4 col-xs-12">

        <form class="form-container" action="<?=BASE_DIR?>Transacciones/changeState" method="post">
          <!-- <h2 class="text-center"> PRODUCT DETAILS </h2>  -->
          <input type="text" hidden='true' name="id_transaccion" value="<?=$transacciones['id_transaccion']?>" >
                <div class="form-group">
                  <label for="mid">Titulo:</label>
                  <select name="estado">
                    <option value="Cancelado" <?=$transacciones['estado'] == 'Cancelado' ? ' selected="selected"' : '';?>>Cancelado</option>
                    <option value="Pendiente" <?=$transacciones['estado'] == 'Pendiente' ? ' selected="selected"' : '';?>>Pendiente</option>
                  </select>
                  <!--<input type="text" class="form-control" id="mid" placeholder="Titulo" name="estado" value="<?=$transacciones['estado']?>" >-->
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-update">Actualizar</button>
              </form>


</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-12"></div>

</div>

<?php } ?>
