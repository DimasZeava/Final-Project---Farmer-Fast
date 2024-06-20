<?php
require('koneksi.php');
session_start();

if(isset($_POST['nama']) && isset($_POST['password'])){
    $username = $_POST['nama'];
    $password = $_POST['password'];

    $query = "SELECT * FROM pembeli WHERE nama_pembeli='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['nama'] = $user['nama_pembeli'];
        $_SESSION['user_id'] = $user['id_Pembeli'];
        $_SESSION['user_address'] = $user['alamat'];
        header("Location: ../../index.php");
        exit();
    } else {
        echo "Invalid Username or Password";
    }
} 
?>