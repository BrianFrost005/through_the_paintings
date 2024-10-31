<?php include('partials/painterClient.php'); ?>

<?php 
    // Get painter's name from the session
    $painter_name = $_SESSION['user'];

    // Query to count paintings sold by the painter
    $sql_sold = "SELECT COUNT(*) AS sold_count FROM table_painting WHERE painter_name = '$painter_name' AND purchase_status = 'sold'";
    $res_sold = mysqli_query($conn, $sql_sold);
    $row_sold = mysqli_fetch_assoc($res_sold);
    $sold_count = $row_sold['sold_count'];

    // Query to count total paintings created by the painter
    $sql_created = "SELECT COUNT(*) AS created_count FROM table_painting WHERE painter_name = '$painter_name'";
    $res_created = mysqli_query($conn, $sql_created);
    $row_created = mysqli_fetch_assoc($res_created);
    $created_count = $row_created['created_count'];

    // Query to count pending paintings by the painter
    $sql_pending = "SELECT COUNT(*) AS pending_count FROM table_painting WHERE painter_name = '$painter_name' AND painting_status = 'pending'";
    $res_pending = mysqli_query($conn, $sql_pending);
    $row_pending = mysqli_fetch_assoc($res_pending);
    $pending_count = $row_pending['pending_count'];
?>

<!--session variable-->
<div class="text-center">
</div>
<!--session variable-->

<!--dashboard-->
<section class="dashboard">
    <div class="banner"></div>
    <h2 class="sub-title">Welcome Painter</h>

    <!--display content-->
    <div class="dashboard-content">
        <!--display no of paintings sold-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $sold_count; ?></div>
            <div class="dashboard-content-label">Paintings sold</div>
        </div>
        <!--display no of paintings-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $created_count; ?></div>
            <div class="dashboard-content-label">Painting Created</div>
        </div>
        <!--pending paintings-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $pending_count; ?></div>
            <div class="dashboard-content-label">Pending painting requests</div>
        </div>
    </div>
    <!--display content-->
    <div class="clearfix"></div>
</section>
<!--dashboard-->

<?php include('partials/painterFooter.php'); ?>