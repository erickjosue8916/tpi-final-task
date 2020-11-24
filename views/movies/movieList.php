<div class="fondo">
<div class="container p-1">
	<div class="row">
		<?php
			$rows = $result['peliculas'];
			foreach ($rows as $key => $data) { ?>
			<div class="col-md-4 container_foto ">
				<div class="ver_mas text-center">
					<span class="lnr lnr-eye"></span>
				</div>
				<article class="text-left">
					<h2><?=$data["titulo"]?></h2>
					<h4><?=$data["descripcion"]?></h4>
				</article>
				<img src="<?=BASE_DIR?>assets/img/movies/<?=$data["imagen"]?>" alt="imagen-pelicula">
			</div>
		<?php } ?>
    </div>
</div>
</div>
