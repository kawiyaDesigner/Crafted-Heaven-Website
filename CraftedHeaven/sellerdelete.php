<?php
include("dbconn.php");

if(isset($_GET['id'])){
$delete=$_GET['id'];
echo $delete;
}

$sql= "delete from sellerdetails where id=$delete";
$result=mysqli_query($conn,$sql);


if($result){

    header("Location:sellermanage.php");
}
else{
    echo "Error".$sql."<br>".mysqli_error($conn);

}

?>