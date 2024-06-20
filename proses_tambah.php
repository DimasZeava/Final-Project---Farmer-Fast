<?php
include 'php/koneksi.php'; 

  $nama_barang   = $_POST['nama_barang'];
  $deskripsi     = $_POST['deskripsi'];
  $harga_satuan    = $_POST['harga_satuan'];
  $stok    = $_POST['stok'];
  $gambar_url= $_FILES['gambar_url']['name'];
  $id_penjual   = $_POST['id_penjual'];
  
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

if($gambar_url != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); 
  $x = explode('.', $gambar_url);
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_url']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar_url;
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, 'uploads/'.$nama_gambar_baru); 
                  $query = "INSERT INTO barang (id_barang, nama_barang, deskripsi, harga_satuan, stok, gambar_url,id_penjual) VALUES ('$newIdBarang', '$nama_barang', '$deskripsi', '$harga_satuan', '$stok', '$nama_gambar_baru', '$id_penjual')";
                  $result = mysqli_query($con, $query);
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($con).
                           " - ".mysqli_error($con));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index_penjual.php';</script>";
                  }

            } else {     
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
            }
} else {
   $query = "INSERT INTO barang (nama_barang, deskripsi, harga_satuan, stok, gambar_url,id_penjual) VALUES ('$nama_barang', '$deskripsi', '$harga_satuan', '$stok', null,'$id_penjual')";
                  $result = mysqli_query($con, $query);
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($con).
                           " - ".mysqli_error($con));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index_penjual.php';</script>";
                  }
}

 