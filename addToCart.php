<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_name"], $_POST["user_email"], $_POST["check_in_date"], $_POST["check_out_date"])) {
  
    $property_id = isset($_POST["property_id"]) ? $_POST["property_id"] : null;
    $property_title = isset($_POST["property_title"]) ? $_POST["property_title"] : null;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $check_in_date = $_POST["check_in_date"];
    $check_out_date = $_POST["check_out_date"];


    $price_per_night = isset($_POST["price_per_night"]) ? $_POST["price_per_night"] : null;

    $reservation = [
        'property_id' => $property_id,
        'property_title' => $property_title,
        'price_per_night' => $price_per_night,
        'user_id' => $user_id,
        'user_name' => $user_name,
        'user_email' => $user_email,
        'check_in_date' => $check_in_date,
        'check_out_date' => $check_out_date
    ];

    $_SESSION['cart'][] = $reservation;
    $_SESSION['cart_count'] = count($_SESSION['cart']);

    header("Location: cart.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
