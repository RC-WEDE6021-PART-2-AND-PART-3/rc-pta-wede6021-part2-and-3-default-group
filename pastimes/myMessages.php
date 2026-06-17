<?php
include 'header.php';
include 'DBConn.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT *
FROM tblMessages
WHERE user_id='$user_id'
ORDER BY date_sent DESC
");
?>

<div class="container">

<h2>My Messages</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="message-card">

    <p>
        <strong>Your Message:</strong><br>
        <?php echo $row['message']; ?>
    </p>

    <p>
        <strong>Admin Reply:</strong><br>
        <?php
        if(empty($row['admin_reply'])){
            echo "Waiting for admin response...";
        }else{
            echo $row['admin_reply'];
        }
        ?>
    </p>

</div>

<?php } ?>

</div>

<?php include 'footer.php'; ?>