
<?php
if ($_COOKIE["sessionId"]) {
  session_start();
} else {
  header("Location: "  . BASE_DIR . "Users/login");
}
?>
<div class="fondo">
<main class="container h-100 d-flex justify-content-center align-items-center">
    <div class="tamaño">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <video  src="<?=BASE_DIR?>assets/img/carrousel/1.mp4" width="100%" height="100%" autoplay  controlls loop>
  </video>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=BASE_DIR?>assets/img/carrousel/img2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <a href="<?=BASE_DIR?>Users/register">
      <img class="d-block w-100" src="<?=BASE_DIR?>assets/img/carrousel/3.png" alt="Third slide">
      </a>
      
    </div>
    <div class="carousel-item">
    <video  src="<?=BASE_DIR?>assets/img/carrousel/video2.mp4" width="100%" height="100%" controls>
  </video>
      
    </div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>



</main>

</div>