<?php 
    include('../config/constants.php');
    include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painters Home Page</title>

    <link rel="stylesheet" href="../css/painter.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="navbar-profile-image">
            <?php
            // Get the logged-in painter's name from the session
            $painter_name = $_SESSION['user'];

            // Query to fetch the profile image of the logged-in painter
            $sql = "SELECT profile_image FROM table_painter WHERE painter_name='$painter_name'";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if the query returns a result
            if($res == TRUE && mysqli_num_rows($res) == 1)
            {
                // Fetch the row
                $row = mysqli_fetch_assoc($res);

                // Get the profile image
                $profile_image = $row['profile_image'];
            }
            else
            {
                // Default profile image if no image is found in the DB
                $profile_image = "default-profile.png"; 
            }
            ?>

            <img src="<?php echo HOMEURL; ?>/images/painter/<?php echo $profile_image; ?>" class="img-responsive img-curve">
        </div>
        
        <div class="navbar-username">Logged in as painter: <?php echo $_SESSION['user']; ?></div>
        <div class="navbar-options">   
            <ul>
                <li>
                    <a href="<?php echo HOMEURL ?>painter/painterIndex.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>painter/painterPaintings.php">My Paintings</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>painter/painterHistory.php">History</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>painter/logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->