<?php

session_start();

if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>