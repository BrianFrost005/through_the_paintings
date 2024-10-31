<?php include('partials/client.php'); ?>

<section class="painting-search">
    <form action="<?php echo HOMEURL ?>painter-search.php" method="POST">
        <input type="search" name="search" placeholder="Search for Painters..." required>
        <input type="submit" name="submit" value="Search" class="btn">
    </form>
</section>

<section class="painter">
    <h2 class="sub-title">Search Results</h2>

    <div class="painter-list">
    <?php
        if(isset($_POST['submit']))
        {
            // Get the search input and prevent SQL injection
            $search = mysqli_real_escape_string($conn, $_POST['search']);

            // Query to search for approved painters by name
            $sql = "SELECT * FROM table_painter WHERE painter_name LIKE '%$search%' AND painter_status='approved'";
            $res = mysqli_query($conn, $sql);

            // Check if any results match the search
            if($res==TRUE && mysqli_num_rows($res) > 0)
            {
                while($rows = mysqli_fetch_assoc($res))
                {
                    // Get the painter data
                    $id = $rows['id'];
                    $painter_name = $rows['painter_name'];
                    $profile_image = $rows['profile_image'];

                    // Display the matching painters
                    ?>
                    <a href="<?php echo HOMEURL; ?>painterPage.php?id=<?php echo $id ?>" class="painter-box">
                        <div>
                            <img src="<?php echo HOMEURL; ?>images/painter/<?php echo $profile_image ?>" class="painter-image img-responsive img-curve">
                            <h4><?php echo $painter_name; ?></h4>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                // No painters found matching the search term
                echo "<div class='error'>No Painters Found Matching Your Search.</div>";
            }
        }
    ?>
    </div>

    <div class="clearfix"></div>
</section>

<?php include('partials/footer.php'); ?>
