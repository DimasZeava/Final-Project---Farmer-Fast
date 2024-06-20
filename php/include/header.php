<?php
require(dirname(__FILE__) . '/../koneksi.php');
session_start();

function is_logged_in() {
    return isset($_SESSION['nama']);
}

function get_user_name() {
    return $_SESSION['nama'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./public/styles/header.css" />
    <title>Farmer Fast</title>
</head>
<body>
    <header>
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand">
          <img src="./public/img/icon.png" alt="Farmer Fast" width="100px" height="100px">
          <div class="title">
            <h2 class="first">Farmer</h2>
            <h2 class="second">Fast</h2>
          </div>
        </a>
      </div>
      <form class="d-flex ml-auto search_bar" role="search">
        <input class="form-control me-2 search_input" type="search" placeholder="Search" aria-label="Search">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#"> Sayur - Sayuran</a>
            <a class="dropdown-item" href="#"> Buah - Buahan</a>
            <a class="dropdown-item" href="#"> Rempah - Rempah</a>
          </div>
        </div>
      </form>
      <?php if (is_logged_in()): ?>
                      <div class="logged_in">
                        <a class="cart" href="cart.php"><i class="fas fa-shopping-cart fa-2x" style="color: #72ee59"></i></a>
                        <a class="profile" href="profile.php"><?php echo get_user_name(); ?></a>
                        <a href="./php/auth/logout_pembeli.php">Logout</a>
                      </div>
                    <?php else: ?>
                      <div class="authentication">
                      <button type="button" class="btn btn-primary btn-lg login">
                        <a class="nav-link" href="./php/auth/login_pembeli.php">Login</a>
                      </button>
                      <button type="button" class="btn btn-outline-primary btn-lg register">
                            <a class="nav-link" href="./php/auth/register_pembeli.php">Register</a>
                      </button>
                      </div>
                    <?php endif; ?>
    </header>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>