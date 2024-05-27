<?php
    include_once('../partials/header.php');
    require_once('../config.php');
    require_once('../_inc/App.php');

    // Load the configuration settings
    $config = include('../config.php');
    $app = new ToDoApp($config);
    $toDoList = $app->getToDoList();
    $userAuth = $app->getUserAuth();
?>
<section class="list_wrapper">
  <?php
  // Check if the user is authenticated
  if ($userAuth->isAuthenticated()) {
      // Retrieve the lists for the authenticated user
      $lists = $toDoList->readLists($userAuth->getUserId());
      // Check if there are any lists
      if (!empty($lists)) {
          // Loop through the lists and display each one
          foreach ($lists as $list) {
              echo '<article class="list">';
              // Display the title of the list
              echo '<div class="txtarea nadpis">' . htmlspecialchars($list['Title'], ENT_QUOTES, 'UTF-8') . '<br></div>';
              // Display the description of the list
              echo '<div class="txtarea opis">' . htmlspecialchars($list['Description'], ENT_QUOTES, 'UTF-8') . '<br></div>';
              echo '<section class="zoznam_riadok">';
              // Display the list items
              echo '<div class="poradie">1.</div>';
              echo '<div class="txtarea zoznam">' . htmlspecialchars($list['ListItem'], ENT_QUOTES, 'UTF-8') . '<br></div>';
              echo '</section>';
              echo '</article>';
          }
      }
      else echo "Žiadne listy";
  }
  else echo "Prosím prihláste sa aby ste videli svoje listy.";
  ?>
</section>

<?php
    include_once('../partials/footer.php');
?>
