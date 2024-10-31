<?php include('partials/adminClient.php'); ?>

<!-- painting search section starts here -->
<section class="painting-search">
        <form action="<?php echo HOMEURL ?>admin/approve-painter-search.php">
            <input type="search" name="search" placeholder="Search for Painter..." required>
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
</section>
<!-- painting search section ends here -->

<!--painter paintings-->
<section class="painters">
    <h2 class="sub-title">Approve Painters</h2>

    <!--session variable-->
    <div class="text-center">
    <?php
        //message shown when update food
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>
    </div>
    <!--session variable-->

    <!--display paintings-->
    <div class="painting-list">

        <?php
            //query to select all painter
            $sql = "SELECT * FROM table_painter WHERE painter_status IN ('pending', 'rejected')";
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
                        $painter_status = $rows['painter_status'];

                        //display rows
                        ?>

                        <div class="painter-box">
                            <div class="painter-profile-image">
                                <img src="<?php echo HOMEURL ?>images/painter/<?php echo $profile_image ?>" class="img-responsive img-curve">
                            </div>
                            <div class="painter-info">
                                <h4>Painter name: <?php echo $painter_name ?></h4>
                                <p>status: <?php echo $painter_status ?></p>
                                <br>
                                <a href="<?php echo HOMEURL; ?>admin/adminPainterPage.php?id=<?php echo $id ?>" class="btn">view Painter</a>
                                <a href="<?php echo HOMEURL; ?>admin/decide-painter.php?id=<?php echo $id; ?>&painter_status=approved" class="btn">Approve</a>
                                <a href="<?php echo HOMEURL; ?>admin/decide-painter.php?id=<?php echo $id; ?>&painter_status=rejected" class="btn">Reject</a>
                                <a href="<?php echo HOMEURL; ?>admin/decide-painter.php?id=<?php echo $id; ?>&painter_status=delete" class="btn">Delete</a>

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
    <!--display paintings-->
    <div class="clearfix"></div> 
</section>
<!--painter paintings-->

<?php include('partials/adminFooter.php'); ?>