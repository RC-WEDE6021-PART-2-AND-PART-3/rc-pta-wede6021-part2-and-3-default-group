<?php
include 'header.php';
include 'DBConn.php';

$result = $conn->query("SELECT * FROM tblUser WHERE is_verified = 0");
?>

<div class="container">

    <h2>Admin Dashboard</h2>

    <div class="admin-grid">

        <?php while($row = $result->fetch_assoc()){ ?>

            <div class="admin-card">

                <h3><?php echo $row['name']; ?></h3>

                <p>
                    Username:
                    <?php echo $row['username']; ?>
                </p>

                <p>
                    Email:
                    <?php echo $row['email']; ?>
                </p>

                <a href="verify.php?id=<?php echo $row['user_id']; ?>">
                    <button>Verify User</button>
                </a>

            </div>

        <?php } ?>

    </div>

</div>

<?php include 'footer.php'; ?>