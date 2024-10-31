<?php include('partials/client.php'); ?>

<!--item content-->
<section class="item-content">
    <div class="banner"></div>

    <!--session variable-->
    <div class="text-center">
        <?php
            if(isset($_SESSION['login_message'])) {
            echo "<div class='message error'>" . $_SESSION['login_message'] . "</div>";
            unset($_SESSION['login_message']);
            }

            if(isset($_SESSION['cart_message'])) {
                echo "<div class='message success'>" . $_SESSION['cart_message'] . "</div>";
                unset($_SESSION['cart_message']);
            }
        ?>
    </div>
    <!--session variable-->

    <!--item details-->
    <div class="item-box">

        <?php
            //get id
            $id = $_GET['id'];

            //query to select all painter painting
            $sql = "SELECT * FROM table_painting WHERE id=$id";
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
                        $purchase_status = $rows['purchase_status'];

                        //display rows
                        ?>

                        <div class="item-image">
                            <img src="<?php echo HOMEURL; ?>/images/paintings/<?php echo $painting_image?>" class="img-responsive img-curve">
                        </div>
                        <div class="item-info">
                            <h4><?php echo $painting_name ?></h4>
                            <p>By: <?php echo $painter_name?></p>
                            <p>Description: <?php echo $description ?></p>
                            <p>Price: RM<?php echo $price ?></p>
                            <div class="item-painting-journey-section">
                                <a href="<?php echo HOMEURL; ?>paintingJourneyPage.php?id=<?php echo $id ?>" class="item-painting-journey-btn">
                                    <h4 class="text-center">Painting's Journey</h4>
                                </a>
                            </div>
                            <?php if ($purchase_status == 'available'): ?>
                                <a href="<?php echo HOMEURL; ?>add-to-cart.php?id=<?php echo $id; ?>" class="btn">Add to cart</a>
                            <?php else: ?>
                                <h4>Painting sold!</h4>
                            <?php endif; ?>
                            <br>
                            <a href="<?php echo HOMEURL; ?>paintings.php" class="btn">Back</a>
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
    <!--item contents-->
    <div class="clearfix"></div>
</section>
<!--item display item info-->

<?php include('partials/footer.php'); ?>