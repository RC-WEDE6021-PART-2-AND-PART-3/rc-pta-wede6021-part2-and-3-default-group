<?php
include 'header.php';
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/*
Student Name: YOUR NAME
Student Number: YOUR NUMBER
*/

// GET CART ITEMS + QUANTITY
$sql = "SELECT tblClothes.*, tblCart.quantity
        FROM tblCart
        JOIN tblClothes
        ON tblCart.product_id = tblClothes.product_id
        WHERE tblCart.user_id = $user_id";

$result = $conn->query($sql);

$total = 0;

// CALCULATE TOTAL USING QUANTITY
while($row = $result->fetch_assoc()){

    $subtotal = $row['price'] * $row['quantity'];

    $total += $subtotal;
}

if(isset($_POST['pay'])){

    $method = $_POST['payment'];

    // SAVE ORDER
    $conn->query("
    INSERT INTO tblOrder (user_id, total_price)
    VALUES ($user_id, $total)
    ");

    // CLEAR CART
    $conn->query("
    DELETE FROM tblCart
    WHERE user_id = $user_id
    ");

    echo "
    <div class='container'>
        <h2>Payment Successful!</h2>
        <p>Payment Method: $method</p>
        <p>Total Paid: R$total</p>
        <a href='products.php'>
            <button>Continue Shopping</button>
        </a>
    </div>
    ";

    include 'footer.php';
    exit();
}
?>

<div class="container">

    <h2>Checkout</h2>

    <h3>Total Amount: R<?php echo number_format($total, 2); ?></h3>

    <form method="POST">

        <label>Select Payment Method:</label>

        <br><br>

        <input type="radio"
               name="payment"
               value="Cash on Delivery"
               required>
        Cash on Delivery

        <br><br>

        <input type="radio"
               name="payment"
               value="Card Payment">
        Card Payment

        <br><br>

        <input type="radio"
               name="payment"
               value="EFT">
        EFT / Bank Transfer

        <br><br>

        <button name="pay">
            Confirm Payment
        </button>

    </form>

</div>

<?php include 'footer.php'; ?>