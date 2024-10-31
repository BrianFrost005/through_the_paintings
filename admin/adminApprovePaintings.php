<?php include('partials/adminClient.php'); ?>

<!--approve painting-->
<section class="approve-painting">
    <div class="banner"></div>
    <h2 class="sub-title">Approve Paintings</h>

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

    <!--display painting requests-->
    <div class="approve-painting-list">

        <?php
            //query to select all painter painting
            $sql = "SELECT * FROM table_painting WHERE painting_status='pending'";
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
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $painting_image = $rows['painting_image'];
                        $painting_status = $rows['painting_status'];

                        //display rows
                        ?>

                        <div class="approve-painting-list-box">
                            <div class="approve-painting-list-image">
                                <img src="<?php echo HOMEURL; ?>/images/paintings/<?php echo $painting_image?>" class="img-responsive img-curve">
                            </div>
                            <div class="approve-painting-list-info">
                                <h4><?php echo $painting_name ?></h4>
                                <p>By: <?php echo $painter_name?></p>
                                <p>Description: <?php echo $description ?></p>
                                <p>Price: RM<?php echo $price ?></p>
                                <p>Status: <?php echo $painting_status ?></p>
                                <br>
                                <a href="<?php echo HOMEURL; ?>admin/adminItemPage.php?id=<?php echo $id ?>" class="btn">view Painting</a>
                                <a href="<?php echo HOMEURL; ?>admin/decide-painting.php?id=<?php echo $id; ?>&painting_status=approved" class="btn">Approve Painting</a>
                                <a href="<?php echo HOMEURL; ?>admin/decide-painting.php?id=<?php echo $id; ?>&painting_status=rejected" class="btn">Reject Painting</a>

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
    <!--display painting requests-->
    <div class="clearfix"></div>
</section>
<!--approve painting-->

<?php include('partials/adminFooter.php'); ?>