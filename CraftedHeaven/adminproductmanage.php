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
    <title>Document</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
        }

        .users{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .user-container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .user-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        /* User card styles */
        .user-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 300px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            margin-top: 190px;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #ddd;
        }

        .user-card h5 {
            margin: 10px 0 5px;
            font-size: 18px;
            color: #555;
        }

        .user-card p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }

        /* Button styles */
        .button-container {
            margin-top: 10px;
        }

        .button-container a {
            text-decoration: none;
            color: #fff;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            font-size: 14px;
            display: inline-block;
        }

        .edit-btn {
            background-color: #4caf50;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .add-button {
    position: fixed;
    bottom: 70px;
    right: 70px;
    background-color: #009578;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.add-button:hover {
    background-color: #007d5c;
    transform: rotate(45deg);
}

.add-button a {
    text-decoration: none;
    color: white;
    font-size: 2rem;
}

/* Page header */
.header {
            
            color: #073f7b; /* Text color */
            margin:75px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color:white;
            text-align:center;
            position: fixed; /* Fixed position */
            top: 0;
            left: 0;
            width: 100%; /* Full width */
            z-index: 999; /* Ensure it stays on top */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow to give it a modern feel */
            border-radius: 0 0 10px 10px; /* Rounded corners at the bottom */
            display: block; /* Ensure it spans the entire width */
        }
    </style>
</head>
<body>
<section class="user-container">
    <div class="header">
    <h1>Product Mangement</h1>
    </div>
    <div class="user-section">
        
        <div class="users">
            <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);
            ?>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="user-card">         
                    <?php if (!empty($row['image'])): ?>
                        <img src="<?php echo $row['image']; ?>" alt="profile Image" class="profile-image">
                    <?php endif; ?>
                    <h5>ID: <?php echo $row['id']; ?></h5>
                    <p> <?php echo $row['name']; ?></p>
                    <p> <?php echo $row['description']; ?></p>
                    <p> <?php echo $row['price']; ?></p>
                    <p> <?php echo $row['sellerid']; ?></p>
                   
                    <div class="button-container">
                    <a class="edit-btn" href="updateproduct.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="delete-btn" href="productdelete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a> 
                    </div> 
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<button class="add-button">
    <a href="addproduct.php">+</a>
</button>
</body>
</html>