<?php
    session_start();

    unset($_SESSION['coduser']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['admin']);

    header('location: /');
?>