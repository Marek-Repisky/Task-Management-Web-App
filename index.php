<?php
require_once('partials/header.php');
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>To do List</title>
</head>
<body>
  <ul class="topnav">
    <li><a class="active" href="#">1. Podstranka</a></li>
    <li><a href="#">2. Podstranka</a></li>
    <li><a href="#">3. Podstranka</a></li>
    <li class="right"><a href="#">4. Podstranka</a></li>
  </ul>

  <header>
    <h1>To do List</h1>
    <button class="button">New list</button>  
  </header>
  
  <section class="list_wrapper">
    <article class="list">
      <textarea class="txtarea" name="title" id="nadpis" cols="39" rows="1" placeholder="Nadpis..."></textarea>
      <textarea class="txtarea" name="text" id="opis" cols="39" rows="1" placeholder="Opis..."></textarea>
      <section class="zoznam_riadok">
        <div class="poradie">1.</div>
        <textarea class="txtarea" name="ls" id="zoznam" cols="39" rows="1" placeholder="Prvok..."></textarea>
      </section>
      <?php
        require('_inc/functions.php');
          /*if (isset($_GET['pridat'])) {
              myFunction();
          }*/
          if(array_key_exists('pridat',$_POST)){
            for ($i=2; $i<2+3; $i++){
                pridatFunc($i);
            }
         }
        ?>

        <!--<button class="pridat_prvok">Pridať</input>-->
        <section class="zoznam_pridat .zoznam_riadok">
          <form method="post">
            <input type="number" name="pocet" class="poradie" id="vyberPocet">
            <input type="submit" name="pridat" value="Pridať riadky" class="pridat_prvok">
          </form>
      </section>
    </article>
  </section>

  <script src="scripts/script.js"></script>

<?php
  include_once('partials/footer.php');
  ?>