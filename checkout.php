<?php
include('partials/client.php');
include('partials/login-check.php');
?>

<section class="checkout">
    <div class="banner"></div>
    <h2 class="sub-title">Checkout</h2>
    <div class="painting-list">
        <?php

        if (isset($_POST['selected_paintings'])) {
            $selected_paintings = $_POST['selected_paintings'];
            $user_name = $_SESSION['user'];
        } else {
            echo "<div class='error'>No paintings selected for checkout.</div>";
            exit;
        }

        foreach ($selected_paintings as $painting_id) {
            // Query to fetch painting details
            $sql = "SELECT painting_name, price, painting_image, painter_name FROM table_painting WHERE id = '$painting_id'";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE && mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
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
        }
        ?>
    </div>

    <div class="clearfix">
    <!-- Confirm Checkout Form -->
    <form action="confirm-checkout.php" class="text-center" method="POST">
        <?php foreach ($selected_paintings as $painting_id): ?>
            <input type="hidden" name="selected_paintings[]" value="<?php echo $painting_id; ?>">
        <?php endforeach; ?>
        <button type="submit" name="confirm_checkout" class="btn">Confirm Checkout and Payment</button>
    </form>
</section>
