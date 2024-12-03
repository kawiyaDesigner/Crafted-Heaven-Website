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
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin:30px 0 0 0;
            
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #009578;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #007d5c;
        }

        .file-input {
            display: none; /* Hide the default file input */
        }

        .file-input-label {
            display: inline-block;
            padding: 10px 20px;
            background-color: #009578;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-align: center;
        }

        .file-input-label:hover {
            background-color: #007d5c;
            transform: scale(1.05);
        }

        .file-input-label:active {
            background-color: #005a41;
            transform: scale(1);
        }

 
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add Product</h1>
        <form action="productdb.php" method="POST">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="text" name="price" id="price" required>

            
            
            <input type="file" name="image" id="image" accept="image/*" class="file-input">
            <label for="image" class="file-input-label">Choose a Image</label>
           

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
