<?php
require('koneksi.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nama = $_POST['nama'];
      $email = $_POST['email'];
      $notelp = $_POST['notelp'];
      $alamat = $_POST['alamat'];
      $password = $_POST['password'];

      $result = $con->query("SELECT id_pembeli FROM pembeli ORDER BY id_pembeli DESC LIMIT 1");
      $lastRecord = $result->fetch_assoc();

      $lastNumber = intval(substr($lastRecord['id_pembeli'], 1));
      $newNumber = $lastNumber + 1;

      $newID= 'P' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

      $sql = "INSERT INTO pembeli (id_pembeli, nama_pembeli, alamat, nomor_telepon, email, password) VALUES ('$newID','$nama', '$alamat', '$notelp', '$email', '$password')";
      $result = $con->query($sql);
      if (!$result) {
        echo "<script>alert('Gagal mendaftar')</script>";
      } else {
        echo "<script>alert('Berhasil mendaftar')</script>";
      } 
      header('Location: ../include/header.php');
      exit;
    }
    ?>