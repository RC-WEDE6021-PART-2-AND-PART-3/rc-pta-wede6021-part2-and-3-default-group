<?php
session_start();
include 'DBConn.php';

$id = $_SESSION['user_id'];

$res = $conn->query("SELECT * FROM tblWishlist 
JOIN tblClothes 
ON tblWishlist.product_id=tblClothes.product_id
WHERE user_id=$id");

while($r=$res->fetch_assoc()){
echo $r['product_name']."<br>";
}
?>