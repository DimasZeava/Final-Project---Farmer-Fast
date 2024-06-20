<?php
require('koneksi.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar'];
    $namaGambar = basename($gambar['name']);
    $targetDir = "./public/img/products/";
    $targetFilePatch = $targetDir . $namaGambar;

    $result = $con->query("SELECT id_barang FROM barang ORDER BY id_barang DESC LIMIT 1");
    $lastRecord = $result->fetch_assoc();
    
    if ($lastRecord) {
        $lastNumber = intval(substr($lastRecord['id_barang'], 3));
    }
    $newNumber = $lastNumber + 1;

    $newIdBarang = 'BRG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if(move_uploaded_file($gambar['tmp_name'], $targetFilePatch)) {
        $query = "INSERT INTO barang (id_barang, nama_barang, deskripsi, harga_satuan, stok, gambar_url, id_penjual) VALUES ('$newIdBarang', '$nama', '$deskripsi', '$harga', '$stok', '$targetFilePatch', 'J00001')";
        if(mysqli_query($con, $query)) {
            echo "<script>alert('Berhasil menambahkan barang')</script>";
        } else {
            echo "<script>alert('Database error:')</script> " .mysqli_error($con);
        }
    } else {
        echo "Gambar tidak terupload";
    }
}
?>