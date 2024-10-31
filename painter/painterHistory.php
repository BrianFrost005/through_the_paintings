<?php 
include('partials/painterClient.php'); 

// Get the painter's name from the session
$painter_name = $_SESSION['user'];

// Query to get all sold paintings by the painter
$sql = "SELECT * FROM table_painting WHERE painter_name = '$painter_name' AND purchase_status = 'sold'";
$res = mysqli_query($conn, $sql);
?>

<!-- Painter history section -->
<section class="painter-history">
    <div class="banner"></div>
    <h2 class="sub-title">Sold Paintings History</h2>

    <!-- Display history -->
    <div class="history-list">
        <?php
        // Check if there are any sold paintings
        if ($res == TRUE && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $painting_name = $row['painting_name'];
                $price = $row['price'];
                $description = $row['description'];
                $painting_image = $row['painting_image'];
                $painting_id = $row['id'];
                ?>
                
                <!-- Display each sold painting -->
                <div class="history-box">
                    <div class="history-image">
                        <img src="<?php echo HOMEURL; ?>images/paintings/<?php echo $painting_image; ?>" class="img-responsive img-curve">
                    </div>
                    <div class="history-info">
                        <h4><?php echo $painting_name; ?></h4>
                        <p>Price: RM<?php echo $price; ?></p>
                        <p>Description: <?php echo $description; ?></p>
                        <br>
                        <a href="<?php echo HOMEURL; ?>painter/painterItemPage.php?id=<?php echo $painting_id; ?>" class="btn">View</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<div class='error text-center'>No sold paintings found.</div>";
        }
        ?>
    </div>
    <!-- Display history end -->
    <div class="clearfix"></div>
</section>
<!-- Painter history section end -->

<?php include('partials/painterFooter.php'); ?>
