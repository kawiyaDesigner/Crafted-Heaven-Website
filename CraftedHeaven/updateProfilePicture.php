<?php
session_start();
include 'dbconn.php';  // Make sure to include the database connection

// Check if an image was uploaded
if (isset($_FILES['profile-image']) && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $image = $_FILES['profile-image'];

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowedTypes)) {
        // Move the uploaded file to a specific folder
        $targetDir = "uploads/profile_pics/";
        $targetFile = $targetDir . basename($image['name']);
        
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Update the database with the new image path
            $updateQuery = "UPDATE userdetails SET image='$targetFile' WHERE id='$userId'";
            if (mysqli_query($conn, $updateQuery)) {
                echo "success"; // Successfully updated the profile picture
            } else {
                echo "error";
            }
        } else {
            echo "error"; // Failed to upload the file
        }
    } else {
        echo "invalid_file_type"; // Invalid file type
    }
} else {
    echo "no_file"; // No file uploaded
}
?>
