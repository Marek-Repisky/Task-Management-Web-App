<?php
    // Expire the cookie by setting its expiration time to the past
    setcookie('User_Id', '', time() - 3600, '/');
    echo 'Som tu';
    header("Location: ../index.php");
    die("Nepodarilo sa nájsť Domovskú stránku");
    
?>