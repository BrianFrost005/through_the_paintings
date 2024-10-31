<?php include('partials/adminClient.php'); ?>

<!--session variable-->
<div class="text-center">
</div>
<!--session variable-->

<?php
    // Fetch the number of admins
    $sql_admin = "SELECT COUNT(*) AS admin_count FROM table_admin";
    $res_admin = mysqli_query($conn, $sql_admin);
    $row_admin = mysqli_fetch_assoc($res_admin);
    $admin_count = $row_admin['admin_count'];

    // Fetch the number of pending painter requests
    $sql_painter = "SELECT COUNT(*) AS pending_painter_count FROM table_painter WHERE painter_status = 'pending'";
    $res_painter = mysqli_query($conn, $sql_painter);
    $row_painter = mysqli_fetch_assoc($res_painter);
    $pending_painter_count = $row_painter['pending_painter_count'];

    // Fetch the number of pending painting requests
    $sql_painting = "SELECT COUNT(*) AS pending_painting_count FROM table_painting WHERE painting_status = 'pending'";
    $res_painting = mysqli_query($conn, $sql_painting);
    $row_painting = mysqli_fetch_assoc($res_painting);
    $pending_painting_count = $row_painting['pending_painting_count'];

    // Fetch the number of approved painter requests
    $sql_painter_approved = "SELECT COUNT(*) AS approved_painter_count FROM table_painter WHERE painter_status = 'approved'";
    $res_painter_approved = mysqli_query($conn, $sql_painter_approved);
    $row_painter_approved = mysqli_fetch_assoc($res_painter_approved);
    $approved_painter_count = $row_painter_approved['approved_painter_count'];
?>

<!--dashboard-->
<section class="dashboard">
    <div class="banner"></div>
    <h2 class="sub-title">Welcome Admin</h>
    <!--display content-->
    <div class="dashboard-content">
        <!--display no of admins-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $admin_count; ?></div>
            <div class="dashboard-content-label">Admins</div>
        </div>
        <!--display no of approved painter requests-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $approved_painter_count; ?></div>
            <div class="dashboard-content-label">Approved painter</div>
        </div>
        <!--display no of pending painter requests-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $pending_painter_count; ?></div>
            <div class="dashboard-content-label">Pending painter requests</div>
        </div>
        <!--display no of pending paintings requests-->
        <div class="dashboard-content-box">
            <div class="dashboard-content-data"><?php echo $pending_painting_count; ?></div>
            <div class="dashboard-content-label">Pending painting requests</div>
        </div>
    </div>
    <!--display content-->
    <div class="clearfix"></div>
</section>
<!--dashboard-->

<?php include('partials/adminFooter.php'); ?>