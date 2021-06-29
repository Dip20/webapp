<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);

//page redirect if user not loged in
if (empty($_SESSION['user'])) {
  header("location:index.php");
}else {
  $is_loged=true;
}

//page restricted
if ($_SESSION['role']=="user") {
    header("location:user.php");
}



// display Pending job info
$cmd="SELECT * From tbl_complain WHERE status='pending'";
$runcmd=mysqli_query($conn,$cmd);
if ($runcmd) {
  $pending=mysqli_num_rows($runcmd);
}

// display completed jobs
$m=date("yy-m-");
$df=$m . "01";
$dt=$m . "31";


$query="SELECT * from tbl_complain WHERE status='completed' AND complaindate BETWEEN '$df' AND '$dt' OR status='replace' ORDER BY complaindate";
$runcmd1=mysqli_query($conn,$query);
if ($runcmd1) {
  $completed=mysqli_num_rows($runcmd1);
}


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videologic-service-Dashboard</title>
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
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="addcomplain.php">Add complain</a>
          <a class="dropdown-item" href="admin.php">View Pending Jobs</a>
          <a class="dropdown-item" href="vcompletedjobs-admin.php">View Completed Jobs</a>
          <a class="dropdown-item" href="Developer/technician-info.php">Technician Info</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="dashboard.php">Dashboard</a>
          <a class="dropdown-item" href="output.php">Reports</a>

        </div>
      </li>
      <!--here is the link for login and display username is alrady loged in-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php echo $_SESSION['user'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="changepass.php">Change Password</a>
          <a class="dropdown-item" href="Developer/index.php">Server Settings</a>
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
  <marquee><p>Welcome <?php echo $_SESSION['user'] . " , "; ?> to  Videologic Admin pannel &nbsp; || &nbsp; User role: <?php echo $_SESSION['role'] . " , "; ?> Today: <?php echo Date("d/m/yy"); ?> </p></marquee>
</div>

<h3 class="text-center text-primary">Admin Dashboard</h3>
<br>
<center>
  <section class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-3 shadow-lg rounded py-5">
      <div class="card mb-3">
        <div class="card-body bg-danger text-white shadow-lg rounded">
          <h5 class="card-title">Total Pending Jobs</h5>
          <h4 class="card-text"><?php echo $pending; ?>  Jobs</h4>
          <a href="admin.php" class="btn btn-light btn-sm">View Details</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3 shadow-lg rounded py-5">
      <div class="card bg-info text-white shadow-lg rounded">
        <div class="card-body">
          <h5 class="card-title">Total Completed Jobs</h5>
        <h4 class="card-text"><?php echo $completed; ?>  Jobs</h4>
          <a href="vcompletedjobs-admin.php" class="btn btn-light btn-sm">View Details</a>
        </div>
      </div>
    </div>
  </div>
  <br>
</section>
</center>




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
