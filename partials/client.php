<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Through the Paintings</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
    <div class="navbar-profile-image">
        <?php
        // Check if the user is logged in by verifying if the session variable is set
        if(isset($_SESSION['user']))
        {
            // Get the logged-in painter's name from the session
            $user_name = $_SESSION['user'];

            // Query to fetch the profile image of the logged-in painter
            $sql = "SELECT user_image FROM table_user WHERE user_name='$user_name'";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if the query returns a result
            if($res == TRUE && mysqli_num_rows($res) == 1)
            {
                // Fetch the row
                $row = mysqli_fetch_assoc($res);

                // Get the profile image
                $user_image = $row['user_image'];
            }
            else
            {
                // Default profile image if no image is found in the DB
                $user_image = HOMEURL."images/painter/default-profile.png"; 
            }
            
            // Display the profile image and painter's name
            echo "<img src='".HOMEURL."images/user/$user_image' class='img-responsive img-curve'>";
            echo "<p class='navbar-username'>Welcome, $user_name!</p>";
        }
        else
        {
            // Display "Not logged in" if the user is not logged in
            echo "<p class='navbar-username'>Not logged in</p>";
        }
        ?>
        </div>

        <div class="navbar-options">   
            <ul>
                <li>
                    <a href="<?php echo HOMEURL ?>index.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>painter.php">Painters</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>paintings.php">Paintings</a>
                </li>
                <?php if(!isset($_SESSION['user'])): ?>
                    <!-- Show if user is not logged in -->
                    <li>
                        <a href="<?php echo HOMEURL ?>painterLogin.php">Sell Paintings</a>
                    </li>
                    <li>
                        <a href="<?php echo HOMEURL ?>userLogin.php">Login</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo HOMEURL ?>user_cart.php">My cart</a>
                    </li>
                    <!-- Show if user is logged in -->
                    <li>
                        <a href="<?php echo HOMEURL ?>purchaseHistory.php">Purchase history</a>
                    </li>
                    <li>
                        <a href="<?php echo HOMEURL ?>logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
