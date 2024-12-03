<?php
include("dbconn.php");
session_start();
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(empty($email) || empty($password)) {
        header("Location:adminlogin.php");
        exit();
    } else {
        $sql = "SELECT * FROM admindetails WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin'] = [
                'email' => $row['email'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'mnumber' => $row['mnumber'],
                'id' => $row['id'],
                'image' => $row['image'], // Include the image column here
                'password' => $row['password']
            ];
            header("Location:adminprofile.php");
        } else {
            header("Location:adminlogin.php");
            exit();
        }
    }
}
?>