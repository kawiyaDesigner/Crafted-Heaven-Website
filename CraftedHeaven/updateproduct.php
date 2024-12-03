<?php
include("dbconn.php");

if (isset($_GET['id'])) {
    $update = $_GET['id'];

    // Fetch product details to populate the form
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $update);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No product ID specified.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data securely
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $sellerid = $_POST['sellerid'];

    // Update the database securely using a prepared statement
    $updateQuery = "UPDATE products SET name = ?, description = ?, price = ?, sellerid = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);

    // Bind the parameters with proper types
    $updateStmt->bind_param("ssdii", $name, $description, $price, $sellerid, $update);

    if ($updateStmt->execute()) {
        header("Location: adminproductmanage.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        /* Add some basic styling */
        .card {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .card h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card input[type="text"],
        .card input[type="submit"] {
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .registerbtn {
            background: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .registerbtn:hover {
            background: #45a049;
        }

        .card a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>Update Product</h1>
    <form method="POST">
        <input type="text" name="name" id="name" placeholder="Name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        <input type="text" name="description" id="description" placeholder="Description" value="<?php echo htmlspecialchars($row['description']); ?>" required>
        <input type="text" name="price" id="price" placeholder="Price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
        <input type="text" name="sellerid" id="sellerid" placeholder="Seller ID" value="<?php echo htmlspecialchars($row['sellerid']); ?>" required>
        
        <input type="submit" class="registerbtn" value="Update">
    </form>
    <a href="adminproductmanage.php">Back to Admin Profile</a>
</div>
</body>
</html>
