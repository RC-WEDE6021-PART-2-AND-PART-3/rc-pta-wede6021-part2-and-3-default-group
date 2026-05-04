<?php
include 'header.php';
include 'DBConn.php';

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO tblUser 
    (name,email,username,password) 
    VALUES ('$name','$email','$username','$password')";

    if($conn->query($sql)){
        echo "<p style='color:green;'>Registered! Wait for admin approval</p>";
    } else {
        echo "<p style='color:red;'>Error: ".$conn->error."</p>";
    }
}
?>

<div class="container">

<h2>Register</h2>

<form method="POST">

<input name="name" placeholder="Full Name" required>

<input name="email" placeholder="Email" required>

<input name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="register">Register</button>

</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</div>

<?php include 'footer.php'; ?>