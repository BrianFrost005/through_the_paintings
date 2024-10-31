<?php include('partials/client.php'); ?>

    <!-- painting search section starts here -->
    <section class="painting-search">
        <form action="<?php echo HOMEURL ?>painting-search.php">
            <input type="search" name="search" placeholder="Search for Paintings by name or painter..." required>
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
    </section>
    <!-- painting search section ends here -->

    <!-- categories section starts here -->
    <section class="categories">
        <div class="session-message">
            <!-- session variable -->
            <?php 
                //message shown when login success 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                //message shown when not logged in
                if(isset($_SESSION['not-logged-in']))
                {
                    echo $_SESSION['not-logged-in'];
                    unset($_SESSION['not-logged-in']);
                }
                //message shown when register painter
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
        <!-- sessio variable -->
        </div>

        <h2 class="sub-title">Explore Painters</h>
        <!-- display painters-->
        <div class="category-list">

        <?php
            // Query to fetch 3 random approved painters
            $sql = "SELECT * FROM table_painter WHERE painter_status='approved' ORDER BY RAND() LIMIT 3";
            // Execute query
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully and fetch rows
            if($res == TRUE && mysqli_num_rows($res) > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    // Get painter data
                    $painter_name = $row['painter_name'];
                    $profile_image = $row['profile_image'];
                    $id = $row['id']; // You may use this to link to the painter's profile page

                    // Display the painter box
                    ?>
                    <a href="<?php echo HOMEURL; ?>painterPage.php?id=<?php echo $id ?>" class="category-box">
                        <div>
                            <img src="<?php echo HOMEURL; ?>images/painter/<?php echo $profile_image; ?>" class="category-image img-responsive img-curve">
                            <h4><?php echo $painter_name; ?></h4>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                // If no painters found
                echo "<p>No painters found</p>";
            }
        ?>
        </div>
        <!-- display painters-->
        <div class="clearfix"></div>
    </section>
    <!-- categories section ends here -->

    <!-- painting section starts here -->
    <section class="paintings">
        <h2 class="sub-title">Featured Paintings</h2> 
        <!--display paintings-->
        <div class="painting-list">
        <?php
            // Query to select 20 random approved paintings
            $sql = "SELECT * FROM table_painting WHERE painting_status = 'approved' AND purchase_status = 'available' ORDER BY RAND() LIMIT 20";
            
            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if any paintings were found
            if ($res == TRUE && mysqli_num_rows($res) > 0)
            {
                // Fetch each painting
                while ($row = mysqli_fetch_assoc($res))
                {
                    // Retrieve painting details
                    $painting_name = $row['painting_name'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $painting_image = $row['painting_image'];
                    $id = $row['id']; // Assuming each painting has an ID for view link

                    // Display each painting
                    ?>
                    <div class="painting-box">
                        <div class="painting-image">
                            <img src="<?php echo HOMEURL; ?>images/paintings/<?php echo $painting_image; ?>" class="img-responsive img-curve">
                        </div>
                        <div class="painting-info">
                            <h4><?php echo $painting_name; ?></h4>
                            <p>Price: RM<?php echo $price; ?></p>
                            <p>Description: <?php echo $description; ?></p>
                            <br>
                            <a href="<?php echo HOMEURL; ?>paintingItemPage.php?id=<?php echo $id; ?>" class="btn">View</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                // If no paintings are found
                echo "<div class='error'>No approved paintings available at the moment.</div>";
            }
        ?>
        </div>
        <!--display paintings-->
        <div class="clearfix"></div>
    </section>
    <!-- painting section ends here -->

<?php include('partials/footer.php'); ?>