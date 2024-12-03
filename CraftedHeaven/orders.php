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

// Query to fetch confirmed orders for the logged-in seller
$sql = "
    SELECT offers.id AS offer_id, offers.price, requests.design_id, userdetails.fname AS buyer_name 
    FROM offers 
    JOIN requests ON offers.requestid = requests.id 
    JOIN userdetails ON offers.userid = userdetails.id 
    WHERE offers.sellerid = ? AND offers.confirmation = 'confirmed'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sellerId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top:120px
        }

        .order-details {
            max-width: 70%;
        }

        .order-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .order-status {
            font-size: 16px;
            color: green;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .order-status svg {
            width: 20px;
            height: 20px;
            fill: green;
        }

         /* Page header */
         .header {
            
            color: #073f7b; /* Text color */
            margin:75px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color:white;
            padding: 10px;
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
    <div class="orders-container">
        <div class="header">
        <h1>Confirmed Requests</h1>
        </div>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="order-card">
                    <div class="order-details">
                        <p><strong>Buyer:</strong> <?php echo htmlspecialchars($row['buyer_name']); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                        <p><strong>Design ID:</strong> <?php echo htmlspecialchars($row['design_id']); ?></p>
                    </div>
                    <div class="order-status">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm-1.2 18L4.8 12.4l1.4-1.4 4.6 4.6 7.4-7.4 1.4 1.4-8.8 8.8z"></path>
                        </svg>
                        <span>Confirmed</span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No confirmed orders found for your account.</p>
        <?php endif; ?>

        <?php
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
