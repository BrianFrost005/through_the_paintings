<?php 
// Include necessary files
include('partials/client.php'); 

// Check if the user is logged in
if(!isset($_SESSION['user'])) {
    // If not logged in, set a session message and redirect to the item page
    $_SESSION['login_message'] = "Please log in to add items to your cart.";
    header("Location: " . HOMEURL . "paintingItemPage.php?id=" . $_GET['id']);
    exit();
}

// Get the logged-in username and the painting ID from the URL or POST request
$user_name = $_SESSION['user'];
$painting_id = isset($_GET['id']) ? $_GET['id'] : null;

// If painting ID is not provided, redirect back to the painting page
if(!$painting_id) {
    header("Location: " . HOMEURL . "paintings.php");
    exit();
}

// SQL query to insert the item into the cart
$sql = "INSERT INTO table_cart (user_name, painting_id) VALUES ('$user_name', '$painting_id')";

// Execute the query
$res = mysqli_query($conn, $sql);

// Check if the insertion was successful
if($res == true) {
    $_SESSION['cart_message'] = "Item added to cart successfully!";
    header("Location: " . HOMEURL . "paintingItemPage.php?id=" . $painting_id);
} else {
    // If there was an error, redirect to an error page or show a message
    $_SESSION['cart_message'] = "Failed to add item to cart. Please try again.";
    header("Location: " . HOMEURL . "paintingItemPage.php?id=" . $painting_id);
}
exit();
?>
