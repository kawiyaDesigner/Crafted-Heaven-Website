<?php
include("dbconn.php");
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        // Redirect if fields are empty
        header("Location:login.php");
        exit();
    } else {
        // Query to fetch user details
        $sql = "SELECT * FROM userdetails WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);

            // Store user details in session
            $_SESSION['user'] = [
                'email' => $row['email'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'mnumber' => $row['mnumber'],
                'id' => $row['id'],
                'image' => $row['image'], // Include the image column here
                'password' => $row['password']
            ];

            // Redirect to home page
            header("Location:home.php");
        } else {
            // Redirect if credentials are invalid
            header("Location:login.php");
            exit();
        }
    }
}
?>
