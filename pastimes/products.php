<?php include 'header.php'; ?>
<?php include 'DBConn.php'; ?>

<div class="container">

<h2>Shop Collection</h2>

<!-- Search Bar -->
<form method="GET" class="search-bar">

    <input type="text"
           name="search"
           placeholder="Search products, brands or categories">

    <button type="submit">
        Search
    </button>

</form>

<div class="products">

<?php

if(isset($_GET['search']) && !empty($_GET['search'])){

    $search = $_GET['search'];

    $sql = "SELECT * FROM tblClothes
            WHERE product_name LIKE '%$search%'
            OR brand LIKE '%$search%'
            OR category LIKE '%$search%'";

}else{

    $sql = "SELECT * FROM tblClothes";
}

$res = $conn->query($sql);

while($row = $res->fetch_assoc()){

echo "

<div class='box'>

<img src='images/".$row['image']."'>


<div class='overlay'>

<h3>".$row['product_name']."</h3>

<p><strong>Brand:</strong> ".$row['brand']."</p>

<p>".$row['description']."</p>

<p><strong>Category:</strong> ".$row['category']."</p>

<p><strong>Price:</strong> R".$row['price']."</p>

<a href='addToCart.php?id=".$row['product_id']."'>
<button>Add to Cart</button>
</a>

<br><br>

<a href='addWishlist.php?id=".$row['product_id']."'>
❤️ Add to Wishlist
</a>

</div>

</div>

";
}
?>

</div>

</div>

<?php include 'footer.php'; ?>