<?php include('partials/client.php'); ?>

<section class="painter-paintings">
    <div class="banner"></div>
    <div class="sub-title">Painter's Profile</div>
    <div class="painter-paintings-content">
        <div class="painter-paintings-profile">
            <?php
                // Get the painter's name from the URL
                if (isset($_GET['painter_name'])) {
                    $painter_name = mysqli_real_escape_string($conn, $_GET['painter_name']);

                    // Query to get the painter's profile details
                    $sql_profile = "SELECT * FROM table_painter WHERE painter_name='$painter_name' AND painter_status='approved'";
                    $res_profile = mysqli_query($conn, $sql_profile);

                    if ($res_profile == TRUE && mysqli_num_rows($res_profile) == 1) {
                        $painter = mysqli_fetch_assoc($res_profile);
                        $profile_image = $painter['profile_image'];
                        ?>
                        <div class="painter-paintings-profile-image">
                            <img src="<?php echo HOMEURL; ?>images/painter/<?php echo $profile_image; ?>" class="img-responsive img-curve">
                        </div>
                        <div class="painter-paintings-painter-name">
                            <h4><?php echo $painter_name; ?></h4>
                        </div>

                        <?php
                    }
                }
            ?>
        </div>

        <div class="painter-paintings-display">
            <?php
            // Query to get all approved paintings by this painter
            if (isset($painter_name)) {
                $sql = "SELECT * FROM table_painting WHERE painter_name='$painter_name' AND painting_status='approved'";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE && mysqli_num_rows($res) > 0) {
                    while ($painting = mysqli_fetch_assoc($res)) {
                        $painting_id = $painting['id'];
                        $painting_name = $painting['painting_name'];
                        $price = $painting['price'];
                        $painting_image = $painting['painting_image'];
                        ?>
                        <div class="painter-paintings-box">
                            <div class="painter-paintings-image">
                                <img src="<?php echo HOMEURL; ?>/images/paintings/<?php echo $painting_image; ?>" class="img-responsive img-curve">
                            </div>
                            <div class="painter-paintings-info">
                                <h4><?php echo $painting_name; ?></h4>
                                <p>Price: RM<?php echo $price; ?></p>
                                <br>
                                <a href="<?php echo HOMEURL; ?>paintingItemPage.php?id=<?php echo $painting_id; ?>" class="btn">View Painting</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='error'>No approved paintings found for this painter.</div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="clearfix">
</section>

<?php include('partials/footer.php'); ?>