<?php

$servername="localhost";
$username="root";
$password="";
$database="videologic";


$conn=new mysqli($servername,$username,$password,$database);

if ($conn->connect_error){

  echo"connect Error: " . $conn->connect_error ;

}
else {
//  echo "connected";
}




date_default_timezone_set("Asia/kolkata");//set asia time


 ?>
