<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);
//assign variables
$notfound=FALSE;

//redirect page if user call for Forgotpassword
// if ($_SESSION['token1'])
// {
//   header("location:validateOTP.php");
// }

// if ($_SESSION['token_setpass'])
// {
//   header("location:setpass.php");
// }




//here is code for validate email id
if (isset($_POST['reset']))
 {
    $email=$_POST['email'];
    $cmd="SELECT * FROM tbl_login where email='$email'";
    $runcmd=mysqli_query($conn,$cmd);
    $result=mysqli_num_rows($runcmd);


    if ($result!=0)
    {
      //email found in DB so code here for next process..
      $data=mysqli_fetch_assoc($runcmd);
      $_SESSION['rname']=$data['username'];
      // $r=rand(111111,999999);//generate OTP
     // $_SESSION['otp']=$r;
      $_SESSION['email']=$email;
      $_SESSION['token1']=TRUE;//generate token1 to track user alrady call for forgot pass
      $_SESSION['resend']=FALSE;
      include_once("php/sendOTP.php");//genarate password
      // header("location:validateOTP.php");
    }else
      {
          $notfound=TRUE;
      }
}


 ?>
<!-- phpcode ends here............................................................................................... -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Videologic-service-Forgotpassword</title>
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

         <form class="form-container shadow" action="forgotpass.php" method="post">
           <div class="form-group">
             <h3 class="text text-primary text-center ">Forgot Password</h3>
           </div>
           <br>
           <div class="form-group">
               <label for="exampleInputEmail1">Email address</label>
               <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
           </div>
           <small class="text-danger">* OTP will send to your Registered email.</small>
         <br><br><br><br>
        <button type="submit" name="reset" class="btn btn-primary  btn-block">Request OTP</button>
        <br>

          <?php if ($notfound) {
      echo '<p class="alert alert-danger role=alert">User not registered ! Please ensure to enter your rgistered email id.</p>';
        }  ?>

          <p class="text-center"><a href="index.php">Back to Login -></a></p>

                        </form>
                      </section>
                  </section>
                </section>

  <!-- forgot pass form end here.................................................................... -->
<br><br><br><br><br><br><br><br>














<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
  <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
 <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
