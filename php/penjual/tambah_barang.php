<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
</head>
<body>
    <?php
    require('../proses_tambah_barang.php');
    ?>
    <h2>Upload Product</h2>
    <form action="tambah_barang.php" method="post" enctype="multipart/form-data">
        <label for="name">Nama product:</label>
        <input type="text" name="nama" id="nama" required><br><br>
        <label for="description">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br><br>
        <label for="price">Harga Satuan:</label>
        <input type="number" name="harga" id="harga" required><br><br>
        <label for="stock">Stok:</label>
        <input type="number" name="stok" id="stok" required><br><br>
        <label for="image">Gambar:</label>
        <input type="file" name="gambar" id="gambar" required><br><br>
        <input type="submit" value="upload">
    </form>
</body>
</html>