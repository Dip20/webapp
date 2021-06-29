
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

// browse data for dropdown of select technician.....................
$cmd="SELECT * FROM  tbl_technician";                              //
$run=mysqli_query($conn,$cmd);                                    //
// ...................................................................



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videologic-service-Developer</title>
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

<div class="container">
    <div class="header">
      <h3 class="text text-primary text-center pt-2">Report Output</h3><hr>
    </div>

    <form class="form-inline" action="output.php" method="post">

      <label for="">Date From</label>
      <input type="date" name="dt_f" value="" class="form-control" required>
      <label for="">Date To</label>
      <input type="date" name="dt_t" value="" class="form-control" required>

      <label for="">Technician</label>
      <select name="technician" class="form-control" id="exampleFormControlSelect1" required>
        <option></option>
          <?php
            while ($data=mysqli_fetch_assoc($run)) {
              $tech=$data['name'];
              echo "<option>".$tech."</option>";
            }
         ?>

      </select>


      <label for="">Job Status</label>
      <select name="status1" class="form-control" id="exampleFormControlSelect1" required>
        <option></option>
        <option value="pending">pending</option>
        <option value="completed">completed</option>
        <option value="replace">replace</option>
      </select>

      <button type="submit" name="load" class="btn btn-primary btn-sm ml-1" id="btn-submit">Load Report</button>
    </form><hr>
  </div>





<!-- result table starts here................................ -->

<?php
$data_found=FALSE;

if (isset($_POST['load']))
{

  // assign variable
  $df=$_POST['dt_f'];
  $dt=$_POST['dt_t'];
  $status1=$_POST['status1'];
  $technician=$_POST['technician'];
  ?>

  <div class="container shadow">
  <p class="text text-center pb-1 text-muted">  Showing Result <?php echo "From-" . $df; echo " To-" . $dt; echo ",  Technician- " .$technician ; echo ",  Status- " . $status1; ?> </p>
  </div>

    <br><br>


  <?php

    $sql="SELECT * FROM tbl_complain WHERE complaindate BETWEEN '$df' AND '$dt' AND status='$status1' AND technicianassigned='$technician'";
    $runsql=mysqli_query($conn,$sql);
    $resultsql=mysqli_num_rows($runsql);

$_SESSION['export']=$sql;//assign session variable for export data
$_SESSION['export-name']="Output";

    if ($resultsql!=0)
    {
        $data_found=TRUE;
    }else
      {
      // header("location:search-not-found.php");
      }
}
  if ($data_found)
  {

  ?>


  <div class="info pl-2">
      <p class="text">Total Record: <strong><?php echo $resultsql; ?></strong> </p>
  </div>

  <!-- display data here -->
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Job ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Address</th>
        <th scope="col">Product</th>
        <th scope="col">Probelm Details</th>
        <th scope="col">Technician</th>
        <th scope="col">Status</th>
        <!-- <th scope="col">Action</th> -->
      </tr>
    </thead>
    <tbody>
      <tr>


  <?php   while ($result=mysqli_fetch_assoc($runsql))
  {

  if ($result['status']=="completed")
   {
    $btn_color="text-success";

  }elseif ($result['status']=="replace") {
    $btn_color="text-success";
  }
  else {
    $btn_color="text-danger";
  }

  ?>

        <td  data-label="Date" scope="col"><?php echo $result['complaindate']; ?></td>
        <td  data-label="Job No" scope="col"><?php echo $result['jobno']; ?></td>
        <td  data-label="Customer Name" scope="col"><?php echo $result['customername']; ?></td>
        <td  data-label="Address" scope="col" title="<?php echo $result['customeraddress']; ?>"><?php echo $result['customeraddress']; ?></td>
        <td  data-label="Product" scope="col" title="<?php echo $result['productname']; ?>"><?php echo $result['productname']; ?></td>
        <td  data-label="Problem" scope="col" title="<?php echo $result['probelmdetails']; ?>"><?php echo $result['probelmdetails']; ?></td>
        <td class="text text-primary" data-label="Technician" scope="col"><?php echo $result['technicianassigned']; ?></td>
        <td class="text <?php echo $btn_color; ?>" data-label="Status" scope="col"><?php echo $result['status']; ?></td>
        <!-- <td  data-label="Action" scope="col"> <a href="search-view.php?<//?php echo "jb=$result[jobno]";?>">View Details</a></td> -->
      </tr>
  <?php

  }
  }

  ?>
    </tbody>
  </table>




<br><br>
<?php
if ($data_found)
{
  echo '<div class="container text-center">
    <a href="export/export-output.php" class="btn btn-primary text-center">Export</a>
  </div>';

}else {
  echo '<p class="text text-center">No Data Found</p>';
} ?>



















<style media="screen">
  label{
    padding-left: 5px;
    padding-right: 5px;
  }

  /* media query for mobile device */
  @media (max-width: 762px) {
    #btn-submit{
      display: block;
      width: 100%;
      margin-top: 10px;
      margin-left: 0;
  }

  }
</style>









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
