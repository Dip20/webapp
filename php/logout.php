<?php
session_start();
require_once("connection.php");
require_once("info.php");
error_reporting(0);

//user activiry tracker
$_SESSION['logkey']="2";
include_once("index.php");

session_unset();
session_destroy();
header("location:../index.php");


 ?>
