<?php
session_start();
include 'DBConn.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];

$conn->query("
INSERT INTO tblWishlist (user_id, product_id)
VALUES ('$user_id', '$product_id')
");

header("Location: wishlist.php");
exit();
?>