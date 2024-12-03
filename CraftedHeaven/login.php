<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['Email'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
     <br>
    <br>
    <br>
    <br>
<div class="card">
    <div class="login" >
        <center><h1>Login Form</h1></center>
        <?php
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    if ($error == 'empty_fields') {
        echo "<p>Please fill in all fields.</p>";
    } elseif ($error == 'invalid_credentials') {
        echo "<p>Invalid email or password.</p>";
    }
}
?>

        <form action="userlogin.php" method="POST">
        
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email id..." ><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password..."><br>

            <div class="middle">
            <center>If you don't have an Account ? <a href="userregister.php">User Register</a></center>
            <input type="submit"  class="loginbtn" value="Login" name="submit" >
            </div>
            
            <div class="footer">
                <a href="adminlogin.php"><input  class="adminbtn"  value="Admin"  name="submit"></a>
               <a href="sellerlogin.php"><input class="sellerbtn"  value="Seller"  name="submit"></a>

            </div>
        </form>
       
    </div>
</div>
    
</body>
</html>