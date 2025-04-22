<?php
    include 'connect.php';

    setcookie('vendor_id', '', time() - 1, '/');
    header('location: ../admin panel/login.php');
?>