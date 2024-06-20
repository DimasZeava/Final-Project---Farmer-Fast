<?php
  // memanggil file koneksi.php untuk membuat koneksi
  include 'php/koneksi.php'; 

  // mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_barang'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_barang = ($_GET["id_barang"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM barang WHERE id_barang='$id_barang'";
    $result = mysqli_query($con, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if(!$result){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
      // apabila data tidak ada pada database maka akan dijalankan perintah ini
       if (!count($data)) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='index_penjual.php';</script>";
       }
  } else {
    echo "<script>alert('Masukkan data id_barang.');window.location='index_penjual.php';</script>";
  }         
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit Barang</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: salmon;
      }
    button {
          background-color: salmon;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
          border: 0px;
          margin-top: 20px;
    }
    label {
      margin-top: 10px;
      float: left;
      text-align: left;
      width: 100%;
    }
    input {
      padding: 6px;
      width: 100%;
      box-sizing: border-box;
      background: #f8f8f8;
      border: 2px solid #ccc;
      outline-color: salmon;
    }
    div {
      width: 100%;
      height: auto;
    }
    .base {
      width: 400px;
      height: auto;
      padding: 20px;
      margin-left: auto;
      margin-right: auto;
      background: #ededed;
    }
    </style>
  </head>
  <body>
      <center>
        <h1>Edit Produk <?php echo $data['nama_barang']; ?></h1>
      <center>
      <form method="POST" action="proses_edit.php" enctype="multipart/form-data" >
      <section class="base">
        <input name="id_barang" value="<?php echo $data['id_barang']; ?>"  hidden />
        <div>
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" autofocus="" required="" />
        </div>
        <div>
          <label>Kategori</label>
         <input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" />
        </div>
        <div>
          <label>Harga Satuan</label>
         <input type="text" name="harga_satuan" required=""value="<?php echo $data['harga_satuan']; ?>" />
        </div>
        <div>
          <label>Stok</label>
         <input type="text" name="stok" required="" value="<?php echo $data['stok']; ?>"/>
        </div>
        <div>
          <label>Gambar Barang</label>
          <img src="uploads/<?php echo $data['gambar_url']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
          <input type="file" name="gambar_url" />
          <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
        </div>
        <div>
          <label>Id Penjual</label>
          <input type="text" name="id_penjual" value="<?php echo $data['id_penjual']; ?>" />
        </div>
        <div>
         <button type="submit">Simpan Perubahan</button>
        </div>
        </section>
      </form>
  </body>
</html>