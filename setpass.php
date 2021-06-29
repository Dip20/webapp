<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);
//restrict page if token avail for reset Password then only access
if (empty( $_SESSION['token_setpass']))
{
  header("location:index.php");

}

//update password
if (isset($_POST['setpass'])) {
  //declear variable
$errormsg="";
$newpass=$_POST['newpass'];
$conpass=$_POST['conpass'];

//match confirm pass and new pass
if ($conpass==$newpass)
  {
    // code here for update password
    $updatepass=md5($conpass);
    $updateemail=$_SESSION['email'];
    $cmd="UPDATE tbl_login set password='$updatepass' WHERE Email='$updateemail'";
    $runcmd=mysqli_query($conn,$cmd);
    if ($runcmd)
    {
      $success=true;//password changes successfull

    }else
        {
          echo "Failed to update pass" . $conn->error;
        }

// destroy all session and redirect to login page
session_unset();
session_destroy();

  }else
      {
        $errormsg="New Password And Confirm Password not Matched!";
      }
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videologic-service</title>
      <!-- Bootstrap link -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="css/changepass.css">
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
    </ul>

  </div>
</nav>
<!-- Nav close here -->

<!-- content for body starts here -->



<!-- changepassword form -->
<br><br>
<section class="container-fluid">
  <section class="row justify-content-center">
      <section class="col-12 col-sm-10 col-md-4">
        <form class="form-container" action="setpass.php" method="post">
          <div class="form-group">
            <h3 class="text text-primary text-center ">Set New Password</h3>
          </div>
          <div class="form-group">
              <label for="">User Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" disabled>
          </div>
          <div class="form-group">
              <label for="">New Password</label>
              <input type="text" name="newpass" class="form-control" placeholder="Create New Password" required autocomplete="off">
          </div>
          <div class="form-group">
              <label for="">Confirm Password</label>
              <input type="text" name="conpass" class="form-control" placeholder="Enter Confirm Password" required autocomplete="off">
          </div>
          <br>
              <button type="submit" name="setpass" class="btn btn-primary  btn-block">Save Changes</button>
            <br>

              <!-- display login failed msg -->
                               <?php
                               if (empty($errormsg)) {
                               } else {
                                 echo "<div class=error><p class=text-center>".$errormsg."</p></div>"; //show error msg
                               }
                               ?>
       </form>
     </section>
 </section>
</section>

<br><br><br>



<?php
if ($success) {

$MSG1="Password Reset successfully <br> Please login with your New Password";

 //call modal for thanks msg.............................................
 echo "<script type=text/javascript> $(document).ready(function()
 {
 $('#exampleModalCenter').modal('show');
 });</script>";
 //call modal for thanks msg.............................................



}

 ?>




<!-- Modal  place here.............................-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Password Changed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <?php echo $MSG1; ?>
      </div>
      <div class="modal-footer">
         <a href="index.php" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal  Ends here.............................-->


<br><br><br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
   <br><br>
<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
  <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
