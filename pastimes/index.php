<?php include 'header.php'; ?>

<div class="hero">
   
    
    <div class="hero-content">
        <h1>Elevate Your Style</h1>
        <p>Curated luxury thrift pieces</p>
        <a href="products.php"><button>Shop Now</button></a>
    
</div>
</div>

<div class="container">

<h2>Featured Products</h2>

<div class="products">

<?php
include 'DBConn.php';
$res = $conn->query("SELECT * FROM tblClothes LIMIT 6");

while($row = $res->fetch_assoc()){
    echo "
    <div class='box'>
        <img src='images/".$row['image']."'>
        <div class='overlay'>
            <h3>".$row['product_name']."</h3>
            <p>R".$row['price']."</p>
        </div>
    </div>";
}
?>

</div>

</div>

<?php include 'footer.php'; ?>