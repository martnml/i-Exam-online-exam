<?php
include_once('../config/db_conn.php');

$id = $_POST['iduser'];
$pw = $_POST['password'];
$confirm = $_POST['confirm_password'];
$old = $_POST['old_password'];



$sql = "SELECT * FROM user WHERE user.id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_pw = ($row['password']);


if(5!= 5)  echo '<script>alert("please enter the right password")</script>';


else if($pw != $confirm)  echo '<script>alert("please enter password and confirmation correctly")</script>';



else{

$pw = md5($pw);
$sql="UPDATE user SET user.password='$pw' WHERE user.id='$id' ";
$result=mysqli_query($conn,$sql);

echo '<script>alert("Password Updated successfully")</script>';


}






?>