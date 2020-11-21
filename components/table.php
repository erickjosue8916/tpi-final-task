<?php
  if (isset($config) && $config['headers'] && $config['rows']) {
    $headers = $config['headers'];
    $rows = $config['rows'];
?>
  <table class="table ">
    <thead>
      <tr>
      <?php
        foreach ($headers as $key => $value) {
          ?>
            <th scope="col"><?=$value?></th>
          <?php
        }
      ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $key => $cols) { 
        ?>
        
        <tr>
        <?php foreach ($cols as $key => $col) { ?>
            <td scope="col"><?=$col?></td>
        <?php } ?>
          <!-- <?php
            // if ($_COOKIE['rol'] === 'Administrador') {
            //   echo "<td> <a href='" . BASE_DIR . "Clients/details&id=" . $cols['id'] . "' class=''> visualizar </a> </td>";
            //   echo "<td> <a href='" . BASE_DIR . "Clients/update&id=" . $cols['id'] . "' class=''> editar </a> </td>";
            //   echo "<td> <a href='" . BASE_DIR . "Clients/delete&id=" . $cols['id'] . "' class=''> eliminar </a> </td>";
            // }else {
            //   echo "<td> <a href='" . BASE_DIR . "Clients/details&id=" . $cols['id'] . "' class=''> visualizar </a> </td>";
            // }
          ?> -->
        </tr>
      <?php 
        
      } ?>
    </tbody>
  </table>
<?php } ?>