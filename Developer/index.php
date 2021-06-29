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

// redirect user based on button click
if (isset($_POST['adduser']))
{
  header("location:../registeruser.php");
}

// onclick add new

if (isset($_POST['addnew'])) {
  header("location:../addcomplain.php");
}

// onclick backup complain table
if (isset($_POST['btn-complain']))
{
  $_SESSION['export-name']="Backup complain(Admin-view)";
  $_SESSION['export']="SELECT * FROM tbl_complain";//assign session variable for export data
  header("location:../export/export-output.php");
}


// Disable register user........................................................
$cmd4="SELECT * FROM tbl_settings WHERE action='register_user'"; //fetch data
$runcmd4=mysqli_query($conn,$cmd4);
$data4=mysqli_fetch_assoc($runcmd4);//tbl_settings data


$btn_name=$data4['attributes'];
if ($btn_name=="YES")
{
    $temp="NO";
}else {
    $temp="YES";
}

if (isset($_POST['disable_register']))
{



    $cmdupdate="UPDATE tbl_settings SET attributes='$temp' WHERE action='register_user'";
    $runcmdupdate=mysqli_query($conn,$cmdupdate);
    if (!$runcmdupdate)
    {
      $error=TRUE;

    }
    //user activiry tracker
     $_SESSION['logkey']="5";
     $_SESSION['block-status']=$temp;
     include_once("../php/index.php");
//redirect page...................
    header("location:index.php");
}

// disable button color:
if ($temp=="NO")
{
  $btn_col="btn-danger";

}else {
  $btn_col="btn-warning";
}



// sql query to view table records...........................................
$cmd="SELECT * FROM tbl_complain";
$cmd1="SELECT * FROM tbl_login";
$cmd2="SELECT * FROM tbl_contact";
$cmd3="SELECT * FROM tbl_activity";
$cmd4="SELECT * FROM tbl_technician";

$runcmd=mysqli_query($conn,$cmd);
$runcmd1=mysqli_query($conn,$cmd1);
$runcmd2=mysqli_query($conn,$cmd2);
$runcmd3=mysqli_query($conn,$cmd3);
$runcmd4=mysqli_query($conn,$cmd4);

$data=mysqli_num_rows($runcmd); //tbl_complain records
$data1=mysqli_num_rows($runcmd1);//tbl_login records
$data2=mysqli_num_rows($runcmd2);//tbl_contact records
$data3=mysqli_num_rows($runcmd3);//tbl_activity records
$data4=mysqli_num_rows($runcmd4);//tbl_technician records
// ...........................................................................

//disable user access if user has no access permission........................
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
      <li class="nav-item active">
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
  <marquee><p>Welcome <?php echo $_SESSION['user'] . " , "; ?> to  Videologic Developer Panel &nbsp; || &nbsp; User role: <?php echo $_SESSION['role'] . " , "; ?> Today: <?php echo Date("d/m/yy"); ?> </p></marquee>
</div>


<div class="container bg-info text-white border pb-2 pt-2 text-center">
  <h3 class="text-center"><i>Dashboard</i></h3>
</div>

<div class="container  border pb-2 pt-2 text-center">
  <p class="text pl-3 d-inline"><i>Database Name:</i> <strong> <?php echo $database; ?> </strong> </p>
  <p class="text pl-3 d-inline"><i>Server Name:</i> <strong> <?php echo $servername; ?> </strong> </p>
  <p class="text pl-3 d-inline"><i>User Name:</i> <strong> <?php echo $username; ?> </strong> </p>
</div>

<div class="container bg-light pt-2 shadow border"><br>
  <div class="row">
    <div class="col-12 col-sm-12 col-md-4  ">
      <div class="header bg-danger py-1 text-center text-white"> <p class="pt-2"> <i>Database Information</i> </p> </div>
        <table class="table table-hover shadow pl-2" id="table2">
          <thead>
            <tr>
              <th data-label="Table name" scope="col">Table name</th>
              <th data-label="#" scope="col">Records</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row">tbl User</td>
              <td   scope="row"><strong><?php echo $data1; ?></strong></td>
            </tr>
            <tr>
              <td scope="row">tbl technician</td>
              <td  scope="row"><strong><?php echo $data4; ?></strong></td>
            </tr>
            <tr>
              <td scope="row">tbl Complain</td>
              <td   scope="row"><strong><?php echo $data; ?></strong> <span class="badge badge-secondary">New</span></td>
            </tr>
            <tr>
              <td scope="row">tbl Contact</td>
              <td  scope="row"><strong><?php echo $data2; ?> </strong> </td>
            </tr>
            <tr>
              <td scope="row">tbl activity</td>
              <td   scope="row"><strong><?php echo $data3; ?> </strong> <span class="badge badge-secondary">New</span></td>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="col-12 col-sm-12 col-md-4">
      <!-- Menus here -->
    <form class="" action="index.php" method="post">
      <div class="header bg-secondary py-1 text-center text-white"> <p class="pt-2"> <i>Shortcut Menus</i> </p> </div>
        <table class="table table-hover shadow pl-2" id="table2">
          <thead>
            <tr>
              <th>Menu</th>
              <th class="text pl-5">Link</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td>Add New User Login</td>
            <td class="text pl-5"><button type="submit" name="adduser" class="btn btn-primary btn-sm">GO</button> </td>
            </tr>
            <tr>
              <td>Update / Block User Login</td>
              <td class="text pl-5"><a href="update-user-role.php" class="btn btn-primary btn-sm">GO</a> </td>
            </tr>
              <tr>
                <td>Disable User Registration</td>
                <td class="text pl-5"><button type="submit" name="disable_register" class="btn <?php echo $btn_col; ?> btn-sm" <?php echo $access; ?>><?php echo $btn_name;?></button> </td>
              </tr>
            <tr>
            <td>Backup Complain tbl</td>
            <td class="text pl-5"><button type="submit" name="btn-complain" class="btn btn-primary btn-sm">GO</button> </td>
          </tr>
          <tr>

            </tbody>
          </table>
      </form>
    </div>
    <div class="col-12 col-sm-12 col-md-4">
      <!-- Menus here -->
    <form class="shadow" action="index.php" method="post">
      <div class="header bg-success py-1 text-center text-white"> <p class="pt-2"> <i>Shortcut Views</i> </p> </div>
        <table class="table table-hover pl-2" id="table2">
          <thead>
            <tr>
              <th>Menu</th>
              <th class="text pl-5">Link</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>View User Details</td>
              <td class="text pl-5"> <a href="view-user.php" class="btn btn-primary btn-sm">GO</a></td>
            </tr>
            <tr>
              <td>View Blocked User</td>
              <td class="text pl-5"> <a href="blocked-user.php" class="btn btn-primary btn-sm">GO</a></td>
            </tr>
            <tr>
              <td>View Activity List </td>
              <td class="text pl-5"> <a href="view-activity.php" class="btn btn-primary btn-sm">GO</a></td>
            </tr>
            <tr>
              <td>View Contact Request</td>
              <td class="text pl-5 "><a href="view-contact.php" class="btn btn-primary btn-sm">GO</a> </td>
            </tr>
        </tbody>
      </table>
    <!-- </div> -->
  </form>
</div>


  </div>
  <br>
</div>
<div class="container">
    <?php if ($error)
    {
      echo '<div class="alert alert-danger" role="alert">Failed to Update;</div>';
    } ?>
</div>
<br><br>

<!-- onpage style -->
<style media="screen">
.pd{

}


@media (max-width: 762px){
  table, .table{
    display: block;
    width: 100%;
  }
  td button{
  width: 100%;
  }

  p{
  text-align: center;
  }
  .container .btn{
    display: block;
    width: 50%;
    position: relative;
    left: 60px;

  }
  .container td{
    display: block;
    text-align:center;

  }
.table tr{
    border:none;

  }
  .pd{

  }
}
</style>





<br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
   <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
  <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
