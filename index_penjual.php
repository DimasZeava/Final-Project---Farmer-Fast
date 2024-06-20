<?php
  include('php/koneksi.php'); 
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard Penjual</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: salmon;
      }
    table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: salmon;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    </style>
  </head>
  <body>
    <center><h1>Data Produk</h1><center>
    <center><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a><center>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Deskripsi</th>
          <th>Harga Satuan</th>
          <th>Stok</th>
          <th>Gambar</th>
          <th>Id Penjual</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM barang ORDER BY id_barang ASC";
      $result = mysqli_query($con, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($con).
           " - ".mysqli_error($con));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?></td>
          <td>Rp <?php echo number_format($row['harga_satuan'],0,',','.'); ?></td>
          <td><?php echo $row['stok']; ?></td>
          <td style="text-align: center;"><img src="uploads/<?php echo $row['gambar_url']; ?>" style="width: 120px;"></td>
          <td><?php echo $row['id_penjual']; ?></td>
          <td>
              <a href="edit_produk.php?id_barang=<?php echo $row['id_barang']; ?>">Edit</a> |
              <a href="proses_hapus.php?id_barang=<?php echo $row['id_barang']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
  </body>
</html>