<?php include('partials/client.php'); ?>
        
    <section class="login">
        <div class="banner"></div>
        <h4 class="sub-title">Painter Login</h4>

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

        <!-- Login form start -->
        <form action="" method="POST" class="painter-login-content">
            Painter Name:
            <br>
            <input type="text" name="painter_name" placeholder="enter painter name" required>
            <br><br>
            Password:
            <br>
            <input type="password" name="password" placeholder="enter password" required>
            <br><br>
            <input type="submit" name="submit" value="login" class="btn">
            <br>
            <br>
            <a href="<?php echo HOMEURL ?>painterRegister.php" class="btn">Register as painter</a>
        </form>
        <!-- Login form end -->
    </section>

<?php 

    //button listener
    if(isset($_POST['submit']))
    {
        //get data from form
        $username = mysqli_real_escape_string($conn, $_POST['painter_name']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // hash password using md5

        //check if username and password exist
        $sql = "SELECT * FROM table_painter WHERE painter_name='$username' AND password='$password'";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check if there is a match
        if(mysqli_num_rows($res) == 1)
        {
            //get row to check status
            $row = mysqli_fetch_assoc($res);
            $status = $row['painter_status'];

            if($status == 'approved')
            {
                //user available, login successful
                $_SESSION['login'] = "<div class='success'>Login successful.</div>";
                $_SESSION['user'] = $username; // store user session

                //redirect to home page
                header('location:'.HOMEURL.'painter/painterIndex.php');
            }
            else if($status == 'pending')
            {
                //painter status is pending, redirect back to login page with a message
                $_SESSION['login'] = "<div class='error text-center'>Your painter registration is still PENDING approval.</div>";
                header('location:'.HOMEURL.'painterLogin.php');
            }
            else if($status == 'rejected')
            {
                //painter status is pending, redirect back to login page with a message
                $_SESSION['login'] = "<div class='error text-center'>Your painter registration has been REJECTED.</div>";
                header('location:'.HOMEURL.'painterLogin.php');
            }
        }
        else
        {
            //user unavailable
            $_SESSION['login'] = "<div class='error text-center'>Painter name or password did NOT match.</div>";
            //redirect to login page
            header('location:'.HOMEURL.'painterLogin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>