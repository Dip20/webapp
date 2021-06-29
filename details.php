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


//get job no
$jn=$_GET['jb'];

// browse data for dropdown of select technician

$cmd="SELECT * FROM  tbl_complain where jobno='$jn'";
$run=mysqli_query($conn,$cmd);
if ($view=mysqli_fetch_assoc($run)) {

    $jobno=$view['jobno'];
    $date=$view['complaindate'];
    $status=$view['status'];
    $updatetime=$view['statustime'];
    $name=$view['customername'];
    $contact=$view['contactno'];
    $address=$view['customeraddress'];
    $pin=$view['customerpincode'];
    $landmark=$view['customerlandmark'];
    $delar=$view['delarname'];
    $product=$view['productname'];
    $model=$view['productmodelno'];
    $problem=$view['probelmdetails'];
    $technician=$view['technicianassigned'];
    $remarks=$view['remarks'];
    $serial=$view['serialno'];
}

//delete button onclick
if (isset($_POST['delete'])) {
    $_SESSION['deleteID']=$jobno;
    header("location:php/delete.php");
}

//onclick home button
if (isset($_POST['home'])) {
  header("location:admin.php");
}
//onclick Update
if (isset($_POST['update'])) {
//delcear variables
$status_upload=$_POST['status'];
$serial_upload=$_POST['serial'];
$remarks_upload=$_POST['remarks'];

$ctime=date("d-m-yy") . " , " .  date("h:i:s-a");

//write sql query to update status
$cmdupdate="UPDATE tbl_complain set jobno='$jobno', serialno='$serial_upload', status='$status_upload', remarks='$remarks_upload' , statustime='$ctime' WHERE jobno='$jobno'";
$run_cmdupdate=mysqli_query($conn,$cmdupdate);
if ($run_cmdupdate)
 {
  // echo "Updated: " . $status_upload;
  header("location:admin.php");
}else {
  echo "Failed to update status: " . $cmdupdate . $conn->error;
}

}


// disable delete button if user have no access permission.
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
    <title>Videologic-service</title>
      <!-- Bootstrap link -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="css/details.css">
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
          <button  type="submit"  name="home" class="btn btn-secondary" id="btn-home">Home</button>
           <a href="Developer/technician-info.php" class="btn btn-info">Technician Info</a>
      </form>
  </div>
</center>


<!-- forms and  data here -->
<br>
<hr>
<section class="container-fluid shadow">
  <h4 class="text text-secondary text-center">View complain details</h4>
  <br>
  <form action="" method="post">
    <div class="form-row">
    <div class="form-group col-sm-3">
      <label for="">Job No</label>
      <input type="text" class="form-control" id="" required name="" disabled value="<?php echo $jobno;?>" title="<?php echo $jobno;?>">
    </div>
    <div class="form-group col-sm-3">
      <label for="">Complain Date</label>
      <input type="text" class="form-control" id="" required name="" disabled value="<?php echo $date;?>" title="<?php echo $date;?>">
    </div>

    <!-- get dropdown data of technician -->

    <div class="form-group col-sm-3">
        <label for="">Technician  Assign</label>
        <select class="form-control form-control" name=""  required disabled>
          <option><?php echo $technician;?></option>
        </select>
    </div>

    <div class="form-group col-sm-3">
      <label for="">Last Update</label>
      <input type="text" class="form-control" id="" required name="" disabled value="<?php echo $updatetime;?>" title="<?php echo $updatetime;?>">
    </div>
    </div>

<div class="form-row">
<div class="form-group col-sm-3">
  <label for="">Customer Name</label>
  <input type="text" class="form-control" id="" required name="name" disabled value="<?php echo $name;?>" title="<?php echo $name;?>">
</div>
<div class="form-group col-sm-3">
  <label for="">Contact NO</label>
  <input type="text" class="form-control" id="" required name="contact" disabled value="<?php echo $contact;?>" title="<?php echo $contact;?>">
</div>
<div class="form-group col-sm-3">
  <label for="">Address</label>
  <input type="text" class="form-control" id="" required name="address" disabled value="<?php echo $address;?>" title="<?php echo $address;?>" title="<?php echo $address;?>">
</div>
<div class="form-group col-sm-3">
  <label for="">Pincode</label>
  <input type="text" class="form-control" id="" required name="pincode" disabled value="<?php echo $pin;?>" title="<?php echo $pin;?>">
</div>
</div>

<div class="form-row">
  <div class="form-group col-sm-3">
    <label for="">Landmark</label>
    <input type="text" class="form-control" id="" required name="landmark" disabled value="<?php echo $landmark;?>" title="<?php echo $landmark;?>">
  </div>
  <div class="form-group col-sm-3">
    <label for="">Delare Name</label>
    <input type="text" class="form-control" id="" required name="delarname" disabled value="<?php echo $delar;?>" title="<?php echo $delar;?>">
  </div>
  <div class="form-group col-sm-3">
    <label for="">Product Name</label>
    <input type="text" class="form-control" id="" required name="productname" disabled value="<?php echo $product;?>" title="<?php echo $product;?>">
  </div>
  <div class="form-group col-sm-3">
    <label for="">Product Model NO</label>
    <input type="text" class="form-control" id="" required name="model" disabled value="<?php echo $model;?>" title="<?php echo $model;?>">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-sm-3">
      <label for="">Problem Details</label>
      <input type="text" class="form-control" id="" required name="" disabled value="<?php echo $problem;?>"  title="<?php echo $problem;?>">
  </div>
  <div class="form-group col-sm-3">
    <label for="">Status</label>
    <select class="form-control form-control" name="status"  required>
      <option selected><?php echo $status;?></option>
      <option>completed</option>
      <option>pending</option>
      <option>replace</option>
    </select>
  </div>

  <div class="form-group col-sm-3">
    <label for="">Serial</label>
    <input type="text" class="form-control" id="" name="serial"  value="<?php echo $serial;?>">
  </div>

  <div class="form-group col-sm-3">
    <label for="">Remarks</label>
    <input type="text" class="form-control" id="" name="remarks"  value="<?php echo $remarks;?>">
  </div>
</div>

    <input type="submit" name="update" value="Update Status" id="btn-details" class="btn btn-primary">
    <input type="submit" name="delete" value="Delete" id="btn-details" class="btn btn-danger" <?php echo $access; ?>>
<br><br>
  </form>
</section>
<br>

















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
