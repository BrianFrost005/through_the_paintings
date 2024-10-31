<?php include('partials/client.php'); ?>

    <!-- painting search section starts here -->
    <section class="painting-search">
        <form action="<?php echo HOMEURL ?>painter-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Painters..." required>
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
    </section>
    <!-- painting search section ends here -->

    <!-- session variables -->
    <!-- session variables -->

    <!--artist section-->
    <section class="painter">
        <h2 class="sub-title">Painters</h2>
        <!--display painters-->
        <div class="painter-list">

        <?php
            //query to select all painter
            $sql = "SELECT * FROM table_painter WHERE painter_status='approved'";
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
                        $painter_name = $rows['painter_name'];
                        $profile_image = $rows['profile_image'];

                        //display rows
                        ?>
      
                        <a href="<?php echo HOMEURL; ?>painterPage.php?id=<?php echo $id ?>" class="painter-box">
                            <div>
                                <img src="<?php echo HOMEURL ?>images/painter/<?php echo $profile_image ?>" class="painter-image img-responsive img-curve">
                                <h4><?php echo $painter_name ?></h4>
                            </div>
                        </a>
                        
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