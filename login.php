  <?php
  
  include('header.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = new PDO("mysql:host=localhost;dbname=projet_donkey_stay", "root", "",);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(":email", $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);


    if ($user) {
      if ($password == $user['password']) {
        echo "Login successful";
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $email;
        header('Location:index.php');
      } else {
        echo "Incorrect password";
      }
    } else {
      echo "Username not found";
    }
  }
  ?>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="post" action="login.php">
            <div class="form-outline mb-4">
              <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example13">Email address</label>
            </div>
            <div class="form-outline mb-4">
              <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example23">Password</label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('footer.php');
  ?>