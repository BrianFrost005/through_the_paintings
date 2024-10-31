<?php include('partials/painterClient.php'); ?>

<!--add painting content-->
<section class="add-painting">
    <div class="banner"></div>
    <h2 class="sub-title">Add Painting</h2>
    <br>

    <!-- session variable -->
    <div class="text-center">
    <!-- message shown when admin add failed -->
    <?php 
        //message shown when upload failed
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
    </div>
    <!-- session variable -->
    <div class="add-painting-form">
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="painting_name" placeholder="Painting name" required>
                    </td>
                </tr>

                <tr>
                    <td>Painter: </td>
                    <td>
                        <p name="painter_name"><?php echo $_GET['painter_name'] ?></p>
                        <input type="hidden" name="painter_name" value="<?php echo $_SESSION['user']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Painting description."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>

                <tr>
                    <td colspn="2">
                        <input type="submit" name="submit" value="Request to sell painting" class="btn" required>
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            //button listener
            if(isset($_POST['submit']))
            {
                //add painting to database
                //get values
                //prevent injection mysqli_real_escape_string()
                $painting_name = mysqli_real_escape_string($conn, $_POST['painting_name']);
                $painter_name = mysqli_real_escape_string($conn, $_POST['painter_name']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);

                //upload image if selected
                //check if select image is clicked
                if(isset($_FILES['image']['name']))
                {
                    //image details
                    //prevent injection mysqli_real_escape_string
                    $image_name = mysqli_real_escape_string($conn, $_FILES['image']['name']);

                    //check if image is selected
                    if($image_name != "")
                    {
                        //image selected
                        //rename image
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION); //get extension .png

                        //rename
                        $image_name = "Painting-Name-".rand(0000,9999).".".$ext; // "Painting-Name-3577.png"

                        //upload
                        //get source path
                        $src = $_FILES['image']['tmp_name'];

                        //destination path
                        $dst = "../images/paintings/".$image_name;

                        //upload
                        $upload = move_uploaded_file($src, $dst);

                        //check upload
                        if($upload==false)
                        {
                            //failed
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            //redirect
                            header('location:'.HOMEURL.'painter/painterPaintings.php');
                            //stop process
                            die();
                        }
                    }
                }
                else
                {
                    //default value
                    $image_name = "";
                }

                //insert to database
                //create query
                $sql2 = "INSERT INTO table_painting SET
                    painting_name = '$painting_name',
                    painter_name = '$painter_name',
                    description = '$description',
                    price = $price,
                    painting_image = '$image_name',
                    painting_status = 'pending',
                    purchase_status = 'available'
                ";

                //execute query
                $res = mysqli_query($conn, $sql2);

                //check execution
                if($res==TRUE)
                {
                    //insert success
                    $_SESSION['add'] = "<div class='success'>Request sent successfully.</div>";
                    //redirect
                    header('location:'.HOMEURL.'painter/painterPaintings.php');
                }
                else
                {
                    //insert failed
                    $_SESSION['add'] = "<div class='error'>Failed to sent painting request.</div>";
                    //redirect
                    header('location:'.HOMEURL.'painter/painterPaintings.php');
                }
            }

        ?>

    </div>
    <div class="clearfix"></div>
</section>
<!--add painting content-->

<?php include('partials/painterFooter.php'); ?>