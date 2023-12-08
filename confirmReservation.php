<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('header.php');
include('link.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reservation_key"])) {
    $reservation_key = $_POST["reservation_key"];

    if (isset($_SESSION['cart'][$reservation_key])) {
        $_SESSION['cart'][$reservation_key]['confirmed'] = 1;
        $_SESSION['cart_message'] = "Réservation confirmée avec succès.";

        $property_id = $_SESSION['cart'][$reservation_key]['property_id'];
        $user_id = $_SESSION['user_id'];
        $check_in_date = $_SESSION['cart'][$reservation_key]['check_in_date'];
        $check_out_date = $_SESSION['cart'][$reservation_key]['check_out_date'];
        $guest_count = $_SESSION['cart'][$reservation_key]['guest_count'];
        $total_cost = $_SESSION['cart'][$reservation_key]['total_cost'];

        $insert_reservation_query = $pdo->prepare("INSERT INTO reservations (user_id, property_id, check_in_date, check_out_date, guest_count, total_cost, status, confirmed, reservation_date)
                                                  VALUES (?, ?, ?, ?, ?, ?, 'confirmed', 1, NOW())");
        $insert_reservation_query->execute([$user_id, $property_id, $check_in_date, $check_out_date, $guest_count, $total_cost]);
    } else {
        $_SESSION['cart_message'] = "Erreur lors de la confirmation de la réservation.";
    }
    header("Location: cart.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}

?>

<?php include('footer.php'); ?>
