<?php include 'header.php'; ?>
<?php include 'DBConn.php'; ?>

<div class="container">

<h2>Shop Collection</h2>

<div class="products">

<?php
$res = $conn->query("SELECT * FROM tblClothes");

while($row = $res->fetch_assoc()){

echo "
<div class='box'>
<img src='images/".$row['image']."'>

<div class='overlay'>
<h3>".$row['product_name']."</h3>
<p>R".$row['price']."</p>

<a href='addToCart.php?id=".$row['product_id']."'>
<button>Add to Cart</button>
</a>

<a href='addWishlist.php?id=".$row['product_id']."'>❤️</a>

</div>
</div>";
}
?>

</div>

</div>

<?php include 'footer.php'; ?>