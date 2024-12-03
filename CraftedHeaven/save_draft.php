<?php
include("dbconn.php");
session_start();

// Get the logged-in user ID from the session
if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    echo json_encode(['success' => false, 'message' => 'User is not logged in']);
    exit();
}

// Get the JSON data sent from the client
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Check if all required parts are provided
if (isset($data['sitting'], $data['leg'], $data['frame'], $data['mat'], $data['pillow'])) {
    // Sanitize the inputs to prevent SQL injection
    $sitting = $conn->real_escape_string($data['sitting']);
    $leg = $conn->real_escape_string($data['leg']);
    $frame = $conn->real_escape_string($data['frame']);
    $mat = $conn->real_escape_string($data['mat']);
    $pillow = $conn->real_escape_string($data['pillow']);

    // Insert the data into the 'drafts' table, including the user_id
    $sql = "INSERT INTO drafts (userid, sitting, leg, frame, mat, pillow) VALUES ('$userId', '$sitting', '$leg', '$frame', '$mat', '$pillow')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
}

// Close the database connection
$conn->close();
?>
