<?php
session_start();
require_once("../php/connection.php");
require_once("../php/info.php");
error_reporting(0);

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
$query="SELECT * FROM tbl_login ORDER BY id ASC";
$run_query= mysqli_query($conn,$query);
$result=mysqli_num_rows($run_query);
$count=0;

//asign a variable to count serial note
$_SESSION['export']=$query;//assign session variable for export data
$_SESSION['export-name']="User Details(Admin-view)";








//disable Delete permission if user has no access..............
$permission=$_SESSION['permission'];
if ($permission=="Modify" OR $permission=="View")
{
$access="disabled";
}



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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">View User</li>
  </ol>
</nav>

<?php
if (empty($_SESSION['del_error']))
{
}else {
  echo  '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['del_error']. '</div>';

}

?>

<?php

unset($_SESSION['del_error']);

 ?>




<div class="container text-center">
  <h4> View User</h4>
</div>

<!-- display total  activity -->
<p class="text text-right pr-3" >Total User: <strong> <?php echo $result;?></strong></p>

<!-- here is activity table -->

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Contact NO</th>
      <th scope="col">User Role</th>
      <th scope="col">Permission</th>
      <th scope="col">Block</th>
      <th scope="col">Remarks</th>
      <th scope="col">Action</th>
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
      <td  data-label="Email" scope="col"><?php echo $data['Email']; ?></td>
      <td  data-label="Contact NO" scope="col"><?php echo $data['contactno']; ?></td>
      <td  data-label="User Role" scope="col" title="<?php echo $data['userrole']; ?>"><?php echo $data['userrole']; ?></td>
      <td  data-label="Permission" scope="col" title="<?php echo $data['permission']; ?>"><?php echo $data['permission']; ?></td>
      <td  data-label="Block" scope="col" title="<?php echo $data['block']; ?>"><?php echo $data['block']; ?></td>
      <td  data-label="Remarks" scope="col" title="<?php echo $data['Remarks']; ?>"><?php echo $data['Remarks']; ?></td>
      <td data-label="Action"><a href="delete-user.php?em=<?php echo $data['Email'];?>"  class="btn btn-sm btn-danger <?php echo $access; ?>">Delete</a>

</td>

      </tr>
<?php

    }
}

?>



  </tbody>
</table>
<br>




















<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
