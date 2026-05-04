<?php
include 'header.php';
include 'DBConn.php';

$id = $_GET['id'];

$conn->query("
UPDATE tblUser 
SET is_verified = 1 
WHERE user_id = $id
");
?>

<div class="auth-container">

    <div class="success-box">

        <h2>User Verified ✅</h2>

        <p>
            The customer has been successfully verified.
        </p>

        <a href="admin.php">
            <button>Go Back</button>
        </a>

    </div>

</div>

<?php include 'footer.php'; ?>