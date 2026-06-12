<?php
include 'header.php';
include 'DBConn.php';



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['upload'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // CHECK IMAGE
    if(empty($image)){
        echo "Please select an image";
    } else {

        move_uploaded_file($tmp, "images/".$image);

        $sql = "INSERT INTO tblClothes 
        (product_name, description, price, seller_id, image, category)
        VALUES ('$name', '$desc', '$price', '$user_id', '$image', '$cat')";

        if($conn->query($sql)){
            echo "<p style='color:green;'>Product uploaded successfully!</p>";
        } else {
            echo "<p style='color:red;'>SQL Error: ".$conn->error."</p>";
        }
    }
}
?>

<div class="container">
<h2>Sell Your Item</h2>

<form method="POST" enctype="multipart/form-data">

<input name="name" placeholder="Product Name" required>

<input name="price" placeholder="Price" required>

<input type="text" name="brand" placeholder="Brand" required>

<textarea name="description" placeholder="Description"></textarea>

<select name="category">
<option value="Hoodies">Hoodies</option>
<option value="Shoes">Shoes</option>
<option value="bags">Bags</option>
<option value="Dresses">Dresses</option>
<option value="blazers">Blazers</option>
</select>

<input type="file" name="image" required>

<button name="upload">Upload</button>

</form>
</div>

<?php include 'footer.php'; ?>