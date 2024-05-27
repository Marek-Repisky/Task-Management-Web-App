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
<div class="selectDiv">
  <form action="../_inc/deleteTable.php" method="post" class="deleteForm">
    <input list="browsers" class="txtarea nadpis" name="UpdatedTitle" placeholder="Nadpis...">
    <datalist id="browsers">
      <?php
      // Check if the user is authenticated
      if ($userAuth->isAuthenticated()) {
          // Retrieve the titles of for the authenticated user
          $titles = $toDoList->getTitles($userAuth->getUserId());
          // Loop through the titles and display them as options in the datalist
          foreach ($titles as $title) {
              // Escape special characters in the title
              echo '<option value="' . htmlspecialchars($title['Title'], ENT_QUOTES, 'UTF-8') . '">';
          }
      }
      ?>
    </datalist>
    
    <button type="submit" class="button">Vymazať</button>
  </form>
</div>

<?php
  include_once('../partials/footer.php');
?>
