<?php include('partials/client.php'); ?>

<!--login form-->
<section class="login">
    <div class="banner"></div>
    <h2 class="sub-title">Sign Up</h2>

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

    <form action="" method="POST" class="signup-form" enctype="multipart/form-data">
        Username
        <br>
        <input type="text" name="username" placeholder="enter username" required>
        <br><br>
        Password
        <br>
        <input type="password" name="password" placeholder="enter password" required>
        <br><br><br>
        Select profile image
        <br>
        <input type="file" name="profile_image" required>
        <br><br><br>
        <input type="submit" name="submit" value="Sign Up" class="btn">

        <?php
        
            //button listener
            if(isset($_POST['submit']))
            {
                //get values
                //prevent injection mysqli_real_escape_string()
                $user_name = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));

                //check if username already exists
                $check_sql = "SELECT * FROM table_user WHERE user_name='$user_name'";
                $check_res = mysqli_query($conn, $check_sql);

                if(mysqli_num_rows($check_res) > 0)
                {
                    //painter name exists, show error message
                    $_SESSION['add'] = "<div class='error'>User already exists. Please choose a different name.</div>";
                    //redirect back to the registration page
                    header('location:'.HOMEURL.'userSignup.php');
                    //stop the process
                    die();
                }

                //image details
                //prevent injection mysqli_real_escape_string
                $profile_image = mysqli_real_escape_string($conn, $_FILES['profile_image']['name']);

                //check if image is selected
                if($profile_image != "")
                {
                    //rename image
                    $ext = pathinfo($profile_image, PATHINFO_EXTENSION);

                    //give new name to paintings, random number
                    $profile_image = "User-Name-".$user_name."-".rand(0000,9999).".".$ext;

                    //upload path
                    $src = $_FILES['profile_image']['tmp_name'];

                    //destination path
                    $dst = "images/user/".$profile_image;

                    //upload form src to dst
                    $upload = move_uploaded_file($src, $dst);

                    //check upload
                    if($upload==false)
                    {
                        //failed
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        //redirect
                        header('location:'.HOMEURL.'userSignup.php');
                        //stop process
                        die();
                    }
                }

                //insert to database
                //create query
                $sql2 = "INSERT INTO table_user SET
                    user_name = '$user_name',
                    password = '$password',
                    user_image = '$profile_image'
                ";

                //execute query
                $res = mysqli_query($conn, $sql2);

                //check execution
                if($res==TRUE)
                {
                    //insert success
                    $_SESSION['add'] = "<div class='success'>User created successfully!</div>";
                    //redirect
                    header('location:'.HOMEURL.'userLogin.php');
                }
                else
                {
                    //insert failed
                    $_SESSION['add'] = "<div class='error'>Failed to created user.</div>";
                    //redirect
                    header('location:'.HOMEURL.'userLogin.php');
                }
            }

        ?>

    </form>
    <div class="clearfix">
</section>
<!--login form-->

<?php include('partials/footer.php'); ?>