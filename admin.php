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
}else {
  // code...
}


// test

// onclick add new

if (isset($_POST['addnew'])) {
  header("location:addcomplain.php");
}


 // php code to display data
 // here is sql query to execute table data
 $query="SELECT * FROM tbl_complain WHERE status='pending' ORDER BY id DESC";
 $cmd= mysqli_query($conn,$query);
 $result=mysqli_num_rows($cmd);
//asign a variable to count serial note
$count=0;
$_SESSION['export']=$query;//assign session variable for export data
$_SESSION['export-name']="Pending jobs(Admin-view)";




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
  <marquee><p>Welcome <?php echo $_SESSION['user'] . " , "; ?> to  Videologic admin pannel &nbsp; || &nbsp; User role: <?php echo $_SESSION['role'] . " , "; ?> Today: <?php echo Date("d/m/yy"); ?> </p></marquee>
</div>

<center>
  <div class="menu-group">
      <form class="" action="admin.php" method="post">
          <button  type="submit"  name="addnew" class="btn btn-primary">AddNew Complain</button>
          <button  type="submit"  name="viewport" class="btn btn-secondary" id="btn-home">Home</button>
          <a href="Developer/technician-info.php" class="btn btn-info">Technician Info</a>
      </form>
  </div>
</center>

<br><br>
<!-- display total pending job -->
<p class="total" >Total Pending Jobs: <strong> <?php echo $result;?></strong></p>


<!-- display data here -->
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Job ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Address</th>
      <th scope="col">Product</th>
      <th scope="col">Probelm Details</th>
      <th scope="col">Technician</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
      <th scope="col"><input type="checkbox" name="" value=""></th>
    </tr>
  </thead>

  <tbody>
    <tr>
<?php

if ($result!=0)
{
        while ($data=mysqli_fetch_assoc($cmd)) {
          $count=$count+1;
 ?>

      <td  data-label="#" scope="col"><?php echo $count; ?></td>
      <td  data-label="Date" scope="col"><?php echo $data['complaindate']; ?></td>
      <td  data-label="Job No" scope="col"><?php echo $data['jobno']; ?></td>
      <td  data-label="Customer Name" scope="col"><?php echo $data['customername']; ?></td>
      <td  data-label="Address" scope="col" title="<?php echo $data['customeraddress']; ?>"><?php echo $data['customeraddress']; ?></td>
      <td  data-label="Product" scope="col" title="<?php echo $data['productname']; ?>"><?php echo $data['productname']; ?></td>
      <td  data-label="Problem" scope="col" title="<?php echo $data['probelmdetails']; ?>"><?php echo $data['probelmdetails']; ?></td>
      <td class="text text-primary" data-label="Technician" scope="col"><?php echo $data['technicianassigned']; ?></td>
      <td class="text text-danger" data-label="Status" scope="col"><?php echo $data['status']; ?></td>
      <td  data-label="Action" scope="col"> <a href="details.php?<?php echo "jb=$data[jobno]";?>">View Details</a></td>
      <td  data-label="Select" scope="col"> <input type="checkbox" name="" value=""> </td>
    </tr>
<?php

}
}

?>



  </tbody>
</table>
<br>
<hr><p class="text pl-3"><?php if ($result!=0) {echo "End of the result";} else{echo '<p class="text text-center">No Data Found</p>';}?></p>
<br>
<?php if ($result!=0) {echo '<div class="container text-center"> <a href="export/export-output.php" class="btn btn-primary text-center">Export</a></div>';} ?>


















<br><br><br><br><br><br><br><br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
   <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
  <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
