<?php
require('koneksi.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        $alamat = $_POST['alamat'];
        $password = $_POST['password'];

        $result = $con->query("SELECT id_penjual FROM penjual ORDER BY id_penjual DESC LIMIT 1");
        $lastRecord = $result->fetch_assoc();

        $lastNumber = intval(substr($lastRecord['id_penjual'], 1));
        $newNumber = $lastNumber + 1;

        $newIdPenjual = 'J' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        $sql = "INSERT INTO penjual (id_penjual, nama_toko, alamat, nomor_telepon, email, password) VALUES ('$newIdPenjual', '$nama', '$alamat', '$notelp', '$email', '$password')";
        $result = $con->query($sql);
        if (!$result) {
            echo "<script>alert('Gagal mendaftar')</script>";
        } else {
            echo "<script>alert('Berhasil mendaftar')</script>";
        }
        header('Location: index_penjual.php');
        exit();
    }
?>