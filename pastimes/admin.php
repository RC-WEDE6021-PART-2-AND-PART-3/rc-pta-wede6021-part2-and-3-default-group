<?php
include 'header.php';
include 'DBConn.php';

$result = $conn->query("SELECT * FROM tblUser");
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

                <p>
                    Status:
                    <?php
                    if($row['is_verified'] == 1){
                        echo "Verified";
                    } else {
                        echo "Not Verified";
                    }
                    ?>
                </p>

                <?php if($row['is_verified'] == 0){ ?>
                    <a href="verify.php?id=<?php echo $row['user_id']; ?>">
                        <button>Verify User</button>
                    </a>
                <?php } ?>

                <br><br>

                <a href="editUser.php?id=<?php echo $row['user_id']; ?>">
                    <button>Edit User</button>
                </a>

                <br><br>

                <a href="deleteUser.php?id=<?php echo $row['user_id']; ?>"
                   onclick="return confirm('Delete this user?');">
                    <button>Delete User</button>
                </a>

            </div>

        <?php } ?>

    </div>

</div>

<?php include 'footer.php'; ?>