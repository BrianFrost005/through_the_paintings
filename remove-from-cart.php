<?php
// Include the database connection and start session
include('config/constants.php');
session_start();

// Check if the painting ID is set in the URL
if(isset($_GET['id']) && isset($_SESSION['user'])) {
    // Get the painting ID and user name from the session
    $painting_id = $_GET['id'];
    $user_name = $_SESSION['user'];

    // SQL query to delete the painting from the cart for the specific user
    $sql = "DELETE FROM table_cart WHERE painting_id = '$painting_id' AND user_name = '$user_name'";
    
    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query was successful
    if($res == TRUE) {
        // Set a success message
        $_SESSION['cart-message'] = "Item removed from cart successfully.";
    } else {
        // Set an error message if the removal failed
        $_SESSION['cart-message'] = "Failed to remove item from cart. Please try again.";
    }
} else {
    // Set an error message if the user is not logged in or painting ID is not provided
    $_SESSION['cart-message'] = "Invalid action. Please log in.";
}

// Redirect back to the cart page
header("Location: ".HOMEURL."user_cart.php");
exit;
