<?php
require_once("connection.php");
require_once("info.php");

$log=$_SESSION['logkey'];//log key is define to get activity
$user=$_SESSION['user'];
$access=$_SESSION['role'];
$remarks="";
$action;
$ctime=date("d-m-yy") . " , " .  date("h:i:s-a");
//here is switch case to assign action based on user task perform

  switch ($log)
  {
    case '1':
    $action="Loged in";
    $remarks="Success";
      break;

    case '2':
    $action="Loged Out";
    $remarks="NULL";
      break;

    case '3':
    $action="Complain added";
    $remarks=$_SESSION['jobno'];
      break;

    case '4':
    $action="Server Error Failed to Add Complain";
    $remarks="Error";
      break;

    case '5':
    $action="User Registration Block";
    $remarks=$_SESSION['block-status'];
      break;

    case '6':
    $action="User role status update : " . $_SESSION['update-user'];
    $remarks="Blocked : ".$_SESSION['update-status'] . "<br> Permission: " . $_SESSION['update-permission'] . ".<br> Role: " . $_SESSION['update-role'];
      break;

    case '7':
    $action="User Deleted";
    $remarks=$_SESSION['update-user'];
      break;

    case '8':
    $action="Technician Deleted";
    $remarks=$_SESSION['update-user'];
      break;

    case '9':
    $action="Unblock User";
    $remarks=$_SESSION['update-user'];
      break;

    case '10':
    $action="Delete complain";
    $remarks=$_SESSION['delete-complain'];
      break;

    default:
    $action="Null";
    $remarks="Null";
      break;
  }

$sql="INSERT INTO tbl_activity (username,useraccess,action,remarks,timestamp1) VALUES  ('$user','$access','$action','$remarks','$ctime')";
$runcmd=mysqli_query($conn,$sql);

if ($runcmd) {
  // unset session...........
  unset($_SESSION['logkey']);
  unset($_SESSION['jobno']);
  unset($_SESSION['update-user']);
  unset($_SESSION['update-status']);
  unset($_SESSION['update-permission']);
  unset($_SESSION['update-role']);
  unset($_SESSION['delete-complain']);
}else {
  echo "Failed: " . $conn->error;
}



?>
