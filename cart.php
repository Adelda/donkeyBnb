<?php
include('header.php');
include('link.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$cartItemCount = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;

if (isset($_SESSION['cart'])) {
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 text-center">Panier</h1>
                <p class="lead text-center">Nombre d'articles dans le panier : <?php echo $cartItemCount; ?></p>

                <?php
                if (isset($_SESSION['cart_message'])) {
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['cart_message'] . '</div>';
                    unset($_SESSION['cart_message']);
                }
                ?>

                <ul class="list-group">
                    <?php foreach ($_SESSION['cart'] as $reservation_key => $reservation) : ?>
                        <li class="list-group-item">

                            Property Title: <?php echo $reservation['property_title']; ?><br>
                            Price per Night: <?php echo $reservation['price_per_night']; ?>$<br>

                            <form action="updateReservation.php" method="post">
                                <input type="hidden" name="reservation_key" value="<?php echo $reservation_key; ?>">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputUserName">Nouveau Nom</label>
                                        <input type="text" class="form-control" id="inputUserName" name="new_user_name" value="<?php echo isset($reservation['user_name']) ? $reservation['user_name'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputUserEmail">Nouvel Email</label>
                                        <input type="email" class="form-control" id="inputUserEmail" name="new_user_email" value="<?php echo isset($reservation['user_email']) ? $reservation['user_email'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCheckIn">Nouvelle Date d'arrivée</label>
                                        <input type="date" class="form-control" id="inputCheckIn" name="new_check_in_date" value="<?php echo $reservation['check_in_date']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputCheckOut">Nouvelle Date de départ</label>
                                        <input type="date" class="form-control" id="inputCheckOut" name="new_check_out_date" value="<?php echo $reservation['check_out_date']; ?>">
                                    </div>
                                </div>

                                <p>Options:</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="new_breakfast_option" name="new_breakfast_option" <?php echo (isset($reservation['breakfast_option']) && $reservation['breakfast_option'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="new_breakfast_option">
                                        Petit-déjeuner
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="new_cleaning_option" name="new_cleaning_option" <?php echo (isset($reservation['cleaning_option']) && $reservation['cleaning_option'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="new_cleaning_option">
                                        Service de nettoyage
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="new_insurance_option" name="new_insurance_option" <?php echo (isset($reservation['insurance_option']) && $reservation['insurance_option'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="new_insurance_option">
                                        Assurance
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                            </form>
                            <form action="removeFromCart.php" method="post">
                                <input type="hidden" name="reservation_key" value="<?php echo $reservation_key; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <p class="lead text-center">Cliquez sur le bouton ci-dessous pour confirmer la réservation.</p>
                <a href="confirmReservation.php" class="btn btn-primary">Confirmer la réservation</a>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="display-4">Panier Vide</h1>
                <p class="lead">Votre panier est actuellement vide. Ajoutez des réservations depuis la page des propriétés.</p>
            </div>
        </div>
    </div>
<?php
}
if (isset($_SESSION['user_id']) && empty($_SESSION['cart'])) {
    header("Location: profil.php");
    exit();
}

include('footer.php');
?>