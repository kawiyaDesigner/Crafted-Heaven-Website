<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['Email'] ) )
{
    header("Location:admindashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="adminlogin.css">

</head>
<body>
     <br>
    <br>
    <br>
    <br>
<div class="card">
    <div class="login" >
        <center><h1>Admin Login Form</h1></center>
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
        <form action="admin.php" method="POST">
        
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email id..." ><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password..."><br>

            <div class="middle">
            <input type="submit"  class="loginbtn" value="Login" name="submit" >
            
            </div>
            
        
        </form>
       
    </div>
</div>
    
</body>
</html>