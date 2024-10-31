<?php 
include('partials/painterClient.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $painting_id = $_POST['painting_id'];
    $journey_title = mysqli_real_escape_string($conn, $_POST['title']);
    $journey_comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Handle image upload
    if (isset($_FILES['journey_image']['name'])) {
        // Image details
        $image_name = $_FILES['journey_image']['name'];
        $tmp_name = $_FILES['journey_image']['tmp_name'];
        $upload_dir = "../images/journey/";

        // Generate a unique file name and save image
        $image_name = time() . "_" . basename($image_name);
        $image_path = $upload_dir . $image_name;
        move_uploaded_file($tmp_name, $image_path);
    } else {
        // Set default image if no image is uploaded
        $image_name = "default-journey.jpg";
    }

    // Insert journey entry into the database
    $sql = "INSERT INTO table_journey (painting_id, journey_image, journey_title, journey_comment) 
            VALUES ('$painting_id', '$image_name', '$journey_title', '$journey_comment')";
    $res = mysqli_query($conn, $sql);

    // Redirect back to the painting's journey page with a message
    if ($res) {
        $_SESSION['journey_message'] = "Journey entry added successfully!";
    } else {
        $_SESSION['journey_message'] = "Failed to add journey entry. Please try again.";
    }
    header("Location: " . HOMEURL . "painter/paintingJourneyPage.php?id=$painting_id");
    exit();
} else {
    // If accessed directly, redirect to home
    header("Location: " . HOMEURL);
    exit();
}
