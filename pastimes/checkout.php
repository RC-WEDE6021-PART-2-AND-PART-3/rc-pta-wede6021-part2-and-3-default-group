<?php
include 'header.php';
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];



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

    <form method="POST" enctype="multipart/form-data">

    <label>Delivery Address</label>

    <textarea
        name="address"
        required
        placeholder="Enter delivery address"></textarea>

    <br><br>

    <label>Select Payment Method</label>

    <br><br>

    <input type="radio"
           name="payment"
           value="Cash on Delivery"
           onclick="showFields()"
           required>
    Cash on Delivery

    <br><br>

    <input type="radio"
           name="payment"
           value="Card Payment"
           onclick="showFields()">
    Card Payment

    <br><br>

    <input type="radio"
           name="payment"
           value="EFT"
           onclick="showFields()">
    EFT / Bank Transfer

    <br><br>

    <div id="cardFields" style="display:none;">

        <input type="text"
               name="card_name"
               placeholder="Cardholder Name">

        <input type="text"
               name="card_number"
               placeholder="Card Number">

        <input type="text"
               name="expiry"
               placeholder="MM/YY">

        <input type="text"
               name="cvv"
               placeholder="CVV">

    </div>

    <div id="eftFields" style="display:none;">

        <label>Upload Proof of Payment</label>

        <input type="file"
               name="proof">

    </div>

    <br>

    <button name="pay">
        Confirm Payment
    </button>

</form>

</div>
<script>
function showFields(){

    let payment =
    document.querySelector(
    'input[name="payment"]:checked'
    ).value;

    document.getElementById(
    "cardFields"
    ).style.display = "none";

    document.getElementById(
    "eftFields"
    ).style.display = "none";

    if(payment === "Card Payment"){
        document.getElementById(
        "cardFields"
        ).style.display = "block";
    }

    if(payment === "EFT"){
        document.getElementById(
        "eftFields"
        ).style.display = "block";
    }
}
</script>

<?php include 'footer.php'; ?>