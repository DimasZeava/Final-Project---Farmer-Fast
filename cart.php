<?php
session_start();
include('./php/include/header.php');
require('./php/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login_pembeli.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$status = "";
if (isset($_POST['action'])) {
    if ($_POST['action'] == "remove") {
        $product_id = $_POST['product_id'];
        $query = "DELETE FROM keranjang WHERE id_pembeli='$user_id' AND id_barang='$product_id' AND status_pembayaran='keranjang'";
        if (mysqli_query($con, $query)) {
            $status = "<div class='box' style='color:red;'>Barang dihapus dari keranjang!</div>";
        }
    } elseif ($_POST['action'] == "change") {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['QTY'];
        $query = "UPDATE keranjang k JOIN barang b ON k.id_barang = b.id_barang SET k.kuantitas='$quantity', k.total_harga='$quantity'*b.harga_satuan WHERE k.id_pembeli='$user_id' AND k.id_barang='$product_id' AND k.status_pembayaran='keranjang'";
        mysqli_query($con, $query);
    }
}
?>

<html>
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
<title>Keranjang Belanja FarmerFast</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2>Keranjang FarmerFast</h2>   

<?php
$query = "SELECT k.*, b.nama_barang, b.gambar_url, b.harga_satuan FROM keranjang k JOIN barang b ON k.id_barang = b.id_barang WHERE k.id_pembeli='$user_id' AND k.status_pembayaran='keranjang'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $cart_count = mysqli_num_rows($result);
    ?>
    <div class="cart_div">
        <a href="cart.php">
        <img src="cart-icon.png" /> Cart
        <span><?php echo $cart_count; ?></span></a>
    </div>

    <div class="cart">
        <table class="table">
            <tbody>
                <tr>
                    <td></td>
                    <td>Nama Barang</td>
                    <td>QTY</td>
                    <td>Harga Satuan</td>
                    <td>Total Harga</td>
                </tr>	
                <?php		
                $total_harga = 0;
                while ($Barang = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><img src="uploads/<?php echo $Barang["gambar_url"]; ?>" width="50" height="40"/></td>
                        <td>
                            <?php echo $Barang["nama_barang"]; ?><br />
                            <form method='post' action=''>
                                <input type='hidden' name='product_id' value="<?php echo $Barang["id_barang"]; ?>" />
                                <input type='hidden' name='action' value="remove" />
                                <button type='submit' class='remove'>Remove Item</button>
                            </form>
                        </td>
                        <td>
                            <form method='post' action=''>
                                <input type='hidden' name='product_id' value="<?php echo $Barang["id_barang"]; ?>" />
                                <input type='hidden' name='action' value="change" />
                                <select name='QTY' class='QTY' onchange="this.form.submit()">
                                    <option <?php if($Barang["kuantitas"] == 1) echo "selected"; ?> value="1">1</option>
                                    <option <?php if($Barang["kuantitas"] == 2) echo "selected"; ?> value="2">2</option>
                                    <option <?php if($Barang["kuantitas"] == 3) echo "selected"; ?> value="3">3</option>
                                    <option <?php if($Barang["kuantitas"] == 4) echo "selected"; ?> value="4">4</option>
                                    <option <?php if($Barang["kuantitas"] == 5) echo "selected"; ?> value="5">5</option>
                                </select>
                            </form>
                        </td>
                        <td><?php echo "Rp" . $Barang["harga_satuan"]; ?></td>
                        <td><?php echo "Rp" . ($Barang["harga_satuan"] * $Barang["kuantitas"]); ?></td>
                    </tr>
                    <?php
                    $total_harga += ($Barang["harga_satuan"] * $Barang["kuantitas"]);
                }
                ?>
                <tr>
                    <td colspan="5" align="right">
                        <strong>TOTAL: <?php echo "Rp" . $total_harga; ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="./php/pembeli/checkout.php" enctype="multipart/form-data">
            <input type="hidden" name="total" value="<?php echo $total_harga; ?>">
            <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>
            <button type="submit" name="checkout" class="checkout">Checkout</button>
        </form>
    </div>
    <?php
} else {
    echo "<h3>Keranjang kosong!</h3>";
}
?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>

<br /><br />

</div>
<?php include('./php/include/footer.php');?>
</body>
</html>
