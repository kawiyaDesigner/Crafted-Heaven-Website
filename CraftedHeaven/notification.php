<?php
include("dbconn.php");
include("navbar.php");
session_start();

// Initialize an alert message
$alertMessage = "";

// Get the logged-in user ID from the session
if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    echo "<p>User is not logged in.</p>";
    exit();
}

// Handle reject action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reject_offer_id'])) {
        $offerId = intval($_POST['reject_offer_id']);
        $deleteSql = "DELETE FROM offers WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $offerId);
        if ($deleteStmt->execute()) {
            $alertMessage = "Offer rejected successfully!";
        } else {
            $alertMessage = "Failed to reject the offer.";
        }
        $deleteStmt->close();
    }

    if (isset($_POST['accept_offer_id'])) {
        $offerId = intval($_POST['accept_offer_id']);
        $updateSql = "UPDATE offers SET confirmation = 'confirmed' WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $offerId);
        if ($updateStmt->execute()) {
            $alertMessage = "Offer accepted successfully!";
        } else {
            $alertMessage = "Failed to accept the offer.";
        }
        $updateStmt->close();
    }
}

// Query to fetch rows from the 'offers' table where userid matches
$sql = "
    SELECT offers.id AS offer_id, offers.price, sellerdetails.fname AS seller_name, 
           requests.design_id, offers.confirmation 
    FROM offers 
    JOIN sellerdetails ON offers.sellerid = sellerdetails.id 
    JOIN requests ON offers.requestid = requests.id
    WHERE offers.userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="sidebar.css">
    <script>
        // Display the alert message if it exists
        function showAlert(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body onload="showAlert('<?php echo addslashes($alertMessage); ?>')">
    <div class="notifications-container">
        <h1>Offers Sent By Sellers</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="notification-card">
                    <div class="notification-details">
                        <div>
                            <p><strong>Seller:</strong> <?php echo htmlspecialchars($row['seller_name']); ?></p>
                            <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                            <p><strong>Design ID:</strong> <?php echo htmlspecialchars($row['design_id']); ?></p>
                        </div>
                        <div class="offer-actions">
                            <?php if ($row['confirmation'] === 'confirmed'): ?>
                                <!-- SVG for accepted -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="40px" height="40px">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z"/>
                                </svg>
                            <?php else: ?>
                                <form method="POST" style="margin-bottom: 10px;">
                                    <input type="hidden" name="reject_offer_id" value="<?php echo htmlspecialchars($row['offer_id']); ?>">
                                    <button type="submit" class="reject-btn">Reject</button>
                                </form>
                                <form method="POST">
                                    <input type="hidden" name="accept_offer_id" value="<?php echo htmlspecialchars($row['offer_id']); ?>">
                                    <button type="submit" class="accept-btn">Accept</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No offers found for your account.</p>
        <?php endif; ?>

        <?php
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
