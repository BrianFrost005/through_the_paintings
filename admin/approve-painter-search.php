<?php include('partials/adminClient.php'); ?>

<!-- painting search section starts here -->
<section class="painting-search">
    <form action="<?php echo HOMEURL ?>admin/approve-painter-search.php" method="POST">
        <input type="search" name="search" placeholder="Search for Painter..." required>
        <input type="submit" name="submit" value="Search" class="btn">
    </form>
</section>
<!-- painting search section ends here -->

<!--painter paintings-->
<section class="painters">
    <h2 class="sub-title">Search Results for Painters</h2>

    <!--session variable-->
    <div class="text-center">
    <?php
        // Show session message (e.g., updates, approvals)
        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>
    </div>
    <!--session variable-->

    <div class="painter-list">
    <?php
        if (isset($_POST['submit'])) {
            // Get the search input and escape it for security
            $search = mysqli_real_escape_string($conn, $_POST['search']);

            // Query to search for approved painters by name
            $sql = "SELECT * FROM table_painter WHERE painter_name LIKE '%$search%' AND painter_status='pending'";
            $res = mysqli_query($conn, $sql);

            // Check if any painters match the search query
            if ($res == TRUE && mysqli_num_rows($res) > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    // Fetch painter details
                    $id = $rows['id'];
                    $painter_name = $rows['painter_name'];
                    $profile_image = $rows['profile_image'];
                    $painter_status = $rows['painter_status'];

                    // Display painter details
                    ?>

                    <div class="painter-box">
                        <div class="painter-profile-image">
                            <img src="<?php echo HOMEURL ?>images/painter/<?php echo $profile_image ?>" class="img-responsive img-curve">
                        </div>
                        <div class="painter-info">
                            <h4>Painter Name: <?php echo $painter_name; ?></h4>
                            <p>Status: <?php echo $painter_status; ?></p>
                            <br>
                            <a href="<?php echo HOMEURL; ?>admin/adminPainterPage.php?id=<?php echo $id ?>" class="btn">View Painter</a>
                            <a href="<?php echo HOMEURL; ?>admin/decide-painter.php?id=<?php echo $id; ?>&painter_status=rejected" class="btn">Reject Painter</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                // If no painters match the search query
                echo "<div class='error'>No Painters Found Matching Your Search.</div>";
            }
        }
    ?>
    </div>

    <div class="clearfix"></div>
</section>

<?php include('partials/adminFooter.php'); ?>
