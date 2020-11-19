
<div class="btn-group">
  <button type="button" class="btn btn-danger"><?=$buttonName?></button>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <?php
      foreach ($options as $key => $link) { 

      ?>
        <li><a class="dropdown-item" href="<?=BASE_DIR . $link['source'] ?>"><?=$link['name']?></a></li>
      <?php
      }
    ?>
  </ul>
</div>