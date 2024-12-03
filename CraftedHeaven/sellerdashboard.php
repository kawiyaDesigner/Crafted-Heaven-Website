<?php
session_start();
include("dbconn.php");
if (!isset($_SESSION['seller']['id'])) {
    header("Location: sellerlogin.php");
    exit();
}
include 'sellernav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="sellerdashboard.css">
</head>
<body>
<div class="profile-container">
    <div class="profile-card">
        <div class="cover-photo">
            <img src="White Oak [Official Chillhop Music wallpaper].jpeg" alt="Cover Photo" class="cover-img">
            <button class="upload-btn">Upload Cover</button>
        </div>

        <div class="profile-info">
            <div class="avatar">
                <img id="profile-image" src="<?php echo htmlspecialchars($_SESSION['seller']['image']); ?>" alt="Profile Picture">
                <button class="change-avatar" id="change-avatar-btn">Change</button>
                <button class="delete-avatar" id="delete-avatar-btn">Delete</button>
            </div>

            <h2><?php echo htmlspecialchars($_SESSION['seller']['fname']) . " " . htmlspecialchars($_SESSION['seller']['lname']); ?></h2>
            <p><?php echo htmlspecialchars($_SESSION['seller']['email']); ?></p>
        </div>

        <div class="details">
            <div class="detail-row">
                <span>First Name</span>
                <span id="fname"><?php echo htmlspecialchars($_SESSION['seller']['fname']); ?></span>
                <a href="#" class="edit-link" id="fname-link" onclick="editDetail('fname', '<?php echo htmlspecialchars($_SESSION['seller']['fname']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Last Name</span>
                <span id="lname"><?php echo htmlspecialchars($_SESSION['seller']['lname']); ?></span>
                <a href="#" class="edit-link" id="lname-link" onclick="editDetail('lname', '<?php echo htmlspecialchars($_SESSION['seller']['lname']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Company Name</span>
                <span id="company"><?php echo htmlspecialchars($_SESSION['seller']['company']); ?></span>
                <a href="#" class="edit-link" id="company-link" onclick="editDetail('company', '<?php echo htmlspecialchars($_SESSION['seller']['lname']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>E-Mail</span>
                <span id="email"><?php echo htmlspecialchars($_SESSION['seller']['email']); ?></span>
                <a href="#" class="edit-link" id="email-link" onclick="editDetail('email', '<?php echo htmlspecialchars($_SESSION['seller']['email']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Mobile Number</span>
                <span id="mnumber"><?php echo htmlspecialchars($_SESSION['seller']['mnumber']); ?></span>
                <a href="#" class="edit-link" id="mnumber-link" onclick="editDetail('mnumber', '<?php echo htmlspecialchars($_SESSION['seller']['mnumber']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Password</span>
                <span id="password"><?php echo htmlspecialchars($_SESSION['seller']['password']); ?></span>
                <a href="#" class="edit-link" id="password-link" onclick="editDetail('password', '<?php echo htmlspecialchars($_SESSION['seller']['password']); ?>')">Edit</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>