<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ../index.php");
}

?>