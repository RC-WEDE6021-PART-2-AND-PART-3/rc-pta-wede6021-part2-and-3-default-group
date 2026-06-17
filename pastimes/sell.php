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
    $brand = $_POST['brand'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if(empty($image)){

        echo "<p style='color:red;'>Please select an image.</p>";

    } else {

        move_uploaded_file($tmp, "images/".$image);

        $sql = "INSERT INTO tblClothes
        (
            product_name,
            description,
            price,
            seller_id,
            image,
            category,
            brand
        )
        VALUES
        (
            '$name',
            '$desc',
            '$price',
            '$user_id',
            '$image',
            '$cat',
            '$brand'
        )";

        if($conn->query($sql)){

            echo "<p style='color:green;'>
                    Product uploaded successfully!
                  </p>";

        } else {

            echo "<p style='color:red;'>
                    SQL Error: ".$conn->error."
                  </p>";
        }
    }
}
?>

<div class="container">

    <h2>Submit Clothing Item for Sale</h2>

    <p>
        Complete the form below to list your clothing item.
    </p>

    <form method="POST" enctype="multipart/form-data">

        <input
            type="text"
            name="name"
            placeholder="Product Name"
            required>

        <br><br>

        <input
            type="number"
            step="0.01"
            name="price"
            placeholder="Price"
            required>

        <br><br>

        <input
            type="text"
            name="brand"
            placeholder="Brand"
            required>

        <br><br>

        <textarea
            name="description"
            placeholder="Description"
            rows="5"
            required></textarea>

        <br><br>

        <select name="category" required>

            <option value="">Select Category</option>

            <option value="Hoodies">Hoodies</option>

            <option value="Shoes">Shoes</option>

            <option value="Bags">Bags</option>

            <option value="Dresses">Dresses</option>

            <option value="Blazers">Blazers</option>

        </select>

        <br><br>

        <label>Upload Product Image</label>

        <br><br>

        <input
            type="file"
            name="image"
            accept="image/*"
            required>

        <br><br>

        <button name="upload">
            Upload Product
        </button>

    </form>

</div>

<?php include 'footer.php'; ?>