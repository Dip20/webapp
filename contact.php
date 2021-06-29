<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
// error_reporting(0);

// user not loged in or not
if (empty($_SESSION['user']))
{
  $is_loged=FALSE;
}else {
  $is_loged=TRUE;
}


// send Message..........
if (isset($_POST['send']))
{
  // assign variable
  $name=$_POST['name'];
  $email=$_POST['email'];
  $contact=$_POST['contact'];
  $msg=$_POST['msg'];
  $send_time=date("d-m-yy") . " , " .  date("h:i:s-a");

  $send="INSERT INTO tbl_contact (name,email,contactno,message,timestamp1) VALUES ('$name','$email','$contact','$msg','$send_time')";
  $send_msg=mysqli_query($conn,$send);

  if ($send_msg)
  {

    $success=TRUE;
  }else {
    // echo "ERROR: " . $conn->error;
    $error=TRUE;
  }
}









?>

<!-- phpcode ends here............................................................................................... -->


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Videologic-service-Contact</title>
     <!-- Bootstrap link -->
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   <!-- custom css link -->
   <link rel="stylesheet" href="css/trace.css">
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
       <li class="nav-item">
         <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item active">
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
             <a class="dropdown-item" href="vcompletedjobs.php">View completed Jobs</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="output.php">Reports</a>
           </div>';

         }else {

         echo '  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="addcomplain.php">Add complain</a>
                 <a class="dropdown-item" href="admin.php">View Pending Jobs</a>
                 <a class="dropdown-item" href="vcompletedjobs-admin.php">View Completed Jobs</a>
                 <a class="dropdown-item" href="Developer/technician-info.php">Technician Info</a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                 <a class="dropdown-item" href="output.php">Reports</a>
               </div>';

         } ?>

       </li>
       <!--here is the link for login and display username is alrady loged in-->

<?php if ($is_loged)
{

echo '<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
         . $_SESSION["user"].
        '  </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="changepass.php">Change Password</a>';
} ?>

<?php
  if ($is_loged)
  {
     if (!($_SESSION['role']=='user'))
    { echo '<a class="dropdown-item" href="Developer/index.php">Server Settings</a>'; }
  }

if ($is_loged)
  {
  echo '<div class="dropdown-divider"></div>
      <a class="dropdown-item" href="php/logout.php">Logout</a>
    </div>
  </li>';

    }
?>

      </ul>
  </div>
</nav>
<!-- Nav close here -->

<!-- content for body starts here -->
<br>
<div class="container-fluid">
    <div class="col  mr-5">
      <h4 class="text text-center  pt-2  font-italic">Feel free to write us</h4>
      <form class="" action="contact.php" method="post">
        <div class="row justify-content-center">
          <div class="col-sm-4 pb-2">
            <label for="">Name</label>
            <input type="text" name="name" value="" class="form-control" placeholder="Enter your Name" required>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm-4 pb-2">
            <label for="">Email</label>
            <input type="email" name="email" value="" class="form-control" placeholder="example@xyz.com" required>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm-4 pb-2">
            <label for="">Contact No</label>
            <input type="text" name="contact" value="" class="form-control" placeholder="0123456789" required>
          </div>
        </div>
        <div class="row justify-content-center ">
          <div class="col-sm-4 pb-2">
            <label for="">Message</label>
            <textarea name="msg" rows="6" cols="32" class="form-control" placeholder="Enter your Message here.." required></textarea>
          </div>
        </div>
        <br>
        <div class="row justify-content-center">
          <div class="col-sm-4 pb-2">
            <button type="submit" name="send" class="btn btn-primary btn-md d-block" id="btn-send">Send</button>
          </div>
        </div>

        <br>
      </form>
    </div>
  </div>




<style media="screen">
@media (max-width: 600px)
{
  #btn-send{
    display: block;
    width: 100%;
  }
}
</style>


<?php
if ($success)
{

  //assign the msg for the modal
  $MSG="Thanks $name , for your Message. Your Words are valuable to us. <br> Our Support team will response you as soon as possible." ;
  //call modal for thanks msg.............................................
  echo "<script type=text/javascript> $(document).ready(function()
  {
  $('#exampleModalCenter').modal('show');
  });</script>";
  //call modal for thanks msg.............................................

}

if ($error)
{

  //assign the msg for the modal
  $MSG="Unable to Send Message, Server not responding.<br> Try again later.";
  //call modal for Error msg.............................................
  echo "<script type=text/javascript> $(document).ready(function()
  {
  $('#exampleModalCenter').modal('show');
  });</script>";
  //call modal for Error msg.............................................


}


 ?>


<!-- Modal  place here.............................-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Contact US</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <?php echo $MSG ; //call the value ?>
      </div>
      <div class="modal-footer">
        <a href="contact.php" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>



























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
