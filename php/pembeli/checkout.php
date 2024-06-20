<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login_pembeli.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $total = $_POST['total'];
    $user_id = $_SESSION['user_id'];

    if (!isset($_FILES['bukti_pembayaran'])) {
        echo "Form data not complete!";
        exit();
    }

    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($_FILES['bukti_pembayaran']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    $check = getimagesize($_FILES['bukti_pembayaran']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $target_file)) {
            $query = "UPDATE keranjang SET metode_pembayaran='$target_file', status_pembayaran='terbayar' WHERE id_pembeli='$user_id' AND status_pembayaran='keranjang'";

            if (mysqli_query($con, $query)) {
                echo "Order placed successfully!";
                header("Location: ../../index.php");
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Invalid request.";
}
?>
