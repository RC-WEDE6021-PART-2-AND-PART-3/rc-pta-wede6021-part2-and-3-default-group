<?php
include 'DBConn.php';

$id = $_GET['id'];

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $sql = "UPDATE tblUser
            SET name='$name',
                email='$email',
                username='$username'
            WHERE user_id='$id'";

    $conn->query($sql);

    header("Location: admin.php");
    exit();
}

$result = $conn->query("SELECT * FROM tblUser WHERE user_id='$id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">

<h2>Edit User</h2>

<form method="POST">

    <input type="text"
           name="name"
           value="<?php echo $row['name']; ?>"
           required>

    <input type="email"
           name="email"
           value="<?php echo $row['email']; ?>"
           required>

    <input type="text"
           name="username"
           value="<?php echo $row['username']; ?>"
           required>

    <button name="update">Update User</button>

</form>

</div>

</body>
</html>