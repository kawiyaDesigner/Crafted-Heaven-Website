<?php
include("dbconn.php");
include("sellernav.php");
session_start();

// Check if the seller is logged in
if (isset($_SESSION['seller']['id'])) {
    $sellerId = $_SESSION['seller']['id'];
} else {
    echo "<p>Seller is not logged in.</p>";
    exit();
}

// Fetch ordered items for the seller
$cartSql = "
    SELECT 
        c.id AS cart_id, 
        p.name AS product_name, 
        p.description, 
        p.image, 
        p.sellerid, 
        c.userid AS buyer_id, 
        u.fname AS buyer_name 
    FROM 
        cart c 
    JOIN products p ON c.productid = p.id 
    JOIN userdetails u ON c.userid = u.id 
    WHERE p.sellerid = ? AND c.status = 'ordered'";
$cartStmt = $conn->prepare($cartSql);
$cartStmt->bind_param("i", $sellerId);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordered Products</title>
    <link rel="stylesheet" href="sidebar.css">
    <style>
        .orders-container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .order-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-card img {
            max-width: 100px;
            border-radius: 8px;
        }

        .order-details {
            flex: 1;
        }

        .order-details p {
            margin: 5px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="orders-container">
        <h1>Ordered Products</h1>
        <?php if ($cartResult->num_rows > 0): ?>
            <?php while ($row = $cartResult->fetch_assoc()): ?>
                <div class="order-card">
                    <?php if (!empty($row['image'])): ?>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
                    <?php else: ?>
                        <img src="default-image.jpg" alt="Default Product Image">
                    <?php endif; ?>

                    <div class="order-details">
                        <p><strong>Product:</strong> <?php echo htmlspecialchars($row['product_name']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                        <p><strong>Buyer:</strong> <?php echo htmlspecialchars($row['buyer_name']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No ordered products found.</p>
        <?php endif; ?>

        <?php
        // Close the statement and connection
        $cartStmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
