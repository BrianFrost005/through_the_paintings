<?php include('partials/client.php'); ?>

<section class="painter-content">
    <div class="banner"></div>

    <!--session variable-->
    <div class="text-center">
    </div>
    <!--session variable-->

    <!--item details-->
    <div class="painter-page-box">
        <?php
            //get id
            $id = $_GET['id'];

            //query to select all painter painting
            $sql = "SELECT * FROM table_painter WHERE id=$id";
            //execute query
            $res = mysqli_query($conn, $sql);

            //check if query executed
            if($res==TRUE)
            {
                //count rows
                $count = mysqli_num_rows($res); //functionn get all rows

                //check no. rows
                if($count==1)
                {
                    $rows=mysqli_fetch_assoc($res);

                    //get each data
                    $id = $rows['id'];
                    $profile_image = $rows['profile_image'];
                    $painter_name = $rows['painter_name'];
                    $painting_name1 = $rows['painting_name1'];
                    $painting_name2 = $rows['painting_name2'];
                    $painting_name3 = $rows['painting_name3'];

                    //display rows
                    ?>

                    <div class="painter-page-info">
                        <div class="painter-page-profile-image">
                            <img src="<?php echo HOMEURL; ?>images/painter/<?php echo $profile_image?>" class="img-responsive img-curve">
                        </div>
                        <h4>Painter name: <?php echo $painter_name ?></h4>
                        <a href="<?php echo HOMEURL; ?>painterPaintings.php?painter_name=<?php echo $painter_name; ?>" class="btn">Browse paintings by painter</a>
                        <br>
                        <a href="<?php echo HOMEURL; ?>painter.php" class="btn">Back</a>
                    </div>
                    <div class="painter-page-image">
                        <img src="<?php echo HOMEURL; ?>images/application-paintings/<?php echo $painting_name1?>" class="img-responsive img-curve">
                    
                        <img src="<?php echo HOMEURL; ?>images/application-paintings/<?php echo $painting_name2?>" class="img-responsive img-curve">
                    
                        <img src="<?php echo HOMEURL; ?>images/application-paintings/<?php echo $painting_name3?>" class="img-responsive img-curve">
                    </div>
                    
                    <?php
                }
                else
                {
                    //no data
                }
            }
        ?>
    </div>
    <div class="clearfix"></div>
</section>

<?php include('partials/footer.php'); ?>