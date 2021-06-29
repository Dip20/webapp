<?php
session_start();
//get session user email id
$email=$_SESSION['email'];
$rname=$_SESSION['rname'];//reset password username.

$r=rand(111111,999999);//generate OTP
$_SESSION['otp']=$r;
//here is the mothode for send otp via smpt email

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "admin@santusarkarofficial.site";
$to = $email;
$subject = "Password Reset request for Videologic service WebApp";
$message =  $rname .", You have requested for password reset. Your OTP is: ". $r;
$headers = "From:" . $from;

// mail($to,$subject,$message, $headers);
if ($_SESSION['token1']=TRUE) {
  header("location:validateOTP.php");
}else {
  header("location:../validateOTP.php");

}



 ?>
