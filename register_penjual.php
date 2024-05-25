<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./public/styles/style.css" />
    <title>Document</title>
  </head>
  <body>
    <?php
    require('./php/proses_register_penjual.php');
    ?>
    <div class="container-fluid header">
      <img src="./public/img/icon.png" alt="Farmer Fast icon" />
      <div class="title">
        <h2 class="first">Farmer</h2>
        <h2 class="second">Fast</h2>
      </div>
    </div>
    <div class="container-fluid body">
      <img
        src="./public/img/register-illustration.png"
        alt="register illustration"
      />
      <div class="container-fluid form-register">
        <h2>Daftar Penjual</h2>
        <form action="register_penjual.php" method="POST">
          <div class="mb-3">
            <div class="floating-input">
                <input class="form-control" placeholder="" value="" id="nama" name="nama" required>
                <label>Nama Toko</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="floating-input">
              <input class="form-control" type="email" placeholder="" value="" id="email" name="email" required>
              <label>Email</label>
          </div>
          </div>
          <div class="mb-3">
            <div class="floating-input">
              <input class="form-control" placeholder="" value="" id="notelp" name="notelp" required>
              <label>No Telp</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="floating-input">
              <input class="form-control" placeholder="" value="" id="alamat" name="alamat" required>
              <label>Alamat Penjual</label>
          </div>
          </div>
          <div class="mb-3">
            <div class="floating-input">
              <input class="form-control" type="password" placeholder="" value="" id="password" name="password" required>
              <label>Password</label>
          </div>
          </div>
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p>Sudah Memiliki Akun? <a href="login_penjual.php">Login</a></p>
      </div>
    </div>
    <div class="container-fluid footer">
      <h5>Juni 2024 - Kelompok 11</h5>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
  </body>
</html>
