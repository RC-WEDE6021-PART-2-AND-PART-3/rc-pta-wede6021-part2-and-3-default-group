<?php
include 'header.php';
include 'DBConn.php';

if(isset($_POST['reply'])){

    $message_id = $_POST['message_id'];
    $admin_reply = $_POST['admin_reply'];

    $sql = "UPDATE tblMessages
            SET admin_reply='$admin_reply'
            WHERE message_id='$message_id'";

   if($conn->query($sql)){
    echo "<div class='success'>Reply sent successfully!</div>";
} else {
    echo "<div class='error'>".$conn->error."</div>";
}
}

$result = $conn->query("
SELECT tblMessages.*, tblUser.username
FROM tblMessages
JOIN tblUser
ON tblMessages.user_id = tblUser.user_id
ORDER BY date_sent DESC
");
?>

<div class="container">

<h2>Customer Messages</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="message-card">

    <h3><?php echo $row['username']; ?></h3>

    <p>
        <strong>Customer Message:</strong><br>
        <?php echo $row['message']; ?>
    </p>

    <p>
        <strong>Admin Reply:</strong><br>
        <?php echo $row['admin_reply']; ?>
    </p>

    <form method="POST">

        <input type="hidden"
               name="message_id"
               value="<?php echo $row['message_id']; ?>">

        <textarea
            name="admin_reply"
            placeholder="Type your reply..."
            required></textarea>

        <br><br>

        <button name="reply">
            Send Reply
        </button>

    </form>

</div>

<?php } ?>

</div>

<?php include 'footer.php'; ?>