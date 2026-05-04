<?php
include 'header.php';
include 'DBConn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
SELECT tblClothes.* 

FROM tblWishlist

JOIN tblClothes 
ON tblWishlist.product_id = tblClothes.product_id

WHERE tblWishlist.user_id = $user_id
";

$result = $conn->query($sql);
?>

<div class="container">

    <h2>My Wishlist ❤️</h2>

    <div class="products">

        <?php while($row = $result->fetch_assoc()){ ?>

            <div class="box">

                <img src="images/<?php echo $row['image']; ?>">

                <div class="product-info">

                    <h3>
                        <?php echo $row['product_name']; ?>
                    </h3>

                    <p>
                        R<?php echo $row['price']; ?>
                    </p>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php include 'footer.php'; ?>