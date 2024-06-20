<?php
require(dirname(__FILE__) . '/../koneksi.php');
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: ../auth/login_pembeli.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    if (empty($product_id) || empty($quantity) || $quantity < 1) {
        echo "Invalid input.";
        exit();
    }

    $user_check_query = "SELECT * FROM pembeli WHERE id_Pembeli = '$user_id'";
    $user_check_result = mysqli_query($con, $user_check_query);
    if (mysqli_num_rows($user_check_result) == 0) {
        echo "User not found.";
        exit();
    }

    $query = "SELECT * FROM barang WHERE id_barang = '$product_id'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Product not found.";
        exit();
    }

    $total_price = $product['harga_satuan'] * $quantity;

    $query = "INSERT INTO keranjang (id_pembeli, id_barang, kuantitas, total_harga, metode_pembayaran, status_pembayaran) VALUES ('$user_id', '$product_id', '$quantity', '$total_price', 'tidak ada', 'keranjang')";
    if (mysqli_query($con, $query)) {
        header("Location: ../../cart.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}