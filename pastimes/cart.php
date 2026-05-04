<?php
include 'header.php'; // this already has session_start()
include 'DBConn.php';

/*
Student Name: YOUR NAME
Student Number: YOUR NUMBER
*/

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT tblClothes.* FROM tblCart 
JOIN tblClothes 
ON tblCart.product_id = tblClothes.product_id
WHERE tblCart.user_id = $user_id";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

echo "<div class='container'>";
echo "<h2>Your Cart</h2>";
echo "<div class='products'>";

$total = 0;

while($row = $result->fetch_assoc()){

    echo "<div class='box'>";
    echo "<img src='images/".$row['image']."'>";
    echo "<h3>".$row['product_name']."</h3>";
    echo "<p>R".$row['price']."</p>";
    echo "<a href='remove.php?id=".$row['product_id']."'>Remove</a>";
    echo "</div>";

    $total += $row['price'];
}

echo "</div>";
echo "<h3>Total: R".$total."</h3>";

// ✅ SHOW CHECKOUT ONLY IF CART NOT EMPTY
if($total > 0){
    echo "<br><a href='checkout.php'>
            <button>Proceed to Checkout</button>
          </a>";
} else {
    echo "<p>Your cart is empty</p>";
}

echo "</div>";

include 'footer.php';
?>