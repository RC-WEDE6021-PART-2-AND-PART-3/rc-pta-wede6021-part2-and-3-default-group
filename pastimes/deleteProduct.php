<?php
session_start();
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

// 🔴 DELETE FROM CHILD TABLES FIRST
$conn->query("DELETE FROM tblCart WHERE product_id = $product_id");
$conn->query("DELETE FROM tblWishlist WHERE product_id = $product_id");
$conn->query("DELETE FROM tblRating WHERE product_id = $product_id");

// 🟢 THEN DELETE PRODUCT
$sql = "DELETE FROM tblClothes 
        WHERE product_id = $product_id 
        AND seller_id = $user_id";

if($conn->query($sql)){
    header("Location: myProducts.php");
} else {
    echo "Error: " . $conn->error;
}
?>