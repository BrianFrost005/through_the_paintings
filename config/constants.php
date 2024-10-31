<?php
    //start session
    session_start();

    //define constants
    define('HOMEURL', 'http://localhost/through-the-paintings/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'through_the_paintings');

    //execute query and save data into database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //sql connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //select database

    //this constants is added in partials/menu.php for easy apply all pages
?>