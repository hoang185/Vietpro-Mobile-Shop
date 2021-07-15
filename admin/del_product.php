<?php
session_start();
define("SECURITY", True);
include_once("../config/connect.php");
$prd_id = $_GET['prd_id'];

if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    $sql="SELECT * FROM product WHERE prd_id='$prd_id'";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($query);
    $image=$row['prd_image'];
    unlink("img/products/$image");
    $sql_del = "DELETE FROM product WHERE prd_id = '$prd_id'";
    mysqli_query($conn, $sql_del);
    header("location: index.php?page_layout=product");
}else{
    include_once("index.php");
}
?>