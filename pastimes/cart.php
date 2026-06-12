<?php
include 'header.php';
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT tblClothes.*, tblCart.quantity
        FROM tblCart
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

    $subtotal = $row['price'] * $row['quantity'];

    echo "<div class='box'>";

    echo "<img src='images/".$row['image']."' width='200'>";

    echo "<h3>".$row['product_name']."</h3>";

    echo "<p>Price: R".$row['price']."</p>";

    echo "<form action='updateCart.php' method='POST'>";

    echo "<input type='hidden'
                 name='product_id'
                 value='".$row['product_id']."'>";

    echo "<label>Quantity:</label><br>";

    echo "<input type='number'
                 name='quantity'
                 value='".$row['quantity']."'
                 min='1'>";

    echo "<br><br>";

    echo "<button type='submit'>
            Update Cart
          </button>";

    echo "</form>";

    echo "<br>";

    echo "<p><strong>Subtotal: R".$subtotal."</strong></p>";

    echo "<a href='remove.php?id=".$row['product_id']."'>
            <button>Remove Item</button>
          </a>";

    echo "</div>";

    $total += $subtotal;
}

echo "</div>";

echo "<h2>Total: R".$total."</h2>";

echo "<br>";

echo "<a href='products.php'>
        <button>Continue Shopping</button>
      </a>";

echo "&nbsp;&nbsp;";

if($total > 0){

    echo "<a href='checkout.php'>
            <button>Proceed to Checkout</button>
          </a>";

}else{

    echo "<p>Your cart is empty.</p>";
}

echo "</div>";

include 'footer.php';
?>