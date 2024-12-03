<?php
include("dbconn.php");

if(isset($_GET['id'])){
$delete=$_GET['id'];
echo $delete;
}

$sql= "delete from products where id=$delete";
$result=mysqli_query($conn,$sql);


if($result){

    header("Location:productmanage.php");
}
else{
    echo "Error".$sql."<br>".mysqli_error($conn);

}

?>