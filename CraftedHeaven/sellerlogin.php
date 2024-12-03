<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['Email'] ) )
{
    header("Location:sellerdashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller login form</title>
    <link rel="stylesheet" href="sellerlogin.css">

</head>
<body>
     <br>
    <br>
    <br>
    <br>
<div class="card">
    <div class="login" >
        <center><h1>Seller Login Form</h1></center>
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
    
        <?php
        // if(isset($_GET['mssage']))
        // {
        //     echo"<h1 style='color:red;'>$_GET['mssage']</h1>";
        // }
        ?>
        <form action="seller.php" method="POST">
        
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email id..." ><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password..."><br>

            <div class="middle">
            <center>If you don't have an Account ? <a href="sellerregister.php">Seller Register</a></center>
            <input type="submit"  class="loginbtn" value="Login" name="submit" >
            
            </div>
            
        
        </form>
       
    </div>
</div>
    
</body>
</html>