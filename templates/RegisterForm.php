<?php
include_once('../partials/registerHeader.php');
?>

<section class="list_wrapper">
  <form action="../_inc/register.php" method="post" class="list">
      <h2>Registrácia</h2>
      
      <label for="username">Používateľské meno</label><br>
      <input type="text" name="username" id="username" required><br>
      
      <label for="email">Email:</label><br>
      <input type="email" name="email" id="email" required><br>

      <label for="password">Heslo:</label><br>
      <input type="password" name="password" id="password" required><br>

      <label for="password2">Heslo znova:</label><br>
      <input type="password" name="password2" id="password2" required><br>

      <input type="checkbox" name="agree" id="agree" value="yes" required>
      <label for="agree">Súhlasím s <a href="https://en.wikipedia.org/wiki/Terms_of_service">podmienkami služieb</a></label><br>

      <button type="submit" class="registerBtn">Registrovať sa</button>
      <div>Už máte účet? <a href="LoginForm.php">Prihláste sa tu</a></div>
  </form>
</section>

<?php
include_once('../partials/footer.php');
?>
