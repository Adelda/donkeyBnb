<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reservation_key"], $_POST["new_user_name"], $_POST["new_user_email"], $_POST["new_check_in_date"], $_POST["new_check_out_date"])) {
    $reservation_key = $_POST["reservation_key"];
    $new_user_name = $_POST["new_user_name"];
    $new_user_email = $_POST["new_user_email"];
    $new_check_in_date = $_POST["new_check_in_date"];
    $new_check_out_date = $_POST["new_check_out_date"];


    if (isset($_SESSION['cart'][$reservation_key])) {
        $_SESSION['cart'][$reservation_key]['user_name'] = $new_user_name;
        $_SESSION['cart'][$reservation_key]['user_email'] = $new_user_email;
        $_SESSION['cart'][$reservation_key]['check_in_date'] = $new_check_in_date;
        $_SESSION['cart'][$reservation_key]['check_out_date'] = $new_check_out_date;

        $_SESSION['cart_message'] = "Réservation mise à jour avec succès.";
    } else {
        $_SESSION['cart_message'] = "Erreur lors de la mise à jour de la réservation.";
    }

    header("Location: cart.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
