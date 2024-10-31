<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <section class="login">
            <div class="banner"></div>
            <h4 class="sub-title">Login</h4>

            <!-- session variable -->
            <div class="text-center">
            <?php 
                //message shown when login success 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                //message shown when not logged in
                if(isset($_SESSION['not-logged-in']))
                {
                    echo $_SESSION['not-logged-in'];
                    unset($_SESSION['not-logged-in']);
                }
            ?>
            </div>

            <!-- Login form start -->
            <form action="" method="POST" class="login-content">
                Username:
                <br>
                <input type="text" name="username" placeholder="enter username" required>
                <br><br>
                Password:
                <br>
                <input type="password" name="password" placeholder="enter password" required>
                <br><br>
                <input type="submit" name="submit" value="login" class="btn">
            </form>
            <!-- Login form end -->
        </section>

    </body>
</html>

<?php 

    //button listener
    if(isset($_POST['submit']))
    {
        //get data from form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // hash password using md5

        //check if username and password exist
        $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password'";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check if there is a match
        if(mysqli_num_rows($res) == 1)
        {
            //user available, login successful
            $_SESSION['login'] = "<div class='success'>Login successful.</div>";
            $_SESSION['user'] = $username; // store user session

            //redirect to home page
            header('location:'.HOMEURL.'admin/adminIndex.php');
        }
        else
        {
            //user unavailable
            $_SESSION['login'] = "<div class='error text-center'>Username or password did NOT match.</div>";
            //redirect to login page
            header('location:'.HOMEURL.'admin/login.php');
        }
    }

?>

<?php include('partials/adminFooter.php'); ?>