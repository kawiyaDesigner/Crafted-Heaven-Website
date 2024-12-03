<?php
session_start();
include("dbconn.php");

if (!isset($_SESSION['admin']['id'])) {
    header("Location: login.php");
    exit();
}
// Page content here
include 'adminnav.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="userprofile.css">

    <script>



function editDetail(id, currentValue) {
    var currentSpan = document.getElementById(id);
    var currentLink = document.getElementById(id + '-link');

    // Create an input field with the current value
    var inputField = document.createElement('input');
    inputField.type = 'text';
    inputField.value = currentValue;
    inputField.id = id + '-input';
    currentSpan.innerHTML = ''; // Clear current span content
    currentSpan.appendChild(inputField); // Append input field to the span

    // Change the link to 'Save' for saving the updated value
    currentLink.innerHTML = 'Save';
    currentLink.onclick = function() { saveDetail(id); };
}

function saveDetail(id) {
    var inputField = document.getElementById(id + '-input');
    var updatedValue = inputField.value;

    // Send the updated value to the server via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateProfile.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var params = "id=" + <?php echo $_SESSION['admin']['id']; ?> + "&" + id + "=" + updatedValue;

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Check if the update was successful
            if (xhr.responseText === "success") {
                // Update the span content with the new value
                var currentSpan = document.getElementById(id);
                currentSpan.innerHTML = updatedValue;

                alert(id + " updated successfully.");

                // Refresh the page to reflect updated session data
                location.reload();
            } else {
                alert("Error updating " + id);
            }
        }
    };
    xhr.send(params);

    // After saving, change the link back to 'Edit'
    var currentLink = document.getElementById(id + '-link');
    currentLink.innerHTML = 'Edit';
    currentLink.onclick = function() { editDetail(id, updatedValue); };
}




    </script>
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
                <img id="profile-image" src="<?php echo htmlspecialchars($_SESSION['admin']['image']); ?>" alt="Profile Picture">
                <button class="change-avatar" id="change-avatar-btn">Change</button>
                <button class="delete-avatar" id="delete-avatar-btn">Delete</button>
            </div>

            <h2><?php echo htmlspecialchars($_SESSION['admin']['fname']) . " " . htmlspecialchars($_SESSION['admin']['lname']); ?></h2>
            <p><?php echo htmlspecialchars($_SESSION['admin']['email']); ?></p>
        </div>

        <div class="details">
            <div class="detail-row">
                <span>First Name</span>
                <span id="fname"><?php echo htmlspecialchars($_SESSION['admin']['fname']); ?></span>
                <a href="#" class="edit-link" id="fname-link" onclick="editDetail('fname', '<?php echo htmlspecialchars($_SESSION['admin']['fname']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Last Name</span>
                <span id="lname"><?php echo htmlspecialchars($_SESSION['admin']['lname']); ?></span>
                <a href="#" class="edit-link" id="lname-link" onclick="editDetail('lname', '<?php echo htmlspecialchars($_SESSION['admin']['lname']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>E-Mail</span>
                <span id="email"><?php echo htmlspecialchars($_SESSION['admin']['email']); ?></span>
                <a href="#" class="edit-link" id="email-link" onclick="editDetail('email', '<?php echo htmlspecialchars($_SESSION['admin']['email']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Mobile Number</span>
                <span id="mnumber"><?php echo htmlspecialchars($_SESSION['admin']['mnumber']); ?></span>
                <a href="#" class="edit-link" id="mnumber-link" onclick="editDetail('mnumber', '<?php echo htmlspecialchars($_SESSION['admin']['mnumber']); ?>')">Edit</a>
            </div>

            <div class="detail-row">
                <span>Password</span>
                <span id="password"><?php echo htmlspecialchars($_SESSION['admin']['password']); ?></span>
                <a href="#" class="edit-link" id="password-link" onclick="editDetail('password', '<?php echo htmlspecialchars($_SESSION['admin']['password']); ?>')">Edit</a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('change-avatar-btn').onclick = function() {
    // Open a file input dialog to choose a new profile picture
    var fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*'; // Accept image files only
    fileInput.onchange = function(event) {
        var file = event.target.files[0];
        if (file) {
            var formData = new FormData();
            formData.append('profile-image', file);
            formData.append('id', <?php echo $_SESSION['admin']['id']; ?>);

            // Send the image via AJAX to the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateProfilePicture.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText === "success") {
                        alert("Profile picture updated successfully!");
                        // Update the profile image on the page
                        document.getElementById('profile-image').src = URL.createObjectURL(file);
                    } else {
                        alert("Error updating profile picture.");
                    }
                }
            };
            xhr.send(formData);
        }
    };
    fileInput.click(); // Trigger the file input dialog
};

document.getElementById('delete-avatar-btn').onclick = function() {
    // Confirm the user wants to delete the profile picture
    if (confirm("Are you sure you want to delete your profile picture?")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'deleteProfilePicture.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText === "success") {
                    alert("Profile picture deleted successfully.");
                    document.getElementById('profile-image').src = 'default.jpeg'; // Show a default image
                } else {
                    alert("Error deleting profile picture.");
                }
            }
        };
        xhr.send("id=" + <?php echo $_SESSION['admin']['id']; ?>);
    }
};
</script>
</body>
</html>
