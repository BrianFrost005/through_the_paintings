<?php include('partials/client.php'); ?>
<?php include('partials/login-check.php'); ?>

<section class="purchase-history">
    <div class="banner"></div>
    <h2 class="sub-title">My Purchase History</h2>

    <div class="painting-list">
        <?php
            $user_name = $_SESSION['user'];

            // Get the user's ID
            $user_query = "SELECT id FROM table_user WHERE user_name = '$user_name'";
            $user_res = mysqli_query($conn, $user_query);
            $user_row = mysqli_fetch_assoc($user_res);
            $user_id = $user_row['id'];

            // Query to get paintings from purchase history for the logged-in user
            $sql = "SELECT p.painting_name, p.price, p.painting_image, p.painter_name 
                    FROM table_painting p 
                    INNER JOIN table_history h ON p.id = h.painting_id 
                    WHERE h.user_id = '$user_id'";
            $res = mysqli_query($conn, $sql);

            // Check if there are any paintings in the user's purchase history
            if($res == TRUE && mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $painting_name = $row['painting_name'];
                    $price = $row['price'];
                    $painting_image = $row['painting_image'];
                    $painter_name = $row['painter_name'];
                    ?>

                    <div class="painting-box">
                        <div class="painting-image">
                            <img src="<?php echo HOMEURL; ?>images/paintings/<?php echo $painting_image; ?>" class="img-responsive img-curve">
                        </div>
                        <div class="painting-info">
                            <h4><?php echo $painting_name; ?></h4>
                            <p>By: <?php echo $painter_name; ?></p>
                            <p>Price: RM<?php echo $price; ?></p>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='error text-center'>You have no purchases yet.</div>";
            }
        ?>
    </div>

    <div class="clearfix"></div>
</section>

<?php include('partials/footer.php'); ?>
