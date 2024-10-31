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
    <title>Admin Page</title>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="navbar-username">Logged in as admin: <?php echo $_SESSION['user']; ?></div>
        <div class="navbar-options">   
            <ul>
                <li>
                    <a href="<?php echo HOMEURL ?>admin/adminIndex.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>admin/adminManageAdmins.php">Manage Admins</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>admin/adminPainters.php">Painters</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>admin/adminApprovePainters.php">Approve Painters</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>admin/adminApprovePaintings.php">Approve Paintings</a>
                </li>
                <li>
                    <a href="<?php echo HOMEURL ?>admin/logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->