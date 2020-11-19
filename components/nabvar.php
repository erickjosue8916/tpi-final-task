<?php 
  if (isset($config)) {
    $logo = isset($config['logo']) ? $config['logo'] : null;
    $brand = isset($config['brand']) ? $config['brand'] : null;
?>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <?php if (isset($brand)) { ?>
        <a class="navbar-brand" href="#">
        <?php if (isset($logo)) { ?>
            <img src="<?=BASE_DIR?>assets/<?=$logo?>" alt="" width="30" height="24" class="d-inline-block ">
        <?php } echo $brand;?>
        </a>
      <?php } ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
<?php } ?>