<?php 
include('partials/client.php'); 

// Get the painting ID from the URL
$painting_id = $_GET['id'];

// Query to get all journey entries for this painting
$sql = "SELECT * FROM table_journey WHERE painting_id = '$painting_id' ORDER BY id ASC";
$res = mysqli_query($conn, $sql);
?>

<!--painting journey section-->
<section class="painting-journey">
    <div class="banner"></div>
    <h4 class="sub-title">Painting's Journey</h4>
    <br>

    <!--back button-->
    <div class="painting-journey-add text-center">
        <a href="<?php echo HOMEURL ?>paintingItemPage.php?id=<?php echo $painting_id ?>" class="btn">Back</a>
    </div>
    <br><br>
    <!--back button-->

    <!--session variable-->
    <div class="text-center">
    </div>
    <!--session variable-->

    <!--painting journey content-->
    <div class="painting-journey-content">
        <?php
        // Check if there are any journey entries
        if ($res == TRUE && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $journey_id = $row['id'];  // Unique ID for each journey entry
                $journey_image = $row['journey_image'];
                $journey_title = $row['journey_title'];
                $journey_comment = $row['journey_comment'];
                ?>
                
                <!--display each journey entry-->
                <div class="painting-journey-box">
                    <div class="painting-journey-image">
                        <img src="<?php echo HOMEURL; ?>/images/journey/<?php echo $journey_image; ?>" class="img-responsive img-curve">
                    </div>
                    <div class="painting-journey-box-divider"></div>
                    <div class="painting-journey-info">
                        <div class="painting-journey-info-title">
                            <?php echo $journey_title; ?>
                        </div>
                        <div class="painting-journey-info-comment">
                            <?php echo $journey_comment; ?>
                        </div>
                    </div>
                </div>
                <!--end of each journey entry-->
                
                <?php
            }
        } else {
            echo "<div class='error text-center journey-not-found'>No journey entries found for this painting.</div>";
        }
        ?>
    </div>
    <!--painting journey content-->
    <div class="clearfix"></div>   
</section>
<!--painting journey section-->

<?php include('partials/footer.php'); ?>
