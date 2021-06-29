<?php
session_start();
require_once("../php/connection.php");
require_once("../php/info.php");
// error_reporting(0);

$error=FALSE;

//page redirect if user not loged in
if (empty($_SESSION['user'])) {
  header("location:../index.php");
}else {
  $is_loged=False;
}

//page restricted
if ($_SESSION['role']=="user") {
    header("location:../user.php");
}

// here is sql query to execute table data
$query="SELECT * FROM tbl_activity ORDER BY id DESC";
$run_query= mysqli_query($conn,$query);
$result=mysqli_num_rows($run_query);
$count=0;

//asign a variable to count serial note
$_SESSION['export']=$query;//assign session variable for export data
$_SESSION['export-name']="Activity(Admin-view)";



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videologic-service-Developer</title>
      <!-- Bootstrap link -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="../css/admin.css">
</head>
    <!-- js link -->
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- js link ends here -->

<body>


<!-- nav bar starts here -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar  ">
  <a class="navbar-brand" href="index.php">Videologic Service</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../trace.php">Trace Job</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../addcomplain.php">Add complain</a>
          <a class="dropdown-item" href="../admin.php">View Pending Jobs</a>
          <a class="dropdown-item" href="../vcompletedjobs-admin.php">View Completed Jobs</a>
          <a class="dropdown-item" href="technician-info.php">Technician Info</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../dashboard.php">Dashboard</a>
          <a class="dropdown-item" href="../output.php">Reports</a>

        </div>
      </li>
      <!--here is the link for login and display username is alrady loged in-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php echo $_SESSION['user'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../changepass.php">Change Password</a>
          <a class="dropdown-item" href="index.php">Server Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../php/logout.php">Logout</a>
        </div>
      </li>
    </ul>

  </div>
</nav>
<!-- Nav close here -->

<!-- content for body starts here -->

<div class="admin-pannel">
  <marquee><p>Welcome <?php echo $_SESSION['user'] . " , "; ?> to  Videologic Developer pannel &nbsp; || &nbsp; User role: <?php echo $_SESSION['role'] . " , "; ?> Today: <?php echo Date("d/m/yy"); ?> </p></marquee>
</div>


<nav aria-label="breadcrumb" id="top">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Activity</li>
  </ol>
</nav>
<!-- display total  activity -->
<p class="text text-right pr-3" >Total Activity: <strong> <?php echo $result;?></strong> &nbsp; <span> <a href="#export">END-></a></span> </p>

<!-- here is activity table -->

<table id="example" class="display table table-hover table-striped" width="100%" data-page-length="10" data-order="[[ 1, &quot;asc&quot; ]]">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">User Access</th>
      <th scope="col">Action</th>
      <th scope="col">Remarks</th>
      <th scope="col">Time Stamp</th>
    </tr>
  </thead>

  <tbody>
    <tr>
<?php

if ($result!=0)
{
  while ($data=mysqli_fetch_assoc($run_query))
    { $count=$count+1;

 ?>



      <td  data-label="#" scope="col"><?php echo $count; ?></td>
      <td  data-label="Username" scope="col"><?php echo $data['username']; ?></td>
      <td  data-label="User Access" scope="col"><?php echo $data['useraccess']; ?></td>
      <td  data-label="Action" scope="col"><?php echo $data['action']; ?></td>
      <td id="remarks" data-label="Remarks" scope="col" title="<?php echo $data['remarks']; ?>"><?php echo $data['remarks']; ?></td>
      <td  data-label="Time Stamp" scope="col" title="<?php echo $data['timestamp1']; ?>"><?php echo $data['timestamp1']; ?></td>
      </tr>
<?php


      }
}

?>



  </tbody>
</table>
<br>
<hr><p class="text pl-3"><?php if ($result!=0) {echo "End of the result";} ?></p>
<h5 class="text text-right mr-3"><a href="#top" >^</a></h5>

<div class="container text-center" id="export">
  <a href="../export/export-activity.php" class="btn btn-primary text-center">Export</a>
</div>



<style media="screen">
@media (max-width: 600px) {

table td{
  padding-bottom: 10px;
}




}

</style>


















<!-- data table plugin -->
      <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css ">

      <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      } );
      </script>


<br><br><br><br><br><br><br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
   <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
  <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
