<?php
require(dirname(__FILE__) . '/../koneksi.php');
session_start();

if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    echo "Product ID and quantity must be provided";
    exit();
}

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$query = "SELECT * FROM barang WHERE id_barang = '$product_id'";
$result = mysqli_query($con, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Produk tidak ditemukan!";
    exit();
}

$address = $_SESSION['user_address'] ?? '';
$harga = $product['harga_satuan'];
$subtotal = $harga * $quantity;
$biayapengiriman = 2000;
$total = $subtotal + $biayapengiriman;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <style>
        .file-input-wrapper {
            margin-top: 20px;
        }
        .file-preview {
            margin-top: 10px;
            max-height: 100px;
            max-width: 100px
        }
        .checkout-details {
            margin-bottom: 30px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="nama-barang"><?php echo htmlspecialchars($product['nama_barang']);?></h2>
        <img src="http://localhost/Final_Project_Farmer_Fast/uploads/<?php echo htmlspecialchars($product['gambar_url']); ?>" alt="Product Image">
        <h2>Jumlah: <?php echo htmlspecialchars($quantity); ?></h2>
        <h2>Total: Rp <?php echo number_format($total, 2); ?></h2>
        <form action="checkout.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
            <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
            <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Upload Bukti Transfer</label>
                <div class="file-input-wrapper">
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                </div>
                <div class="file-preview">
                    <img id="file-preview" src="#" alt="File Preview" style="display: none; max-width: 100%;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Checkout</button>
            <a href="../../product_detail.php?id=<?php echo $product_id; ?>" class="btn btn-danger">Cancel Order</a>
        </form>
    </div>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('bukti_pembayaran').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('file-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>
</body>
</html>