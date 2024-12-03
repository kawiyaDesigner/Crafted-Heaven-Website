<?php
include 'navbar.php';
include("dbconn.php");
session_start();

// Get the logged-in user ID from the session
if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    echo json_encode(['success' => false, 'message' => 'User is not logged in']);
    exit();
}

// Handle the order submission for a specific product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_product_id'])) {
    $productId = $_POST['order_product_id'];

    // Update the status of the specific cart item
    $updateQuery = "UPDATE cart SET status = 'ordered' WHERE userid = '$userId' AND productid = '$productId' AND (status IS NULL OR status = '')";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Order placed for product ID $productId successfully!'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Failed to place order for product ID $productId. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css" />
    <style>
   /* General body and page styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.navbar {
    /* Assuming you have navbar styles defined here */
    background-color: #073f7b;
    padding: 15px;
    color: white;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
}

/* Cart section styling */
.cart-section {
  
    padding: 40px 20px;
    text-align: center;
}

/* Cart header styling */
.section-header {
    font-size: 36px;
    color: #073f7b; /* Text color */
    margin:75px 0 0 0;
    text-transform: uppercase;
    letter-spacing: 1px;
   
    padding: 20px;
    position: fixed; /* Fixed position */
    top: 0;
    left: 0;
    width: 100%; /* Full width */
    z-index: 999; /* Ensure it stays on top */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow to give it a modern feel */
    border-radius: 0 0 10px 10px; /* Rounded corners at the bottom */
    display: block; /* Ensure it spans the entire width */
}

/* Cart container */
.cart-container {
   
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 160px; /* Space below the fixed header */
}

/* Cart card styling */
.cart-card {
    
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    width: 300px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    overflow: hidden;
}

.cart-card img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.cart-card h4 {
    margin: 15px 0;
    font-size: 20px;
    color: #333;
}

.cart-card p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

/* Hover effect on cart card */
.cart-card:hover {
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.cart-card:hover img {
    transform: scale(1.05);
}

/* Order button styling */
.order-button {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #073f7b;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.order-button:hover {
    background-color: #00254d;
    transform: translateY(-2px);
}

.order-button:active {
    background-color: #001e34;
    transform: translateY(0);
}

.order-button:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

/* Empty cart message */
.empty-cart {
    text-align: center;
    font-size: 18px;
    color: #555;
    margin-top: 20px;
}

/* Responsive design for mobile view */
@media (max-width: 768px) {
    .cart-container {
        flex-direction: column;
        align-items: center;
    }
    .cart-card {
        width: 80%;
        max-width: 400px;
    }
}

    </style>
</head>
<body>
<section class="cart-section">
    <h2 class="section-header">Your Cart</h2>
    <div class="cart-container">
        <?php
        // Query to get all products added by the logged-in user
        $query = "
            SELECT c.productid, p.name, p.description, p.image, p.price 
            FROM cart c 
            INNER JOIN products p ON c.productid = p.id 
            WHERE c.userid = '$userId' AND (c.status IS NULL OR c.status = '')
        ";

        $result = mysqli_query($conn, $query);

        // Check if the cart is empty
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="cart-card">
                    <?php if (!empty($row['image'])): ?>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
                    <?php else: ?>
                        <img src="default-image.jpg" alt="Default Product Image">
                    <?php endif; ?>
                    <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p><strong>Price:</strong> Rs. <?php echo htmlspecialchars($row['price']); ?></p>
                    <form method="post">
                        <input type="hidden" name="order_product_id" value="<?php echo $row['productid']; ?>">
                        <button type="submit" class="order-button">Place Order</button>
                    </form>
                </div>
            <?php }
        } else {
            echo "<p class='empty-cart'>Your cart is empty. Add some products!</p>";
        }
        ?>
    </div>
</section>
</body>
</html>
