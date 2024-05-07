<?php
require_once('partials/header.php');
?>
  
  <section class="list_wrapper">
      <?php
        require_once('_inc/functions.php');

        ReadFromTable("ListDatabase", "ListTable")
      ?>
  </section>

<?php
  include_once('partials/footer.php');
?>