<?php include('partials/client.php'); ?>
<?php include('partials/login-check.php'); ?>

<section class="user_cart">
    <div class="banner"></div>
    <h2 class="sub-title">My Cart</h2>
    
    <!-- Available Paintings Section -->
    <h3 class="sub-title">Available Paintings</h3>
    <form action="checkout.php" method="POST">
        <!-- Checkout Button -->
        <div class="checkout-button-background">
            <button type="submit" name="checkout" class="btn cart-btn">Checkout</button>
        </div>

        <div class="painting-list">
            <?php
                $user_name = $_SESSION['user'];

                // Fetch user ID based on user_name
                $sql_user = "SELECT id FROM table_user WHERE user_name = '$user_name'";
                $res_user = mysqli_query($conn, $sql_user);
                $user_id = mysqli_fetch_assoc($res_user)['id'];
                
                // Query to get available paintings added to cart by the logged-in user
                $sql_available = "SELECT p.id, p.painting_name, p.price, p.painting_image, p.painter_name 
                                  FROM table_painting p 
                                  INNER JOIN table_cart c ON p.id = c.painting_id 
                                  LEFT JOIN table_history h ON p.id = h.painting_id AND h.user_id = '$user_id'
                                  WHERE c.user_name = '$user_name' 
                                  AND p.painting_status = 'approved' 
                                  AND p.purchase_status = 'available' 
                                  AND h.painting_id IS NULL";
                
                $res_available = mysqli_query($conn, $sql_available);

                if ($res_available == TRUE && mysqli_num_rows($res_available) > 0) {
                    while ($row = mysqli_fetch_assoc($res_available)) {
                        $painting_id = $row['id'];
                        $painting_name = $row['painting_name'];
                        $price = $row['price'];
                        $painting_image = $row['painting_image'];
                        $painter_name = $row['painter_name'];
                        ?>

                        <div class="painting-box">
                            <input type="checkbox" name="selected_paintings[]" value="<?php echo $painting_id; ?>">
                            <div class="painting-image">
                                <img src="<?php echo HOMEURL; ?>images/paintings/<?php echo $painting_image; ?>" class="img-responsive img-curve">
                            </div>
                            <div class="painting-info">
                                <h4><?php echo $painting_name; ?></h4>
                                <p>By: <?php echo $painter_name; ?></p>
                                <p>Price: RM<?php echo $price; ?></p>
                                <br>
                                <a href="<?php echo HOMEURL; ?>paintingItemPage.php?id=<?php echo $painting_id; ?>" class="btn">View</a>
                                <br><br>
                                <a href="<?php echo HOMEURL; ?>remove-from-cart.php?id=<?php echo $painting_id; ?>" class="btn">Remove from Cart</a>
                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo "<div class='error text-center'>No available paintings in your cart.</div>";
                }
            ?>
        </div>
    </form>

    <div class="clearfix"></div>
    <!-- Unavailable Paintings Section -->
    <h3 class="sub-title">Unavailable Paintings</h3>
    <div class="painting-list">
        <?php
            // Query to get sold paintings added to cart by the logged-in user
            $sql_sold = "SELECT p.id, p.painting_name, p.price, p.painting_image, p.painter_name 
                                FROM table_painting p 
                                INNER JOIN table_cart c ON p.id = c.painting_id
                                LEFT JOIN table_history h ON p.id = h.painting_id AND h.user_id = '$user_id' 
                                WHERE c.user_name = '$user_name' 
                                AND p.painting_status = 'approved'
                                AND p.purchase_status = 'sold' 
                                AND h.painting_id IS NULL";
                                
            $res_sold = mysqli_query($conn, $sql_sold);

            // Display sold paintings
            if ($res_sold == TRUE && mysqli_num_rows($res_sold) > 0) {
                while ($row = mysqli_fetch_assoc($res_sold)) {
                    $painting_id = $row['id'];
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
                            <br>
                            <p class="error">This item is no longer available.</p>
                            <br>
                            <a href="<?php echo HOMEURL; ?>remove-from-cart.php?id=<?php echo $painting_id; ?>" class="btn">Remove from Cart</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='error text-center'>No unavailable paintings in your cart.</div>";
            }
        ?>
    </div>

    <div class="clearfix"></div>
</section>

<?php include('partials/footer.php'); ?>
