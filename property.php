<?php
include('header.php');
include('link.php');

if (!isset($_GET['property_id'])) {
    echo "ID de propriété non spécifié.";
    exit;
}

$property_id = intval($_GET['property_id']);

$stmt = $pdo->prepare("SELECT image_url, title, description, price_per_night, capacity, city, rating 
                        FROM properties 
                        WHERE property_id = ?");
$stmt->execute([$property_id]);
$propertyDetails = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$propertyDetails) {
    echo "Propriété non trouvée.";
    exit;
}
?>

<br>
<br>
<br>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $propertyDetails['image_url']; ?>" class="img-fluid rounded" alt="...">
        </div>
        <div class="col-md-6">
            <h2><?php echo $propertyDetails['title']; ?></h2>
            <p><?php echo $propertyDetails['description']; ?></p>
            <p>Prix par nuit : <?php echo $propertyDetails['price_per_night']; ?>$</p>
            <p>Capacité : <?php echo $propertyDetails['capacity']; ?> personnes</p>
            <p>Ville : <?php echo $propertyDetails['city']; ?></p>
            <?php
            if (isset($propertyDetails['rating'])) {
                echo "<p>Note : {$propertyDetails['rating']}</p>";
            }
            ?>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2 class="mb-4">Formulaire de Réservation</h2>
    <form action="addtocart.php" method="post">
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        <input type="hidden" name="property_title" value="<?php echo $propertyDetails['title']; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Nom</label>
                <input type="text" class="form-control" id="inputName" name="user_name" placeholder="Votre Nom">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="user_email" placeholder="Votre Email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCheckIn">Date d'arrivée</label>
                <input type="date" class="form-control" id="inputCheckIn" name="check_in_date" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputCheckOut">Date de départ</label>
                <input type="date" class="form-control" id="inputCheckOut" name="check_out_date" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="breakfastOption">Petit-déjeuner</label>
                <select class="form-control" id="breakfastOption" name="breakfast_option">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="cleaningOption">Service de nettoyage</label>
                <select class="form-control" id="cleaningOption" name="cleaning_option">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="insuranceOption">Assurance</label>
                <select class="form-control" id="insuranceOption" name="insurance_option">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Pré-réserver et Ajouter au panier</button>
    </form>
</div>
<br>

<?php
include('footer.php');
?>