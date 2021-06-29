<?php
session_start();
require_once("../php/connection.php");
require_once("../php/info.php");

//get unblock id from session
  $delid=$_GET['em'];


$check="SELECT * FROM tbl_login WHERE Email='$delid'";
$run_check=mysqli_query($conn,$check);
$result=mysqli_fetch_assoc($run_check);
$name=$result['username'];

   $sql1="UPDATE tbl_login set block='No' WHERE Email='$delid'";

  $run1=mysqli_query($conn,$sql1);

  if ($run1)
   {

     //user activiry tracker
      $_SESSION['logkey']="9";
      $_SESSION['update-user']=$name;
      include_once("../php/index.php");

     // redirect to page
   header("location:blocked-user.php");

    }else{

  echo "Server Error, please try again later";
  echo "<br> " . $conn->error;

   }

// }







?>
