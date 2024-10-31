<?php
include('partials/client.php');
include('partials/login-check.php');

if (isset($_POST['selected_paintings'])) {
    $selected_paintings = $_POST['selected_paintings'];
    $user_name = $_SESSION['user'];

    // Get the user's ID
    $user_query = "SELECT id FROM table_user WHERE user_name = '$user_name'";
    $user_res = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_res);
    $user_id = $user_row['id'];

    // Process each selected painting
    foreach ($selected_paintings as $painting_id) {
        // Update the painting's purchase status to 'sold'
        $update_query = "UPDATE table_painting SET purchase_status = 'sold' WHERE id = '$painting_id'";
        mysqli_query($conn, $update_query);

        // Insert into history table
        $history_query = "INSERT INTO table_history (user_id, painting_id) VALUES ('$user_id', '$painting_id')";
        mysqli_query($conn, $history_query);
    }

    // Redirect to cart page with a success message
    $_SESSION['checkout_success'] = "Your selected paintings have been successfully checked out!";
    header('location:' . HOMEURL . 'user_cart.php');
} else {
    echo "<div class='error'>No paintings selected for checkout.</div>";
}
?>
