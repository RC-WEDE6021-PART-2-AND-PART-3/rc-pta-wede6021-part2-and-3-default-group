<?php
include 'header.php';
include 'DBConn.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tblUser 
            WHERE username='$username' 
            AND password='$password' 
            AND is_verified=1";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];

        header("Location: index.php");
    } else {
        echo "<p style='color:red;'>Invalid login or not verified  Register account</p>";
    }
}
?>

<div class="container">

<h2>Login</h2>

<form method="POST">

<input name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<p class="auth-link">
    Don't have an account?
    <a href="register.php">Register</a>
</p>

</div>

<?php include 'footer.php'; ?>