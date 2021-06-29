<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);
$data_found=FALSE;



// user not loged in or not
if (empty($_SESSION['user']))
{
  $is_loged=FALSE;
}else {
  $is_loged=TRUE;
}



// search button click...................................
if (isset($_POST['search']))
{
  // assign variable
  $search=$_POST['search-job'];
  $_SESSION['searchid']=$search;

  $sql="SELECT * FROM tbl_complain WHERE jobno='$search'";
  $runcmd=mysqli_query($conn,$sql);
  $result=mysqli_num_rows($runcmd);

  if ($result!=0) {
      $data_found=TRUE;
  }else
    {
    header("location:search-not-found.php");
    }
}






?>

<!-- phpcode ends here............................................................................................... -->


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Videologic-service-Trace</title>
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
       <li class="nav-item">
         <a class="nav-link" href="contact.php">Contact</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#">About</a>
       </li>
       <li class="nav-item active">
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
         . $_SESSION[user].
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
<br><br><br>
<!-- content for body starts here -->
<div class="container mt-5">
  <div class="form-group">
    <h4 class="text-center text-primary">Search Job No</h4><br>
      <form class="form-group" action="trace.php" method="post">
        <div class="input-group mb-2 mr-sm-2 justify-content-center">
          <input type="text" name="search-job" class="form-control col-sm-6 text-center"  placeholder="Enter Job no Ex: ART051020203675" required>
          <input type="submit" name="search" value="Search" class="btn btn-primary input-group-prepend" id="btn-search">
        </div>
      </form>
    </div>
  </div>
</div>
<br><br>


<?php
if ($data_found)
{
  $data=mysqli_fetch_assoc($runcmd);
  // text color for status pending and completed...
  if ($data['status']=="completed")
   {
    $btn_color="text-success";

  }elseif ($data['status']=="replace") {
    $btn_color="text-success";
  }
  else {
    $btn_color="text-danger";
  }




 ?>

 <!-- display data here -->
 <table class="table table-striped table-hover">
   <thead>
     <tr>
       <th scope="col">Date</th>
       <th scope="col">Job ID</th>
       <th scope="col">Customer Name</th>
       <th scope="col">Address</th>
       <th scope="col">Probelm Details</th>
       <th scope="col">Technician</th>
       <th scope="col">Status</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
     <tr>


      <td  data-label="Date" scope="col"><?php echo $data['complaindate']; ?></td>
      <td  data-label="Job No" scope="col"><?php echo $data['jobno']; ?></td>
      <td  data-label="Customer Name" scope="col"><?php echo $data['customername']; ?></td>
      <td  data-label="Address" scope="col" title="<?php echo $data['customeraddress']; ?>"><?php echo $data['customeraddress']; ?></td>
      <td  data-label="Problem" scope="col" title="<?php echo $data['probelmdetails']; ?>"><?php echo $data['probelmdetails']; ?></td>
      <td class="text text-primary" data-label="Technician" scope="col"><?php echo $data['technicianassigned']; ?></td>
      <td class="text <?php echo $btn_color; ?>" data-label="Status" scope="col"><?php echo $data['status']; ?></td>
      <td  data-label="Action" scope="col"> <a href="search-view.php?<?php echo "jb=$data[jobno]";?>">View Details</a></td>
    </tr>

<?php
}
?>



  </tbody>
</table>
<br>




















<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
  <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
 <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
