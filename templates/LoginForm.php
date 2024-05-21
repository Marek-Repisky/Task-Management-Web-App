<?php
include_once('../partials/registerHeader.php');
require_once('../_inc/functions.php');
?>
  
  <section class="list_wrapper">
    <form action="../_inc/register.php" method="post" class="list">
        <h2>Prihlásenie</h2>
        
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email"><br>

        <label for="password">Heslo:</label><br>
        <input type="password" name="password" id="password"><br>

        <button type="submit" class="registerBtn">Prihlásiť sa</button>
        <div>Nemáte ešte účet? <a href="RegisterForm.php">Registrujte sa tu</a></div>
    </form>
  </section>

<?php
  include_once('../partials/footer.php');
?>