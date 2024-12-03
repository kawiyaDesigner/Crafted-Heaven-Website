<?php
include("dbconn.php");
session_start();

// Ensure the seller is logged in
if (isset($_SESSION['seller']['id'])) {
    $sellerId = $_SESSION['seller']['id'];
} else {
    echo "Seller is not logged in.";
    exit();
}


$name=$_POST['name'];
$description=$_POST['description'];
$price=$_POST['price'];
$image=$_POST['image'];




echo $name.$description.$price.$image;
$sql = "INSERT INTO products (name, description, price, image, sellerid) VALUES ('$name', '$description', '$price', '$image', '$sellerId')";
if(mysqli_query($conn,$sql)){
    echo"created!";
    header("Location:productmanage.php");
}
else{
  echo"Error".$sql."<br>".mysqli_error($conn);  
}




// Handle file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a real image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size (limit to 5MB)
if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// If everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>