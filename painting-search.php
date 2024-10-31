<?php include('partials/client.php'); ?>

<section class="painting-search">
    <form action="<?php echo HOMEURL ?>painting-search.php" method="POST">
        <input type="search" name="search" placeholder="Search for Paintings by name or painter..." required>
        <input type="submit" name="submit" value="Search" class="btn">
    </form>
</section>

<section class="paintings">
    <h2 class="sub-title">Search Results</h2>

    <div class="painting-list">
    <?php
        if(isset($_POST['submit']))
        {
            // Get the search input and prevent SQL injection
            $search = mysqli_real_escape_string($conn, $_POST['search']);

            // Query to search for approved painting by name or painter
            // $sql = "SELECT * FROM table_painting WHERE painting_name LIKE '%$search%' AND painting_status='approved'";
            $sql = "SELECT * FROM table_painting WHERE (painting_name LIKE '%$search%' OR painter_name LIKE '%$search%') AND painting_status='approved' AND purchase_status = 'available'";

            $res = mysqli_query($conn, $sql);

            // Check if any results match the search
            if($res==TRUE && mysqli_num_rows($res) > 0)
            {
                while($rows=mysqli_fetch_assoc($res))
                    {
                        //get each data
                        $id = $rows['id'];
                        $painting_name = $rows['painting_name'];
                        $painter_name = $rows['painter_name'];
                        $price = $rows['price'];
                        $painting_image = $rows['painting_image'];

                        //display rows
                        ?>

                        <div class="painting-box">
                            <div class="painting-image">
                                <img src="<?php echo HOMEURL; ?>/images/paintings/<?php echo $painting_image?>" class="img-responsive img-curve">
                            </div>
                            <div class="painting-info">
                                <h4><?php echo $painting_name ?></h4>
                                <p>By: <?php echo $painter_name?></p>
                                <p>Price: RM<?php echo $price ?></p>
                                <br>
                                <a href="<?php echo HOMEURL; ?>paintingItemPage.php?id=<?php echo $id ?>" class="btn">view Painting</a>
                            </div>
                        </div>

                        <?php
                    }
            }
            else
            {
                // No painters found matching the search term
                echo "<div class='error'>No Paintings Found Matching Your Search.</div>";
            }
        }
    ?>
    </div>

    <div class="clearfix"></div>
</section>

<?php include('partials/footer.php'); ?>
