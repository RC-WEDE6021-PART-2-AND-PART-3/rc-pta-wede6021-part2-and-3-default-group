<?php
include 'header.php';
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tblClothes WHERE seller_id = $user_id";
$result = $conn->query($sql);

echo "<div class='container'>";
echo "<h2>My Products</h2>";
echo "<div class='products'>";

while($row = $result->fetch_assoc()){

    echo "<div class='box'>";
    echo "<img src='images/".$row['image']."'>";
    echo "<h3>".$row['product_name']."</h3>";
    echo "<p>R".$row['price']."</p>";

    echo "<a href='deleteProduct.php?id=".$row['product_id']."'>
            <button style='background:red;'>Delete</button>
          </a>";

    echo "</div>";
}

echo "</div>";
echo "</div>";

include 'footer.php';
?>