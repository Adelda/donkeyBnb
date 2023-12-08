<?php

if (!isset($_SESSION)) {
    session_start();
}

$host = "localhost";
$user = "root";
$password = "";
$database = "projet_donkey_stay";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["city"])) {
    $searchedCity = $_POST["city"];

    $stmt = $conn->prepare("SELECT * FROM properties WHERE city LIKE ?");
    $searchedCity = '%' . $searchedCity . '%';
    $stmt->bind_param("s", $searchedCity);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    $stmt->close();
}

$cartItemCount = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $cartItemCount = 0;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.css" />
    <title></title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" method="post" action="index.php">
                        <input class="form-control me-2" type="search" placeholder="Search" name="city">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </form>
                    <div class="col-md-3 text-end">
                        <?php if (isset($_SESSION['email'])) : ?>
                            <a href="cart.php">
                                <div class="btn btn-outline-light me-2">
                                    <i class="bi bi-cart3"></i>
                                    <?php if (isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0) : ?>
                                        <span class="badge bg-danger"><?php echo $_SESSION['cart_count']; ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <a href="logout.php" class="btn btn-outline-light me-2">Logout</a>
                            <a href="profil.php" class="btn btn-outline-light me-2">Profile</a>
                        <?php else : ?>
                            <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>