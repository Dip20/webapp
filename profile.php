<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
//error_reporting(0);

$error=FALSE;

//page redirect if user not loged in
if (empty($_SESSION['user'])) {
  header("location:index.php");
}else {
  $is_loged=TRUE;
}



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videologic-service-Profile</title>
      <!-- Bootstrap link -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="css/admin.css">
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>

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
                <a class="dropdown-item" href="vcompletedjobs-admin.php">View Completed Jobs</a>
                <a class="dropdown-item" href="Developer/technician-info.php">Technician Info</a>
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
  <marquee><p>Welcome <?php echo $_SESSION['user'] . " , "; ?> to  Videologic pannel &nbsp; || &nbsp; User role: <?php echo $_SESSION['role'] . " , "; ?> Today: <?php echo Date("d/m/yy"); ?> </p></marquee>
</div>

<br><br><br>
<div class="container">
<div class="container">
  <div class="row shadow bg-dark pt-3 pb-3">
      <div class="col-sm-4"><!--Profile picture is displayed here.....-->
            <img src="images/photo.jpg" alt="" class="rounded-circle ml-4">

      </div>

      <div class="col-sm-4 border-left text-white"><!--here is information-->
        <h3>Santu sarkar</h3>
        <p class="font-weight-lighter">santusarkar2020@gmail.com <a href="#">Update</a></p>
        <p class="font-weight-lighter">Contact No: 8637554692 <a href="#">Update</a> </p>
        <p class="font-weight-lighter">Technician: Yes</p>

      </div>

      <div class="col-sm-4 border-left text-white"><!--here is information-->

        <p class="font-weight-lighter mt-4">Login ID: santusarkar2020@gmail.com</p>
        <p class="font-weight-lighter">User Role: Admin</p>
        <p class="font-weight-lighter">User Permission: Full</p>
        <p class="font-weight-lighter">Delete_index: TRUE</p>
      </div>
  </div>
</div>
</div>

<style media="screen">
p{
  font-family:calibri;
  letter-spacing: 1px;

}
  img{
    border:2px dotted white;
    border-radius: 50%;
    width: 200px;
    height: 200px;

  }


}

</style>
















<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
   <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
  <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
