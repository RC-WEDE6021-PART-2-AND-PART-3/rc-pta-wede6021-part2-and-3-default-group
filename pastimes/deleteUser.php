<?php
include 'DBConn.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Remove related records first
    $conn->query("DELETE FROM tblCart WHERE user_id = $id");
    $conn->query("DELETE FROM tblWishlist WHERE user_id = $id");
    $conn->query("DELETE FROM tblOrder WHERE user_id = $id");

    // Delete user
    $conn->query("DELETE FROM tblUser WHERE user_id = $id");

}

header("Location: admin.php");
exit();
?>