<?php
    //include constants for sql connection
    include('../config/constants.php');

    //get id and painting_image
    $id = $_GET['id'];
    $painting_image = $_GET['painting_image'];
    
    //remove image from folder if available
    if($image_name != "")
    {
        //remove
        //get path
        $path = "../images/paintings/".$image_name;

        //remove image from folder
        $remove = unlink($path);

        //check removal
        if($remove==false)
        {
            //remove failed
            $_SESSION['upload'] = "<div class='error'>Failed to remove image.</div>";
            //redirect
            header('location:'.HOMEURL.'painter/painterPaintings.php');
            //stop process
            die();
        }
    }

    //delete
    //create sql query
    $sql = "DELETE FROM table_painting WHERE id=$id";
    //execute query
    $res = mysqli_query($conn, $sql);
    //check query execution
    if($res==TRUE)
    {
        //delete success
        $_SESSION['delete'] = "<div class='success'>Painting deleted successfully</div>";
        //redirect page
        header('location:'.HOMEURL.'painter/painterPaintings.php');
    }
    else
    {
        //delete failed
        $_SESSION['delete'] = "<div class='error'>Failed to delete painting</div>";
        header('location:'.HOMEURL.'painter/painterPaintings.php');
    }

?>