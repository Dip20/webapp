<?php
session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);



// user not loged in or not
if (empty($_SESSION['user']))
{
  $is_loged=FALSE;
}else {
  $is_loged=TRUE;
}



if (isset($_POST['search-again']))
{
  unset($_SESSION['searchid']);//unset session variable.
  header("location:trace.php");
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
   <link rel="stylesheet" href="css/main.css">
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
                   <a class="dropdown-item" href="vcompletedjobs.php">View Completed Jobs</a>
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
<br>
<!-- content for body starts here -->



<div class="container-sm">
    <div class="row  justify-content-center border pt-2 pb-2">
        <div class="col-sm-6" id="notfound">
            <h3 class="text text-danger mt-2"> <img src="images/searchicon.png" alt="search-icon"> Job No <?php echo $_SESSION['searchid']; ?>, Not Found </h3>
            <small class="text">Jobno not found in database, Please search again with valid Jobno.</small><br><br>
            <form class="form-group" action="search-not-found.php" method="post">
                <input type="submit" name="search-again" value="Search Again" class="btn btn-outline-primary my-2 my-sm-0">

            </form>
        </div>
        <div class="col">
            <img src="images/folder.png" alt="folder-image" class="card-img">
        </div>
    </div>
</div>





























<br><br><br><br><br><br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
  <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
 <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
