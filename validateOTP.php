<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);
$invalid_OTP=FALSE;

// restrict page if OTP session is empty
if (empty( $_SESSION['otp']))
{
  header("location:index.php");
}
// page redirect if otp validation completed
if ($_SESSION['token_setpass'])
{
  header("location:setpass.php");
}



//here is code for validate OTP .................
if (isset($_POST['validate']))
{
  //assign variable
  $uotp=$_POST['otp'];
  $sotp=$_SESSION['otp'];

  if ($sotp==$uotp)
   {

// otp validate successfully code here for next process
unset($_SESSION['otp']);
unset($_SESSION['token1']);

$_SESSION['token_setpass']=TRUE;//assign token to trace otp validated
header("location:setpass.php");

  }else
    {
    $invalid_OTP=TRUE;
    }
}





 ?>
<!-- phpcode ends here............................................................................................... -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Videologic-service-validateOTP</title>
     <!-- Bootstrap link -->
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   <!-- custom css link -->
   <link rel="stylesheet" href="css/main.css">
</head>
   <!-- js link -->
   <script src="bootstrap/js/jquery.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>
   <!-- js link ends here -->

<body>


<!-- nav bar starts here -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <a class="navbar-brand" href="index.php">Videologic Service</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
         <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="contact.php">Contact</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#">About</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="trace.php">Trace Job</a>
       </li>


 </div>

   </ul>
</nav>
<!-- Nav close here -->

<!-- content for body starts here -->

 <br><br>
 <section class="container-fluid">
   <section class="row justify-content-center">
       <section class="col-12 col-sm-10 col-md-4">

         <form class="form-container shadow" action="validateOTP.php" method="post">
           <div class="form-group">
             <h3 class="text text-primary text-center ">Forgot Password</h3>
           </div>
           <p class="text-center text-success">
              An OTP has sent to  <strong>" <?php echo $_SESSION['email'];?> "</strong>, <br>
              Please Enter OTP to Validate
            </p>
           <br>
           <div class="form-group">
               <label for="exampleInputEmail1">Enter OTP</label>
               <input type="text" name="otp" class="form-control" maxlength="6"  required autocomplete="off">
           </div>
           <br>
        <button type="submit" name="validate" class="btn btn-primary  btn-block">Validate OTP</button>
        <br>
          <p class="text-center"><a href="php/sendOTP.php">Resend OTP</a></p>

          <?php if ($invalid_OTP) {
      echo '<p class="alert alert-danger role=alert text-center">Invalid OTP!</p>';
        }  ?>

                        </form>
                      </section>
                  </section>
                </section>

  <!-- forgot pass form end here.................................................................... -->
<br><br><br><br><br>



<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
  <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
 <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
