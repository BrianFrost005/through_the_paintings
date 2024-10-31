<?php include('partials/client.php'); ?>

<section class="login">
    <div class="banner"></div>
    <h2 class="sub-title">Login</h2>

    <div class="session-message">
        <!-- session variable -->
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
            //message shown when register painter
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
    </div>

    <!--login form-->
    <form action="" method="POST" class="login-form">
        Username:
        <br>
        <input type="text" name="user_name" placeholder="enter username">
        <br><br>
        Password:
        <br>
        <input type="password" name="password" placeholder="enter password">
        <br><br>
        <input type="submit" name="submit" value="login" class="btn">
        <br><br>
        <a href="<?php echo HOMEURL?>userSignup.php" class="btn signup-btn">Sign up</a>
    </form>
    <!--login form-->
    <div class="clearfix">
</section>

<?php 

    //button listener
    if(isset($_POST['submit']))
    {
        //get data from form
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // hash password using md5

        //check if username and password exist
        $sql = "SELECT * FROM table_user WHERE user_name='$username' AND password='$password'";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check if there is a match
        if(mysqli_num_rows($res) == 1)
        {
            //user available, login successful
            $_SESSION['login'] = "<div class='success'>Login successful.</div>";
            $_SESSION['user'] = $username; // store user session

            //redirect to home page
            header('location:'.HOMEURL.'index.php');
        }
        else
        {
            //user unavailable
            $_SESSION['login'] = "<div class='error text-center'>Username or password did NOT match.</div>";
            //redirect to login page
            header('location:'.HOMEURL.'userLogin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>