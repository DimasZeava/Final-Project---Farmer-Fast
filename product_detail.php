<?php
include 'php/koneksi.php';
$product_id = $_GET['id'] ?? '';
$query = "SELECT * FROM barang WHERE id_barang = '$product_id'";
$result = mysqli_query($con, $query);
$product = mysqli_fetch_assoc($result);

$query = "SELECT * FROM penjual WHERE id_penjual = '{$product['id_penjual']}'";
$result = mysqli_query($con, $query);
$penjual = mysqli_fetch_assoc($result);

$query = "SELECT * FROM barang";
$result = mysqli_query($con, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!$product) {
    echo "Product tidak ditemukan!";
    exit();
}

$address = $_SESSION['user_address'] ?? '';

// Bagian cart
$status = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && $_POST['product_id'] != "") {
    $product_id = $_POST['product_id'];
    $result = mysqli_query($con, "SELECT * FROM `Barang` WHERE `product_id`='$product_id'");
    $row = mysqli_fetch_assoc($result);
    $nama_barang = $row['nama_barang'];
    $product_id = $row['product_id'];
    $harga_satuan = $row['harga_satuan'];
    $gambar_url = $row['gambar_url'];

    $cartArray = array(
        $product_id => array(
            'nama_barang' => $nama_barang,
            'product_id' => $product_id,
            'harga_satuan' => $harga_satuan,
            'QTY' => 1,
            'gambar_url' => $gambar_url
        )
    );

    if (empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($product_id, $array_keys)) {
            $status = "<div class='box' style='color:red;'>Product is already added to your cart!</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "<div class='box'>Product is added to your cart!</div>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="public/styles/header.css">
    <link rel="stylesheet" href="public/styles/product_detail.css" />
    <title><?php echo htmlspecialchars($product['nama_barang']); ?></title>
</head>
<body>
    <?php include './php/include/header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
            <img class="product-img" src="uploads/<?php echo htmlspecialchars($product['gambar_url']); ?>" alt="<?php echo htmlspecialchars($product['nama_barang']); ?>">
            </div>
            <div class="col-md-4">
                <h2><?php echo htmlspecialchars($product['nama_barang']); ?></h2>
                <h1 id="product_price" data-price="<?php echo htmlspecialchars($product['harga_satuan']); ?>"><?php echo htmlspecialchars($product['harga_satuan']); ?></h1>
                <h4>Detail</h4>
                <p><?php echo htmlspecialchars($product['deskripsi']); ?></p>
            </div>
            <div class="col-md-4 buy-card">
                <a href="detail_toko.php"><?php echo htmlspecialchars($penjual['nama_toko']); ?></a>
                <form action="./php/pembeli/tambah_keranjang.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id_barang']); ?>">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Stok</label>
                        <p><?php echo htmlspecialchars($product['stok'])?></p>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="<?php echo htmlspecialchars($product['stok'])?>">
                    </div>
                    <div class="subtotal">
                        <h4>Subtotal</h4>
                        <h2 id="subtotal">0</h2>
                    </div>
                    <div class="button-buy">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                        <button type="button" class="btn btn-primary" onclick="openPopup()">Beli</button>
                    </div>
                </form>
                <form>
                <form id="cartForm" action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id_barang']); ?>">
                <input type="hidden" name="quantity" value="1">    
                </form>
                <form id="checkoutForm" action="./php/pembeli/checkoutpage.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id_barang']) ?>">
                    <input type="hidden" name="quantity" id="checkoutForm_quantity" value="1">
                </form>
            </div>
        </div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
            <h2>Konfirmasi Pembelian</h2>
            <div class="current-barang">
                <h4><?php echo htmlspecialchars($product['nama_barang']) ?></h4>
                <h5 id="popupSubtotal"></h5>
            </div>
            <div class="added-subbarang">
                <h4>Jasa pengiriman</h4>
                <h5 id="biayapengiriman" value="2000">Rp 2000.00</h5>
            </div>
            <div class="alamat-pembeli">
                <h4>Alamat Pengiriman</h4>
                <h2><?php echo htmlspecialchars($address); ?></h2>
            </div>
            <div class="total">
                <h4>Total</h4>
                <h5 id="totalpembayaran">Rp 0.00</h5>
            </div>
            <div class="confirmation">
                <button class="btn btn-danger" onclick="closePopup()">Batalkan</button>
                <button class="btn btn-success" onclick="confirmationPopup()">Beli</button>
            </div>
        </div>
    </div>

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

    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        updateSubtotal();
    });

    function updateQuantity() {
            const quantity = document.getElementById('quantity').value;
            document.getElementById('formpembelian_quantity').value = quantity;
            updateSubtotal();
        }

    function updateSubtotal() {
        const price = parseFloat(document.getElementById('product_price').getAttribute('data-price'));
        const quantity = parseInt(document.getElementById('quantity').value);
        const biayapengiriman = parseFloat(document.getElementById('biayapengiriman').getAttribute('value'));

        if (!isNaN(price) && !isNaN(quantity)) {
                const subtotal = price * quantity;
                const total = subtotal + biayapengiriman;

                document.getElementById('subtotal').innerText = 'Rp' + subtotal.toFixed(2);
                document.getElementById('popupSubtotal').innerText = 'Rp' + subtotal.toFixed(2);
                document.getElementById('totalpembayaran').innerText = 'Rp ' + total.toFixed(2);
            } else {
                document.getElementById('subtotal').innerText = 'Rp 0';
                document.getElementById('popupSubtotal').innerText = 'Rp 0';
                document.getElementById('totalpembayaran').innerText = 'Rp 0';
            }
    }

    document.getElementById('quantity').addEventListener('input', updateSubtotal);

    function openPopup() {
        document.getElementById('popup').style.display = 'block';
        updateSubtotal();
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
    
    function confirmationPopup() {
        document.getElementById('checkoutForm_quantity').value = document.getElementById('quantity').value;
        document.getElementById('checkoutForm').submit();
    }
    </script>
</body>
</html>