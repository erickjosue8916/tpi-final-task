<?php
  
  if (count($result['clients']) > 0 ) {
    $client = $result['clients'][0];
  
?>
<main class="container h-100 d-flex justify-content-center align-items-center">
  <content>
    <h1>Cliente</h1>
    <?php if (isset($error)) {?>
      <div class="alert bg-danger text-white" role="alert">
        <?=$error;?>
      </div>
    <?php } ?>
      Nombre: <?=$client['nombre']?> <br>
      Appelidos: <?=$client['apellidos']?> <br>
      email: <?=$client['email']?> <br>
      Direccion: <?=$client['direccion']?> <br>
  </content>
</main>

    <?php } else { ?>
      No se econtro cliente
    <?php } ?>