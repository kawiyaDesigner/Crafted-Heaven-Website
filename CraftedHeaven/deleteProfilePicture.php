<?php
session_start();
include 'dbconn.php';  // Make sure to include the database connection

if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Fetch the current profile image path from the database
    $selectQuery = "SELECT image FROM userdetails WHERE id='$userId'";
    $result = mysqli_query($conn, $selectQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        $currentImage = $row['image'];

        // Delete the image file from the server
        if (file_exists($currentImage)) {
            unlink($currentImage);
        }

        // Update the database to remove the profile image
        $updateQuery = "UPDATE userdetails SET image=NULL WHERE id='$userId'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "success"; // Successfully deleted the profile picture
        } else {
            echo "error";
        }
    } else {
        echo "user_not_found";
    }
}
?>
