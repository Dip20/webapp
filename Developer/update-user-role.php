<?php
session_start();
require_once("../php/connection.php");
require_once("../php/info.php");
// error_reporting(0);

$error=FALSE;
$_SESSION['denied']=FALSE;

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

// fetch username  from database for search user ..................
$cmd="SELECT * FROM tbl_login";
$runcmd=mysqli_query($conn,$cmd);


// fetch result after search button click..................
if (isset($_POST['search-user']))
{
  // assign variable
  $search_user=$_POST['user'];

  $fetch="SELECT * FROM tbl_login WHERE username='$search_user'";
  $run=mysqli_query($conn,$fetch);

  if ($run)
  {
    $data1=mysqli_fetch_assoc($run);
    $_SESSION['del_index']=$data1['del_index'];//store del index of admin user


  }else {
    echo "Not Found";
  }
}


// onclick update user role................................
if (isset($_POST['update']))
{
  // assign variable
  $name=$_POST['user-name'];
  $email=$_POST['email'];
  $contact=$_POST['contact'];
  $user=$_POST['user-role'];
  $permission=$_POST['permission'];
  $block=$_POST['block'];
  $remarks=$_POST['remarks'];

  //no one can block DB admin and App admin ..here del_index is the key to identify weather block request for DB admin or app admin
   if ($block=="Yes" AND $_SESSION['del_index']=="FALSE")//mean user request to block DB admin or App admin
    {
         $_SESSION['denied']=TRUE;//denied msg true.
    }else {
      // update user role
      $update="UPDATE tbl_login SET contactno='$contact', userrole='$user', block='$block', remarks='$remarks', permission='$permission' WHERE Email='$email'";
      $cmd_update=mysqli_query($conn,$update);
      if ($cmd_update)
       {
        $success=TRUE;//updated successfully

        //user activiry tracker
       $_SESSION['logkey']="6";
       $_SESSION['update-user']=$name;
       $_SESSION['update-status']=$block;
       $_SESSION['update-permission']=$permission;
       $_SESSION['update-role']=$user;
       include_once("../php/index.php");

      }else {
            $error=TRUE;//failed to update
            }
 }
}




//disable update permission if user has no access..............
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
    <li class="breadcrumb-item active" aria-current="page">Update user Role</li>
  </ol>
</nav>

<!-- if denied msg TRUE then show msg -->
<?php
if ($_SESSION['denied'])
 {
   echo  '<div class="alert alert-danger text-center" role="alert">Action Denied! you can not Block DB Admin or App Admin </div>';
   unset($_SESSION['denied']);
}

 ?>

<br>
<div class="container">
  <form class="form-inline justify-content-center" action="update-user-role.php" method="post">
  <div class="form-group mx-sm-4 mb-2">
    <select class="form-control" name="user" required>
      <option value="">--Select--</option>
        <?php
          while ($select_user=mysqli_fetch_assoc($runcmd))
          {
            $userdata=$select_user['username'];
            echo "<option>".$userdata."</option>";
          }
       ?>
    </select>

  </div>
  <button type="submit" name="search-user" class="btn btn-primary btn-sm mb-2">Search User</button>
</form>

<br>

  <form class="" action="update-user-role.php" method="post">
    <div class="row justify-content-center">
      <div class="col-sm-4">
        <label for="">Username</label>
        <input type="text" name="user-name" value="<?php echo $data1['username']; ?>" class="form-control" readonly>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
        <label for="">Email</label>
        <input type="email" name="email" value="<?php echo $data1['Email']; ?>" class="form-control" readonly>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
        <label for="">Contact No</label>
        <input type="text" name="contact" value="<?php echo $data1['contactno']; ?>" class="form-control" readonly>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
        <label for="">User Role</label>
        <select class="form-control" name="user-role">
          <option value="<?php echo $data1['userrole']; ?>"><?php echo $data1['userrole']; ?></option>
          <option value="admin">admin</option>
          <option value="user">user</option>
        </select>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
        <label for="">Permisson</label>
        <select class="form-control" name="permission">
          <option value="<?php echo $data1['permission']; ?>"><?php echo $data1['permission']; ?></option>
          <option value="Full">Full</option>
          <option value="Modify">Modify</option>
          <option value="View">View</option>
        </select>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
        <label for="">Block</label>
        <select class="form-control" name="block">
          <option value="<?php echo $data1['block']; ?>"><?php echo $data1['block']; ?></option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
        <label for="">Remarks</label>
        <input type="text" name="remarks" value="<?php echo $data1['Remarks']; ?>" class="form-control">
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-sm-4">
      <button type="submit" name="update" class="btn btn-md btn-primary" <?php echo $access; ?>>Update</button>
      </div>
    </div>


  </form>
</div>

<?php
if ($success)
{

  //assign the msg for the modal
  $MSG="User Role for: " .$name. ", Updated successfully";
  //call modal for thanks msg.............................................
  echo "<script type=text/javascript> $(document).ready(function()
  {
  $('#exampleModalCenter').modal('show');
  });</script>";
  //call modal for thanks msg.............................................

}

if ($error)
{

  //assign the msg for the modal
  $MSG="Unable to Update User Role, Server not responding.<br> Try again later.";
  //call modal for Error msg.............................................
  echo "<script type=text/javascript> $(document).ready(function()
  {
  $('#exampleModalCenter').modal('show');
  });</script>";
  //call modal for Error msg.............................................


}


 ?>


<!-- Modal  place here.............................-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update User Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <?php echo $MSG ; //call the value ?>
      </div>
      <div class="modal-footer">
        <a href="index.php" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>














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
