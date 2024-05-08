<?php
require_once('../partials/header.php');
require_once('../_inc/functions.php');
?>
  
  <section class="list_wrapper">
      <?php
        ReadFromTable("List_Database", "List_Table")
      ?>
  </section>

<?php
  include_once('../partials/footer.php');
?>