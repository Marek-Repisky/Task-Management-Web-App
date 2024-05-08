<?php
require_once('../partials/header.php');
require_once('../_inc/functions.php');
?>
<div class="selectDiv">
<form action="../_inc/updateTable.php" method="post">
  <input list="browsers" class="txtarea nadpis" name="UpdatedTitle" placeholder="Nadpis...">
      <datalist id="browsers">
      <?php
        GetTitles("List_Database", "List_Table")
      ?>
      </datalist>
</div>

  <section class="list_wrapper">
    <article class="list">
        <textarea class="txtarea nadpis" name="title" cols="39" rows="1" placeholder="Nadpis..."></textarea>
        <textarea class="txtarea opis" name="description" cols="39" rows="1" placeholder="Opis..."></textarea>
        <section class="zoznam_riadok">
          <div class="poradie">1.</div>
          <textarea class="txtarea zoznam" name="listItem" cols="39" rows="1" placeholder="Prvok..."></textarea>
        </section>
        <button type="submit" class="pridat_prvok">Aktualizovať</button>
      </form>
    </article>
  </section>

<?php
  include_once('../partials/footer.php');
?>