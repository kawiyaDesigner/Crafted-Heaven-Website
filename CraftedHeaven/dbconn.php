<?php
$servername="localhost";
$username="root";
$password="";
$dbname="crafted_heaven";

try{
$conn= new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("connection faild".$conn->connect_error);
    }
    else{
    //echo"Connected";
    }
}catch(Exception $e){
    echo"Message".$e->getMessage();
}
?>