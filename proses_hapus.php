<?php
  include 'php/koneksi.php'; 
$id_barang = $_GET["id_barang"];
//mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM barang WHERE id_barang='$id__barang' ";
    $hasil_query = mysqli_query($con, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($con).
       " - ".mysqli_error($con));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='index_penjual.php';</script>";
    }