<?php
include("dbconn.php");
session_start();

// Check if the user is logged in
if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $draftId = $_GET['id'];

    // Prepare the DELETE query
    $sql = "DELETE FROM drafts WHERE id = '$draftId' AND userid = '$userId'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the drafts page after deletion
        header("Location: cutomizedproducts.php?message=Draft deleted successfully.");
        exit();
    } else {
        // Error occurred, redirect back with error message
        header("Location: cutomizedproducts.php?message=Error deleting draft.");
        exit();
    }
} else {
    // If no ID is provided, redirect back
    header("Location: cutomizedproducts.php");
    exit();
}
?>
