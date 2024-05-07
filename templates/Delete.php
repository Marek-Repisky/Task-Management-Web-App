<?php
require_once('../partials/header.php');
require_once('../_inc/functions.php');
?>
<div class="selectDiv">
  <form action="../_inc/deleteTable.php" method="post" class="deleteForm">
    <input list="browsers" class="txtarea nadpis" name="UpdatedTitle" placeholder="Nadpis...">
      <datalist id="browsers">
        <?php
          GetTitles("List_Database", "List_Table")
        ?>
      </datalist>
    <button type="submit" class="button">Vymazať</button>
  </form>
</div>

<?php
  include_once('../partials/footer.php');
?>