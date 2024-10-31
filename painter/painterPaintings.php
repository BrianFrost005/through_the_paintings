<?php include('partials/painterClient.php'); ?>

<!-- painting search section starts here -->
<section class="painting-search">
        <form action="<?php echo HOMEURL ?>painter/painting-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Your Paintings..." required>
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
</section>
<!-- painting search section ends here -->

<!--painter paintings-->
<section class="painter-paintings">
    <h2 class="sub-title">My Paintings</h2>

    <!--session variable-->
    <div class="text-center">
    <?php
        //message shown when add painting
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        //message shown when delete painting
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        //message shown when update painting
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>
    </div>
    <!--session variable-->

    <!--add painting button-->
    <div class="painter-add-painting-button">
        <a href="add-painting.php?painter_name=<?php echo $_SESSION['user'] ?>" class="btn">Add Painting</a>
    </div>
    <!--add painting button-->

    <!--display paintings-->
    <div class="painting-list">

        <?php
            $user = $_SESSION['user'];
            //query to select all painter painting
            $sql = "SELECT * FROM table_painting WHERE painter_name='$user' AND purchase_status='available'";
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

                        <div class="painting-box">
                            <div class="painting-image">
                                <img src="<?php echo HOMEURL; ?>/images/paintings/<?php echo $painting_image?>" class="img-responsive img-curve">
                            </div>
                            <div class="painting-info">
                                <h4><?php echo $painting_name ?></h4>
                                <p>By: <?php echo $painter_name?></p>
                                <p>Description: <?php echo $description ?></p>
                                <p>Price: RM<?php echo $price ?></p>
                                <p>Status: <?php echo $painting_status ?></p>
                                <br>
                                <a href="<?php echo HOMEURL; ?>painter/painterItemPage.php?id=<?php echo $id ?>" class="btn">view Painting</a>
                                <a href="<?php echo HOMEURL; ?>painter/delete-painting.php?id=<?php echo $id; ?>&painting_image=<?php echo $painting_image; ?>" class="btn">Delete Painting</a>
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

<?php include('partials/painterFooter.php'); ?>