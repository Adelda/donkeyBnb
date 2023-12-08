<?php
include('header.php');
include('link.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if (!$user_id) {
  header("Location: login.php");
  exit();
}

$user_query = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$user_query->execute([$user_id]);
$user = $user_query->fetch(PDO::FETCH_ASSOC);

$reservations_query = $pdo->prepare("SELECT r.*, p.title, p.price_per_night, p.city
                                      FROM reservations r
                                      JOIN properties p ON r.property_id = p.property_id
                                      WHERE r.user_id = ?");
$reservations_query->execute([$user_id]);
$reservations = $reservations_query->fetchAll(PDO::FETCH_ASSOC);
?>

<section style="background-color: rgba(238, 238, 238, 0);">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?= $user['first_name'] . ' ' . $user['last_name']; ?></h5>
            <p class="text-muted mb-1"><?= $user['email']; ?></p>
            <p class="text-muted mb-4"><?= $user['address']; ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $user['first_name'] . ' ' . $user['last_name']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $user['email']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $user['address']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h2>Historique des Réservations</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Date de réservation</th>
              <th>Propriété</th>
              <th>Ville</th>
              <th>Prix par nuit</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reservations as $reservation) : ?>
              <tr>
                <td><?= $reservation['reservation_date']; ?></td>
                <td><?= $reservation['title']; ?></td>
                <td><?= $reservation['city']; ?></td>
                <td><?= $reservation['price_per_night']; ?></td>
                <td><?= $reservation['status']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php
include('footer.php');
?>
