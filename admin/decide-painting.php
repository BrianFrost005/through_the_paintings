<?php

    //include constants for sql connection
    include('../config/constants.php');

    //get details
    $id = $_GET['id'];
    //prevent injection mysqli_real_escape_string
    $painting_status = $_GET['painting_status'];

    //insert to database
    //create query
    $sql3 = "UPDATE table_painting SET
        painting_status = '$painting_status'
        WHERE id=$id
    ";

    //execute query
    $res3 = mysqli_query($conn, $sql3);

    //check execution
    if($res3==TRUE)
    {
        if($painting_status=='approved')
        {
            //success
            $_SESSION['update'] = "<div class='success'>Painting APPROVED successfully.</div>";
            //redirect
            header('location:'.HOMEURL.'admin/adminApprovePaintings.php');   
        }
        if($painting_status=='rejected')
        {
            //success
            $_SESSION['update'] = "<div class='success'>Painting REJECTED successfully.</div>";
            //redirect
            header('location:'.HOMEURL.'admin/adminApprovePaintings.php');   
        }
    }
    else
    {
        //failed
        $_SESSION['update'] = "<div class='error'>Failed to decide painting.</div>";
        //redirect
        header('location:'.HOMEURL.'admin/adminPaarovePaintings.php');
    }

?>
