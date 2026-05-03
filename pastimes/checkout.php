<?php
include 'header.php';
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// GET TOTAL
$res = $conn->query("
SELECT SUM(price) AS total 
FROM tblCart 
JOIN tblClothes 
ON tblCart.product_id = tblClothes.product_id
WHERE user_id = $user_id
");

$row = $res->fetch_assoc();
$total = $row['total'] ?? 0;

if(isset($_POST['pay'])){

    $method = $_POST['payment'];

    // SAVE ORDER
    $conn->query("
    INSERT INTO tblOrder (user_id, total_price)
    VALUES ($user_id, $total)
    ");

    // CLEAR CART
    $conn->query("DELETE FROM tblCart WHERE user_id = $user_id");

    echo "<h3>Order placed using $method!</h3>";
}
?>

<div class="container">

<h2>Checkout</h2>

<h3>Total: R<?php echo $total; ?></h3>

<form method="POST">

<label>Select Payment Method:</label><br><br>

<input type="radio" name="payment" value="Cash on Delivery" required> Cash on Delivery<br><br>

<input type="radio" name="payment" value="Card"> Card Payment<br><br>

<input type="radio" name="payment" value="EFT"> EFT / Bank Transfer<br><br>

<button name="pay">Confirm Payment</button>

</form>

</div>

<?php include 'footer.php'; ?>