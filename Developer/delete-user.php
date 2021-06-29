<?php
session_start();
require_once("../php/connection.php");
require_once("../php/info.php");

//get delete id from session
  $delid=$_GET['em'];

//verify weather user super DB admin or note
//if delete id is del_index is NO then delete action should denied

$check="SELECT * FROM tbl_login WHERE Email='$delid'";
$run_check=mysqli_query($conn,$check);
$result=mysqli_fetch_assoc($run_check);
$del_index=$result['del_index'];
$name=$result['username'];

if ($del_index=="FALSE")
{
  $_SESSION['del_error']="Action Denied! Admin user can not be deleted.";
  header("location:view-user.php");

}else {

  //sql to Delete data
   $sql="DELETE FROM tbl_login WHERE Email='$delid'";
   $sql1="DELETE FROM tbl_technician WHERE emailid='$delid'";

  $run=mysqli_query($conn,$sql);
  $run1=mysqli_query($conn,$sql1);

  if ($run AND $run1)
   {

     //user activiry tracker
      $_SESSION['logkey']="7";
      $_SESSION['update-user']=$name;
      include_once("../php/index.php");

     // redirect to page
   header("location:view-user.php");

    }else{

  echo "Server Error, please try again later";

   }

}







?>
