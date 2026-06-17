<?php
include 'header.php';
include 'DBConn.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['send'])){

    $message = $_POST['message'];

    $sql = "INSERT INTO tblMessages(user_id, message)
            VALUES('$user_id','$message')";

    if($conn->query($sql)){
        echo "<div class='success'>Message sent successfully!</div>";
    }else{
        echo "<div class='error'>".$conn->error."</div>";
    }
}
?>

<div class="container">

<h2>Contact Administrator</h2>

<form method="POST">

    <textarea
        name="message"
        placeholder="Type your message here..."
        required>
    </textarea>

    <br><br>

    <button name="send">
        Send Message
    </button>

</form>

</div>

<?php include 'footer.php'; ?>