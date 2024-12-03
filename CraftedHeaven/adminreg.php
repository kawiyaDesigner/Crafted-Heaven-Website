<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin registration </title>
    <link rel="stylesheet" href="adminreg.css">
</head>
<body>
<br>
    <br>
    <br>
    <br> 
<div class="card">
    <div class="container j" >
        <center><h1>Admin Registration</h1></center>
        <form action="admindb.php" method="POST">
        

            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" placeholder="First name...."><br>

            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" placeholder="Last name..."><br>
            
            <label for="mnumber">Mobile number</label>
            <input type="text" name="mnumber" id="mnumber"placeholder="Mobile number.."><br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email ..."><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password..."><br>

            <input type="submit"  class="registerbtn" value="Submit" name="submit" >
        </form>
        
    </div>
</div>

</body>
</html>