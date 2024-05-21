<?php
include_once('../partials/header.php');
require_once('../_inc/functions.php');
require_once('../config.php');
?>
  
  <section class="list_wrapper">
      <?php
        ReadFromTable();
      ?>
  </section>

<?php
  include_once('../partials/footer.php');
?>