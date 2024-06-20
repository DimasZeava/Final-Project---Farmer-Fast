<?php
require('php/koneksi.php');

$query = "SELECT * FROM barang";
$result = mysqli_query($con, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./public/styles/index.css" />
    <title>Document</title>
</head>
<body>
<?php include './php/include/header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-3">
                <a href="product_detail.php?id=<?php echo $product['id_barang'];?>" class="card mb-4 shadow-sm text-decoration-none text-dark">
                <img src="uploads/<?php echo htmlspecialchars($product['gambar_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['nama_barang']); ?>">
                <div class="card-body">
                        <h5 class="card-title"><?php echo $product['nama_barang']; ?></h5>
                        <h4 class="card-price"><?php echo $product['harga_satuan']; ?></h4>
                        <h5 class="alamat-penjual">Jl lorem</h5>
                    </div>
                </a>            
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include './php/include/footer.php'; ?>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>