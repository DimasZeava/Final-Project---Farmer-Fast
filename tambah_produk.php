<?php
   include('php/koneksi.php');  
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CRUD Penjual Farmer Fast</title>
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
        <h1>Tambah Produk</h1>
      <center>
      <form method="POST" action="proses_tambah.php" enctype="multipart/form-data" >
      <section class="base">
        <div>
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" autofocus="" required="" />
        </div>
        <div>
          <label>Deskripsi Barang</label>
          <input type="text" name="deskripsi" required="" />
        </div>
        <div>
          <label>Harga satuan</label>
         <input type="text" name="harga_satuan" required="" />
        </div>
        <div>
          <label>Stok</label>
         <input type="text" name="stok" required="" />
        </div>
        <div>
          <label>Gambar Barang</label>
         <input type="file" name="gambar_url" required="" />
        </div>
        <div>
          <label>Id Penjual</label>
          <input type="text" name="id_penjual" required="" />
        </div>
        <div>
         <button type="submit">Simpan Produk</button>
        </div>
        </section>
      </form>
  </body>
</html>