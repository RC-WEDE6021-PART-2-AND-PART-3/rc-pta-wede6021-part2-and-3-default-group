<?php
session_start();
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

$sql = "INSERT INTO tblCart (user_id, product_id)
        VALUES ($user_id, $product_id)";

if($conn->query($sql)){
    header("Location: cart.php");
} else {
    echo "Error: " . $conn->error;
}
?>