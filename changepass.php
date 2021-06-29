<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);

//page redirect if user not loged in
if (empty($_SESSION['user'])) {
  header("location:index.php");
  $is_loged=FALSE;
}else {
  $is_loged=TRUE;
}


//change password
if (isset($_POST['change'])) {
  //declear variable
$errormsg="";
$oldpass=md5($_POST['oldpass']);
$newpass=$_POST['newpass'];
$conpass=$_POST['conpass'];

//match confirm pass and new pass
if ($conpass==$newpass)
  {
    //sql query to check password
    $cmd="SELECT * FROM tbl_login where username='$_SESSION[user]'";
    $runcmd=mysqli_query($conn,$cmd);
    $data=mysqli_fetch_assoc($runcmd);
      if ($runcmd)
     {
        //store old password
        $oldpass_db=$data['password'];
      }

    if ($oldpass_db==$oldpass)
    {
      //old pass vs db old pass matched so go for update new passdowd
      $updatepass=md5($newpass);
      $cmdupdate="UPDATE tbl_login set username='$_SESSION[user]', password='$updatepass' WHERE username='$_SESSION[user]'";
      $runupdate=mysqli_query($conn,$cmdupdate);
        if ($runupdate)
        {
          //password changed successfully set success for call modal in next process
          //next process display modal is inside html
          $success=true;

        }else
            {
              $errormsg="Failed to Change Password";
            }
    }else
       {
        $errormsg="Old Password Not matched !";
        }
  }
  else
  {
  $errormsg="New password and Confirm password not matched";
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

<?php if ($is_loged)
{
          echo' <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Menu
               </a>';
}?>
               <?php if ($_SESSION['role']=='user')
               {

             echo  '<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="user.php">view Pending Jobs</a>
                   <a class="dropdown-item" href="vcompletedjobs-user.php">View completed Jobs</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="output.php">Reports</a>
                 </div>';

               }else {

               echo '  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="addcomplain.php">Add complain</a>
                       <a class="dropdown-item" href="admin.php">View Pending Jobs</a>
                       <a class="dropdown-item" href="#">View Completed Jobs</a>
                       <a class="dropdown-item" href="#">Technician Info</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                       <a class="dropdown-item" href="output.php">Reports</a>

                     </div>';

               } ?>

             </li>
             <!--here is the link for login and display username is alrady loged in-->

              <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <?php echo $_SESSION['user'];?>
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="changepass.php">Change Password</a>

                 <?php if (!($_SESSION['role']=='user'))
                 { echo '<a class="dropdown-item" href="Developer/index.php">Server Settings</a>'; }?>

                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="php/logout.php">Logout</a>
               </div>
             </li>
      </ul>
  </div>
</nav>
<!-- Nav close here -->

<!-- content for body starts here -->

<div class="admin-pannel">
  <marquee><p>Welcome <?php echo $_SESSION['user'] . " , "; ?> to  Videologic admin pannel &nbsp; || &nbsp; User role: <?php echo $_SESSION['role'] . " , "; ?> Today: <?php echo Date("d/m/yy"); ?> </p></marquee>
</div>



<!-- changepassword form -->
<br>
<section class="container-fluid">
  <section class="row justify-content-center">
      <section class="col-12 col-sm-10 col-md-4">
        <form class="form-container" action="changepass.php" method="post">
          <div class="form-group">
            <h3 class="text text-primary text-center ">Change Password</h3>
          </div>
          <div class="form-group">
              <label for="">Old Password</label>
              <input type="text" name="oldpass" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Old password" required autocomplete="off">
          </div>
          <div class="form-group">
              <label for="">New Password</label>
              <input type="text" name="newpass" class="form-control" id="" placeholder="Create New Password" required autocomplete="off">
          </div>
          <div class="form-group">
              <label for="">Confirm Password</label>
              <input type="text" name="conpass" class="form-control" id="" placeholder="Enter Confirm Password" required autocomplete="off">
          </div>
          <br>
              <button type="submit" name="change" class="btn btn-primary  btn-block">Change Password</button>
            <br>
              <p class="text-center"><a href="index.php">Back to Home -></a></p>

              <!-- display login failed msg -->
                               <?php
                               if (empty($errormsg)) {
                                 #code here....
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

$MSG1="Password changed successfully <br> please login with your new password.";

 //call modal for thanks msg.............................................
 echo "<script type=text/javascript> $(document).ready(function()
 {
 $('#exampleModalCenter').modal('show');
 });</script>";
 //call modal for thanks msg.............................................

session_unset();
session_destroy();
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
