<?php
session_start();
include 'dbconn.php';  // Make sure to include the database connection

// Check if the form is submitted
if (isset($_POST['id']) && (isset($_POST['fname']) || isset($_POST['lname']) || isset($_POST['email']) || isset($_POST['mnumber']) || isset($_POST['password']))) {
    $userId = $_POST['id'];

    // Get the updated data from the POST request
    $fname = isset($_POST['fname']) ? $_POST['fname'] : null;
    $lname = isset($_POST['lname']) ? $_POST['lname'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $mnumber = isset($_POST['mnumber']) ? $_POST['mnumber'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Prepare the SQL query to update the user details
    $updateQuery = "UPDATE userdetails SET ";
    $updateFields = [];

    if ($fname) {
        $updateFields[] = "fname='$fname'";
    }
    if ($lname) {
        $updateFields[] = "lname='$lname'";
    }
    if ($email) {
        $updateFields[] = "email='$email'";
    }
    if ($mnumber) {
        $updateFields[] = "mnumber='$mnumber'";
    }
    if ($password) {
        $updateFields[] = "password='$password'";
    }

    if (count($updateFields) > 0) {
        $updateQuery .= implode(", ", $updateFields) . " WHERE id='$userId'";

        // Execute the query
        if (mysqli_query($conn, $updateQuery)) {
            // After successful update, fetch the updated user details from the database
            $query = "SELECT * FROM userdetails WHERE id='$userId'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            // Update session data with the new values
            $_SESSION['user']['fname'] = $row['fname'];
            $_SESSION['user']['lname'] = $row['lname'];
            $_SESSION['user']['email'] = $row['email'];
            $_SESSION['user']['mnumber'] = $row['mnumber'];
            $_SESSION['user']['password'] = $row['password'];

            // Return success message
            echo "success";
        } else {
            echo "error";  // Return error message if query fails
        }
    } else {
        echo "error";  // If no valid data to update
    }
}
?>
