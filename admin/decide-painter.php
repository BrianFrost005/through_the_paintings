<?php

    //include constants for sql connection
    include('../config/constants.php');

    //get details
    $id = $_GET['id'];
    //prevent injection mysqli_real_escape_string
    $painter_status = $_GET['painter_status'];

    if($painter_status=='approved')
    {
        //create query
        $sql3 = "UPDATE table_painter 
        SET painter_status = '$painter_status'
        WHERE id=$id
        ";
        //execute query
        $res3 = mysqli_query($conn, $sql3);
    }
    if($painter_status=='rejected')
    {
        //create query
        $sql3 = "UPDATE table_painter 
        SET painter_status = '$painter_status'
        WHERE id=$id
        ";
        //execute query
        $res3 = mysqli_query($conn, $sql3);
    }
    else if($painter_status=='delete')
    {
        //create sql query
        $sql = "DELETE FROM table_painter WHERE id=$id";
        //execute query
        $res = mysqli_query($conn, $sql);
    }

    //check execution
    if($res3==TRUE)
    {
        if($painter_status=='approved')
        {
            //success
            $_SESSION['update'] = "<div class='success'>Painter APPROVED successfully.</div>";
            //redirect
            header('location:'.HOMEURL.'admin/adminApprovePainters.php');   
        }
        else if($painter_status=='rejected')
        {   
            //success
            $_SESSION['update'] = "<div class='success'>Painter REJECTED successfully.</div>";
            //redirect
            header('location:'.HOMEURL.'admin/adminApprovePainters.php');   
        }
        else if($painter_status=='delete')
        {   
            //success
            $_SESSION['update'] = "<div class='success'>Painter DELETED successfully.</div>";
            //redirect
            header('location:'.HOMEURL.'admin/adminApprovePainters.php');   
        }
    }
    else
    {
        //failed
        $_SESSION['update'] = "<div class='error'>Failed to decide painter.</div>";
        //redirect
        header('location:'.HOMEURL.'admin/adminApprovePainters.php');
    }

?>
