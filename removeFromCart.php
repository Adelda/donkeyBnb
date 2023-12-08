<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reservation_key"])) {
    $reservation_key = $_POST["reservation_key"];

    unset($_SESSION['cart'][$reservation_key]);

    $_SESSION['cart_count'] = count($_SESSION['cart']);

    header("Location: cart.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
