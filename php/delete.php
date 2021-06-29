<?php
session_start();
include_once("connection.php");
error_reporting(0);

//get delete id from session
$delid=$_SESSION['deleteID'];


//sql to Delete data

 $sql="DELETE FROM tbl_complain WHERE jobno='$delid'";

$run=mysqli_query($conn,$sql);

if ($run)
 {
   //user activiry tracker
    $_SESSION['logkey']="10";
    $_SESSION['delete-complain']=$delid;
    include_once("index.php");

   unset($_SESSION['deleteID']);

  //redirect to page view Technician
   header("location:../admin.php");

  }else{

echo "Server Error, please try again later";

 }


?>
