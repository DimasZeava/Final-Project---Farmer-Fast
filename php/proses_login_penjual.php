<?php
require('koneksi.php');
if(isset($_POST['nama']) && isset($_POST['password'])){
    $username = $_POST['nama'];
    $password = $_POST['password'];
    $_SESSION['user_id'] = $user['id'];

    $query = "SELECT * FROM penjual WHERE nama_toko='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if(!mysqli_num_rows($result)){
        echo "Invalid username or password!";
    }

    header('Location: ../../index_penjual.php');
      exit;
} 