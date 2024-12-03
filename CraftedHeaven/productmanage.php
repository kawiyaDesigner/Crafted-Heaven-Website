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
    <title>Manage Products</title>
    <style>
 body {
    font-family: 'Roboto', sans-serif;
    margin: 50px 0 0 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

.product-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}

.product-section h1 {
    font-size: 2.3rem;
 
}

.product-items {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.product-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 280px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-top:150px;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.product-image {
    width: 50%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.product-card h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #333;
}

.product-card p {
    font-size: 0.75rem;
    line-height: 1.5;
    color: #666;
    margin-bottom: 15px;
}

.product-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    color: #009578;
    font-size: 1.1rem;
}

.add-button {
    position: fixed;
    bottom: 70px;
    right: 70px;
    background-color: #073f7b;
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
    background-color: #073f7b;
    transform: rotate(45deg);
}

.add-button a {
    text-decoration: none;
    color: white;
    font-size: 2rem;
}

.delete-button {
    background-color: #e63946;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin-left: 10px;
}

.delete-button:hover {
    background-color: #d62839;
    transform: scale(1.1);
}

.delete-button a {
    text-decoration: none;
    color: white;
    font-size: 1.2rem;
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
<div class="product-section"> 
    <div class="header"> 
    <h1>Products</h1>
    </div>  
    <div class="product-items">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card" data-id="<?php echo $row['id']; ?>">
                <?php if (!empty($row['image'])): ?>
                    <img src="<?php echo $row['image']; ?>" alt="Product Image" class="product-image">
                <?php else: ?>
                    <img src="default-image.jpg" alt="Default Product Image" class="product-image">
                <?php endif; ?>
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <div class="product-card-footer">
                    <h3>Rs. <?php echo htmlspecialchars($row['price']); ?></h3>
                    <button class="delete-button">
                    <a href="deleteproduct.php?id=<?php echo $row['id']; ?>">&#x1F5D1;</a>
                    </button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Add Product Button -->
<button class="add-button">
    <a href="addproduct.php">+</a>
</button>

</body>
</html>
