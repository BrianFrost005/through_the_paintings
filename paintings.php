<?php include('partials/client.php'); ?>

    <!-- painting search section starts here -->
    <section class="painting-search">
        <form action="<?php echo HOMEURL ?>painting-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Paintings by name or painter..." required>
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
    </section>
    <!-- painting search section ends here -->

    <!-- session variables -->
    <!-- session variables -->

    <!--artist section-->
    <section class="paintings">
        <h2 class="sub-title">Paintings</h2>
        <!--display painters-->
        <div class="painting-list">

        <?php
            //query to select all painter painting
            $sql = "SELECT * FROM table_painting WHERE painting_status='approved' AND purchase_status = 'available'";
            //execute query
            $res = mysqli_query($conn, $sql);

            //check if query executed
            if($res==TRUE)
            {
                //count rows
                $count = mysqli_num_rows($res); //functionn get all rows

                //check no. rows
                if($count>0)
                {
                    //have data
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
                    //no data
                }
            }
        ?>

        </div>
        <!--display painters-->
        <div class="clearfix"></div>
</section>
<!--artist section-->

<?php include('partials/footer.php'); ?>