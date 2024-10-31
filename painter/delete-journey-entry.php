<?php
include('partials/painterClient.php');

// Check if ID and painting_id are passed
if (isset($_GET['id']) && isset($_GET['painting_id'])) {
    $journey_id = $_GET['id'];
    $painting_id = $_GET['painting_id'];

    // Retrieve the journey image filename from the database
    $sql_get_image = "SELECT journey_image FROM table_journey WHERE id = '$journey_id'";
    $res_get_image = mysqli_query($conn, $sql_get_image);

    if ($res_get_image && mysqli_num_rows($res_get_image) > 0) {
        $row = mysqli_fetch_assoc($res_get_image);
        $journey_image = $row['journey_image'];

        // Delete the image file from the folder
        $image_path = "../images/journey/" . $journey_image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Query to delete the entry from the database
    $sql_delete = "DELETE FROM table_journey WHERE id = '$journey_id'";
    $res_delete = mysqli_query($conn, $sql_delete);

    if ($res_delete == TRUE) {
        // Success message
        $_SESSION['delete'] = "<div class='success'>Journey entry deleted successfully.</div>";
    } else {
        // Failure message
        $_SESSION['delete'] = "<div class='error'>Failed to delete journey entry. Please try again.</div>";
    }
    
    // Redirect to the painting journey page
    header("Location: " . HOMEURL . "painter/paintingJourneyPage.php?id=" . $painting_id);
} else {
    // Redirect back with an error if ID not provided
    $_SESSION['delete'] = "<div class='error'>Unauthorized action.</div>";
    header("Location: " . HOMEURL . "painter/paintingJourneyPage.php");
}
?>
