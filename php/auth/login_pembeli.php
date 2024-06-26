<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../public/styles/style.css" />
    <title>Farmer Fast</title>
  </head>
  <body>
    <?php
    require('../proses_login_pembeli.php');
    ?>
    <div class="container-fluid header">
      <img src="../../public/img/icon.png" alt="Farmer Fast icon" />
      <div class="title">
        <h2 class="first">Farmer</h2>
        <h2 class="second">Fast</h2>
      </div>
    </div>
    <div class="container-fluid body">
      <img
        src="../../public/img/login-illustration.png"
        alt="login illustration"
      />
      <div class="container-fluid form-register">
        <h2>Login</h2>
        <form action="login_pembeli.php" method="POST">
          <div class="mb-3">
            <div class="floating-input">
                <input class="form-control" placeholder="" value="" id="nama" name="nama" required>
                <label>Nama</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="floating-input">
              <input class="form-control" type="password" placeholder="" value="" id="password" name="password" required>
              <label>Password</label>
            </div>
            <a href="" class="forgot">Lupa kata sandi?</a>
          </div>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <p>Belum Memiliki Akun? <a href="register.php">Register</a></p>
      </div>
    </div>
    <div class="container-fluid footer">
      <h5>Juni 2024 - Kelompok 11</h5>
    </div>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
  </body>
</html>