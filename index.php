 <?php
 session_start();
 require_once("php/connection.php");
 require_once("php/info.php");
 error_reporting(0);


// login code here..........................................
 if (empty($_POST['email']))
 {
 //check weather user entered email
 }else
 {
   if (isset($_POST['login']))
   {
     //Assign form data in variable
     $email=$_POST['email'];
     $pass=md5($_POST['pass']);
     $error;

     //write sql query
     $sql="SELECT * FROM tbl_login WHERE email='$email'";
     $run=mysqli_query($conn,$sql);
     $data=mysqli_fetch_assoc($run);

// check weather user blocked or not?
  $block=$data['block'];
  if ($block=='Yes')
  {
    $error="Login Block! Contact Admin.";
    $is_loged=false;
  }else
  {
      //check weather username and password is correct or not
      if ($pass==$data['password'])
       {
        //condition match,code here for next process
        $_SESSION['user']=$data['username'];
        $_SESSION['role']=$data['userrole'];//assign the user role in session variable
        $_SESSION['permission']=$data['permission'];
        $_SESSION['redirect']=$data['admin_redirect'];
        $is_loged=true;//variable for check user loged in

        //user activiry tracker
         $_SESSION['logkey']="1";
         include_once("php/index.php");

         // redirect to page based on user access
          if ($_SESSION['role']=="admin")
          {
              // if DB admin redirect to developer pannel
              if ($_SESSION['redirect']=="server")
              { header("location:Developer/index.php");
              }else { header("location:admin.php");
              }

          }else
          {
             header("location:user.php");
          }
       }else
         {
           //login failed, code here for next process
           $error="Login failed, wrong credientials";
           $is_loged=false;
       }
    }
  }
}
 // login code end here/.................................


 //redirect if page request
if (empty(($_SESSION['user'])))
{
  //nothing
}else
{
 // redirect to page based on user access
  if ($_SESSION['role']=="admin")
  {
      // if DB admin redirect to developer pannel
      if ($_SESSION['redirect']=="server")
      { header("location:Developer/index.php");
      }else { header("location:admin.php");
      }

  }else
  {
     header("location:user.php");
  }
}



?>

<!-- phpcode ends here............................................................................................... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Videologic WebApplication ">
    <meta name="author" content="Videologic Service">
    <title>Videologic-service</title>
      <!-- Bootstrap link -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="css/main.css">


	<!--push notification-->



</head>
    <!-- js link -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- js link ends here -->

<body>




  <!-- particles.js container -->
  <div id="particles-js"></div>
<?php include_once("particle/particle-link.php"); ?>


<!-- nav bar starts here -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark  navbar sticky-top">
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

<!--here is login form-->
<br><br>
<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-10 col-md-4">
          <form class="form-container shadow" action="index.php" method="post">
            <div class="form-group">
              <h2 class="text text-primary text-center ">Login</h2>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <br><br>
                <button type="submit" name="login" class="btn btn-primary  btn-block">Login</button>
              <br>
                <!-- display login failed msg -->
                                 <?php
                                 if (empty($error))
                                  {
                                   #code here....
                                  } else
                                  {
                                   echo '<p class="alert alert-danger role=alert text-center">'.$error.'</p>';
                                  }
                                  ?>
  <p class="text-center"><a href="forgotpass.php">Forgot password?</a></p>
         </form>
       </section>
   </section>
 </section>
 <!-- login form end here.................................................................... -->




<br><br><br>
 <p class="text-center text-white"><?php echo $appversion; ?></p>
 <br><br><br><br><br><br>
 <!-- Footer -->
 <div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
   <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>
 </div>

</body>
</html>
