<?php include('partials/painterClient.php'); ?>

<!-- painting search section starts here -->
<section class="painting-search">
    <form action="<?php echo HOMEURL ?>painter/painting-search.php" method="POST">
        <input type="search" name="search" placeholder="Search for Your Paintings..." required>
        <input type="submit" name="submit" value="Search" class="btn">
    </form>
</section>
<!-- painting search section ends here -->

<!-- painter paintings -->
<section class="painter-paintings">
    <h2 class="sub-title">Search Results</h2>

    <!-- session variable for feedback messages -->
    <div class="text-center">
    <?php
        if (isset($_SESSION['search'])) {
            echo $_SESSION['search'];
            unset($_SESSION['search']);
        }
    ?>
    </div>
    <!-- session variable end -->

    <!-- display paintings -->
    <div class="painting-list">

        <?php
            if (isset($_POST['search'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                $user = $_SESSION['user'];

                // SQL query to search for paintings
                $sql = "SELECT * FROM table_painting WHERE painter_name='$user' AND painting_name LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $painting_name = $row['painting_name'];
                            $painter_name = $row['painter_name'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $painting_image = $row['painting_image'];
                            $painting_status = $row['painting_status'];
                            ?>

                            <div class="painting-box">
                                <div class="painting-image">
                                    <img src="<?php echo HOMEURL; ?>/images/paintings/<?php echo $painting_image ?>" class="img-responsive img-curve">
                                </div>
                                <div class="painting-info">
                                    <h4><?php echo $painting_name ?></h4>
                                    <p>By: <?php echo $painter_name ?></p>
                                    <p>Description: <?php echo $description ?></p>
                                    <p>Price: RM<?php echo $price ?></p>
                                    <p>Status: <?php echo $painting_status ?></p>
                                    <br>
                                    <a href="<?php echo HOMEURL; ?>painter/painterItemPage.php?id=<?php echo $id ?>" class="btn">View Painting</a>
                                    <a href="<?php echo HOMEURL; ?>painter/delete-painting.php?id=<?php echo $id; ?>&painting_image=<?php echo $painting_image; ?>" class="btn">Delete Painting</a>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo "<div class='error text-center'>No paintings found matching your search.</div>";
                    }
                }
            } else {
                echo "<div class='error text-center'>No search term provided.</div>";
            }
        ?>

    </div>
    <!-- display paintings end -->
    <div class="clearfix"></div> 
</section>
<!-- painter paintings end -->

<?php include('partials/painterFooter.php'); ?>
