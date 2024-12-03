<?php
include("dbconn.php");

if (isset($_GET['id'])) {
    $update = $_GET['id'];

    // Fetch user details to populate the form
    $query = "SELECT * FROM userdetails WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $update);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "User not found.";
        exit();
    }
} else {
    echo "No user ID specified.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data securely
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mnumber = $_POST['mnumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the database securely using a prepared statement
    $updateQuery = "UPDATE userdetails SET fname = ?, lname = ?, mnumber = ?, email = ?, password = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssssi", $fname, $lname, $mnumber, $email, $password, $update);

    if ($updateStmt->execute()) {
        header("Location: usermanage.php");
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
    <h1>Update User</h1>
    <form method="POST">
        <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo htmlspecialchars($row['fname']); ?>" required>
        <input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($row['lname']); ?>" required>
        <input type="text" name="mnumber" id="mnumber" placeholder="Mobile Number" value="<?php echo htmlspecialchars($row['mnumber']); ?>" required>
        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        <input type="text" name="password" id="password" placeholder="Password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
        <input type="submit" class="registerbtn" value="Update">
    </form>
    <a href="usermanage.php">Back to Admin Profile</a>
</div>
</body>
</html>
