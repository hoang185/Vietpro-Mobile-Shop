<?php
if(!defined("SECURITY")){
	die("ban ko co quyen truy cap trang nay");
}
$conn=mysqli_connect('localhost','root','','vietpro_mobile_shop');
if($conn){
    mysqli_query($conn,"SET NAMEs 'utf8'");
}else{
    echo "ket noi that bai";
}
?>

