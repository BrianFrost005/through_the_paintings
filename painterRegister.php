<?php include('partials/client.php'); ?>

<!--sigup form-->
<section class="login">
    <div class="banner"></div>
    <h2 class="sub-title">Painter Sign Up</h2>

    <!--session variable-->
    <div class="text-center">
    <?php 
        //message shown when upload failed
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>
    </div>
    <!--session variable-->

    <form action="" method="POST" class="painter-register-form" enctype="multipart/form-data">
        Painter Name
        <br>
        <input type="text" name="painter_name" placeholder="enter painter name" required>
        <br><br>
        Password
        <br>
        <input type="password" name="password" placeholder="enter password" required>
        <br><br><br>
        Select painter profile image
        <br>
        <input type="file" name="profile_image" required>
        <br><br><br>
        Submit 3 paintings as part of registration application
        <br>
        <input type="file" name="image1" required>
        <input type="file" name="image2" required>
        <input type="file" name="image3" required>
        <br><br>
        <input type="submit" name="submit" value="Register as Painter" class="btn">
    
        <?php
        
            //button listener
            if(isset($_POST['submit']))
            {
                //add painting to database
                //get values
                //prevent injection mysqli_real_escape_string()
                $painter_name = mysqli_real_escape_string($conn, $_POST['painter_name']);
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));

                //check if the painter name already exists
                $check_sql = "SELECT * FROM table_painter WHERE painter_name='$painter_name'";
                $check_res = mysqli_query($conn, $check_sql);

                if(mysqli_num_rows($check_res) > 0)
                {
                    //painter name exists, show error message
                    $_SESSION['add'] = "<div class='error'>Painter name already exists. Please choose a different name.</div>";
                    //redirect back to the registration page
                    header('location:'.HOMEURL.'painterRegister.php');
                    //stop the process
                    die();
                }

                //image details
                //prevent injection mysqli_real_escape_string
                $profile_image = mysqli_real_escape_string($conn, $_FILES['profile_image']['name']);
                $image_name1 = mysqli_real_escape_string($conn, $_FILES['image1']['name']);
                $image_name2 = mysqli_real_escape_string($conn, $_FILES['image2']['name']);
                $image_name3 = mysqli_real_escape_string($conn, $_FILES['image3']['name']);

                //check if image is selected
                if($profile_image != "" && $image_name1 != "" && $image_name2 != "" && $image_name3 != "")
                {
                    //rename image
                    $ext = pathinfo($profile_image, PATHINFO_EXTENSION);
                    $ext1 = pathinfo($image_name1, PATHINFO_EXTENSION); //get extension .png
                    $ext2 = pathinfo($image_name2, PATHINFO_EXTENSION);
                    $ext3 = pathinfo($image_name3, PATHINFO_EXTENSION);

                    //give new name to paintings, random number
                    $profile_image = "Painter-Name-".rand(0000,9999).".".$ext;
                    $image_name1 = "Painting-Name-".rand(0000,9999)."-".$painter_name.".".$ext1;
                    $image_name2 = "Painting-Name-".rand(0000,9999)."-".$painter_name.".".$ext2;
                    $image_name3 = "Painting-Name-".rand(0000,9999)."-".$painter_name.".".$ext3;

                    //upload path
                    $src = $_FILES['profile_image']['tmp_name'];
                    $src1 = $_FILES['image1']['tmp_name'];
                    $src2 = $_FILES['image2']['tmp_name'];
                    $src3 = $_FILES['image3']['tmp_name'];

                    //destination path
                    $dst = "images/painter/".$profile_image;
                    $dst1 = "images/application-paintings/".$image_name1;
                    $dst2 = "images/application-paintings/".$image_name2;
                    $dst3 = "images/application-paintings/".$image_name3;

                    //upload form src to dst
                    $upload = move_uploaded_file($src, $dst);
                    $upload1 = move_uploaded_file($src1, $dst1);
                    $upload2 = move_uploaded_file($src2, $dst2);
                    $upload3 = move_uploaded_file($src3, $dst3);

                    //check upload
                    if($upload==false || $upload1==false || $upload2==false || $upload3==false)
                    {
                        //failed
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        //redirect
                        header('location:'.HOMEURL.'painterRegister.php');
                        //stop process
                        die();
                    }
                }

                //insert to database
                //create query
                $sql2 = "INSERT INTO table_painter SET
                    painter_name = '$painter_name',
                    password = '$password',
                    profile_image = '$profile_image',
                    painting_name1 = '$image_name1',
                    painting_name2 = '$image_name2',
                    painting_name3 = '$image_name3',
                    painter_status = 'pending'
                ";

                //execute query
                $res = mysqli_query($conn, $sql2);

                //check execution
                if($res==TRUE)
                {
                    //insert success
                    $_SESSION['add'] = "<div class='success'>Registration request sent successfully!</div>";
                    //redirect
                    header('location:'.HOMEURL.'painterLogin.php');
                }
                else
                {
                    //insert failed
                    $_SESSION['add'] = "<div class='error'>Failed to send registration request.</div>";
                    //redirect
                    header('location:'.HOMEURL.'painterLogin.php');
                }
            }

        ?>

    </form>

    <div class="clearfix">
</section>
<!--signup form-->

<?php include('partials/footer.php'); ?>