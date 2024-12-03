<?php
include("dbconn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the offer details from the form
    $offerPrice = $_POST['offer_price'];
    $requestId = $_POST['request_id']; // Get the specific request ID

    // Sanitize input to prevent SQL injection
    $offerPrice = $conn->real_escape_string($offerPrice);
    $requestId = $conn->real_escape_string($requestId);

    // Fetch the user_id associated with the request ID
    $sql = "SELECT userid FROM requests WHERE id = '$requestId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Get the user_id
        $row = $result->fetch_assoc();
        $userId = $row['userid'];

        // Insert the offer with the seller and user information
        $sellerId = $_SESSION['seller']['id']; // Get the logged-in seller ID
        $sqlInsertOffer = "INSERT INTO offers (sellerid, userid, price, requestid) 
                           VALUES ('$sellerId', '$userId', '$offerPrice', '$requestId')";

        if ($conn->query($sqlInsertOffer) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Offer sent successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Request not found']);
    }
}

$conn->close();
exit();
?>
