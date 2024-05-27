<?php
include_once('../partials/header.php');
require_once('../config.php');
require_once('../_inc/App.php');

$config = include('../config.php');
$app = new ToDoApp($config);
$toDoList = $app->getToDoList();
$userAuth = $app->getUserAuth();

?>
<section class="list_wrapper">
  <?php
  if ($userAuth->isAuthenticated()) {
      $lists = $toDoList->readLists($userAuth->getUserId());
      if (!empty($lists)) {
          foreach ($lists as $list) {
              echo '<article class="list">';
              echo '<div class="txtarea nadpis">' . htmlspecialchars($list['Title'], ENT_QUOTES, 'UTF-8') . '<br></div>';
              echo '<div class="txtarea opis">' . htmlspecialchars($list['Description'], ENT_QUOTES, 'UTF-8') . '<br></div>';
              echo '<section class="zoznam_riadok">';
              echo '<div class="poradie">1.</div>';
              echo '<div class="txtarea zoznam">' . htmlspecialchars($list['ListItem'], ENT_QUOTES, 'UTF-8') . '<br></div>';
              echo '</section>';
              echo '</article>';
          }
      } else {
          echo "Žiadne listy";
      }
  } else {
      echo "Please log in to view your lists.";
  }
  ?>
</section>

<?php
include_once('../partials/footer.php');
?>
