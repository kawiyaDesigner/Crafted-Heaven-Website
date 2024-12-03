<?php
include("dbconn.php");
session_start();

// Verify if the user is logged in
if (!isset($_SESSION['user']['id'])) {
    echo json_encode(['success' => false, 'message' => 'User is not logged in']);
    exit();
}

// Get the logged-in user ID from the session
$userId = $_SESSION['user']['id'];

// Read the JSON input from the client
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input data
if (!isset($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid or missing draft ID']);
    exit();
}

// Sanitize the inputs to prevent SQL injection
$draftId = $conn->real_escape_string($data['id']);

// Check if the draft exists and belongs to the user
$draftCheckQuery = "SELECT * FROM drafts WHERE id = '$draftId' AND userid = '$userId'";
$draftCheckResult = $conn->query($draftCheckQuery);

if ($draftCheckResult->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Draft not found or does not belong to the user']);
    exit();
}

// Fetch draft details (leg, mat, sitting, frame, pillow)
$draftDetails = $draftCheckResult->fetch_assoc();
$leg = $draftDetails['leg'];
$mat = $draftDetails['mat'];
$sitting = $draftDetails['sitting'];
$frame = $draftDetails['frame'];
$pillow = $draftDetails['pillow'];

// Insert the new request into the 'requests' table
$insertRequestQuery = "
    INSERT INTO requests (design_id, userid, leg, mat, sitting, frame, pillow)
    VALUES ('$draftId', '$userId', '$leg', '$mat', '$sitting', '$frame', '$pillow')
";

if ($conn->query($insertRequestQuery)) {
    echo json_encode(['success' => true, 'message' => 'Request successfully saved']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}

// Close the database connection
$conn->close();
?>
