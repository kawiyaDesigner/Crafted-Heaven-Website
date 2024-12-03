<?php
include("dbconn.php");
session_start();

// Check if product_id is sent
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (isset($_SESSION['user']['id'])) {
        $userId = $_SESSION['user']['id'];
    } else {
        echo json_encode(['success' => false, 'message' => 'User is not logged in']);
        exit();
    }

    // Insert into cart table
    $query = "INSERT INTO cart (productid, userid) VALUES ('$productId', '$userId')";

    if (mysqli_query($conn, $query)) {
        echo "Product added to cart!";
        header("Location: product.php"); // Redirect back to products page
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "No product ID provided!";
}
?>
