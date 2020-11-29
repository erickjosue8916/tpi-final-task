<?php 
require_once "config/loginVerifier.php";
?>
<div class="fondo2">
  
<main class="container h-100 d-flex  align-items-center">
<div class="formu">
<div class="container-fluid bg ">

    <h2 class="text-center"> Agregar Pelicula </h2>   
    
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12"></div>

    <div class="col-md-4 col-sm-4 col-xs-12 ">

            <form class="form-container" action="" method="post" enctype="multipart/form-data">
              <!-- <h2 class="text-center"> PRODUCT DETAILS </h2>  -->
                    <div class="form-group">
                      <label for="mid">Titulo:</label>
                      <input type="text" name="titulo" class="form-control" id="mid" placeholder="Titulo">
                    </div>

                    <div class="form-group">
                      <label for="mdate">Descripcion</label>
                      <textarea type="text" name="descripcion" class="form-control" id="mdate" placeholder="Descripcion" ></textarea>
                    </div>

                    <div class="form-group">
                      <label for="">Imagen</label>
                      <input type="file" name="movieImage" class="form-control-file" id="">
                      
                    </div>

                    <div class="form-group">
                        <label for="mlot">Stock</label>
                        <input type="text" class="form-control" name="stock" id="mlot" placeholder="Stock">
                    </div>

                    <div class="form-group ">
                      <div class="row">
                        <div class="col">
                          <label for="mlot">Precio de alquiler</label>
                          <input type="text" name="precio_alquiler" class="form-control" id="precios" placeholder="Precio de alquiler">
                        </div>
                        <div class="col">
                          <label for="mlot">Precio de venta</label>
                          <input type="text" name="precio_venta" class="form-control" id="precios" placeholder="Precio de venta">
                        </div>
                      </div>
                  </div>
                  <!--<div class="form-group">
                    <label for="mlot">Disponibilidad</label>
                    <input type="text" name="disponibilidad" class="form-control" id="mlot" placeholder="Disponibilidad">
                </div>-->

                    <button type="submit" class="btn btn-primary btn-block btn-create">Agregar</button>
                  </form>


    </div>
</div>
<div class="col-md-4 col-sm-4 col-xs-12"></div>
    
</div>
</div>
</main>
</div>