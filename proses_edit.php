<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'php/koneksi.php'; 

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id_barang'];
  $nama_produk   = $_POST['nama_barang'];
  $deskripsi     = $_POST['deskripsi'];
  $harga_satuan    = $_POST['harga_satuan'];
  $stok    = $_POST['stok'];
  $gambar_url = $_FILES['gambar_url']['name'];
  $id_penjual   = $_POST['id_penjual'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambar_url != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_url); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_url']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_url; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'uploads/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE barang SET nama_barang = '$nama_barang', kategori = '$deskripsi', harga_satuan = '$harga_satuan', stok = '$stok', gambar_url = '$nama_gambar_baru', id_penjual '$id_penjual'";
                    $query .= "WHERE id = '$id_barang'";
                    $result = mysqli_query($con, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($con).
                             " - ".mysqli_error($con));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='index_penjual.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE barang SET nama_barang = '$nama_barang', kategori = '$deskripsi', harga_satuan = '$harga_satuan', stok = '$stok', ,id_penjual'$id_penjual'";
      $query .= "WHERE id_barang = '$id_barang'";
      $result = mysqli_query($con, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($con).
                             " - ".mysqli_error($con));
      } else {
          echo "<script>alert('Data berhasil diubah.');window.location='index_penjual.php';</script>";
      }
    }

 
