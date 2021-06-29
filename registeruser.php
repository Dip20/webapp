<?php
 session_start();
require_once("php/connection.php");
require_once("php/info.php");
error_reporting(0);
$success=FALSE;

// user not loged in or not
if (empty($_SESSION['user']))
{
  $is_loged=FALSE;
}else {
  $is_loged=TRUE;
}


// fetch settings weather registration is blocked or not!
$cmdsetting="SELECT * FROM tbl_settings WHERE action='register_user'"; //fetch data
$runcmdsetting=mysqli_query($conn,$cmdsetting);
$settings=mysqli_fetch_assoc($runcmdsetting);//tbl_settings data

if ($settings['attributes']=="YES")
{
    $disable="Disabled";
}else {

    $disable="";
}


//register user
if (!empty($_POST['name']))
{

  if (isset($_POST['register']))
  {
    // assign variable
    $name=$_POST['name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $conpass=$_POST['conpass'];
    $userrole="user";
    $permission="View";
    $block="No";

    // check user email alrady registered or not?
    $check_email="SELECT * FROM tbl_login WHERE Email='$email'";
    $runcmd2=mysqli_query($conn,$check_email);
    $getresult=mysqli_num_rows($runcmd2);
    if ($getresult>0)
    {
      $error="User alrady registered.";
    }else
     {

    // check weather pass and conpass are Same
    if ($pass==$conpass)
     {
        $password=md5($pass);

        $cmd="INSERT INTO tbl_login (username,password,Email,contactno,userrole,permission,block) VALUES
        ('$name','$password','$email','$contact','$userrole','$permission','$block')";
        //insert same data into tbl_technician
        $cmd1="INSERT INTO tbl_technician (name,contactno,emailid) VALUES
        ('$name','$contact','$email')";

        $runcmd=mysqli_query($conn,$cmd);
        $runcmd1=mysqli_query($conn,$cmd1);

        if ($runcmd)
        {
              if ($runcmd1)
              {
                $success=TRUE;
              }else
              {
                $success=FALSE;
              }
        }else
        {
            $error="Failed to Registered,Server Error";
        }

    }else
      {
        $error="'Confirm password' & 'Password' Both should same!";
      }
    }
  }
}
 ?>


<!-- phpcode ends here............................................................................................... -->


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Videologic-service-register</title>
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

<!-- content for body starts here -->

 <!--here is login form-->
<br>
 <section class="container-fluid">
   <section class="row justify-content-center">
       <section class="col-12 col-sm-10 col-md-4">

         <form class="form-container shadow border" action="registeruser.php" method="post">
           <div class="form-group">
             <h3 class="text text-primary text-center ">Register</h3>
           </div>
           <div class="form-group">
               <label for="exampleInputEmail1">Name</label>
               <input type="text" name="name" class="form-control"  placeholder="Enter Your Name" required>
           </div>
           <div class="form-group">
               <label for="exampleInputEmail1">Contact No</label>
               <input type="text" name="contact" class="form-control"  placeholder="Enter Your Contact No" required maxlength="10">
           </div>
           <div class="form-group">
               <label for="exampleInputEmail1">Email address</label>
               <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
               <small class="text text-dark">Please ensure to enter valid email, This will use for your login </small>
           </div>
           <div class="form-group">
               <label for="exampleInputPassword"> Create Password</label>
               <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Create Password" required>
           </div>
           <div class="form-group">
               <label for="exampleInputPassword"> Confirm Password</label>
               <input type="password" name="conpass" class="form-control" id="exampleInputPassword1" placeholder="Enter Same Password" required>
           </div>
           <br>
               <button type="submit" name="register" class="btn btn-primary  btn-block" <?php echo $disable; ?>>Register</button>
             <br>
               <!-- display login failed msg -->
                                <?php
                                if (empty($error)) {
                                  #code here....
                                } else {
                                  echo '<p class="alert alert-danger text-center" role="alert">'.$error.'</p></div>'; //show error msg
                                }
                                ?>
              <p class="text-center"><a href="index.php">alrady registered? login here -></a></p>
        </form>
      </section>
  </section>
</section>


<?php
if ($success) {

$MSG1="Registered successfully. <br> Please login with your credientials to access videologic application.";

 //call modal for thanks msg.............................................
 echo "<script type=text/javascript> $(document).ready(function()
 {
 $('#exampleModalCenter').modal('show');
 });</script>";
 //call modal for thanks msg.............................................



}

?>

<!-- Modal  place here.............................-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <?php echo $MSG1; ?>
      </div>
      <div class="modal-footer">
         <a href="index.php" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal  Ends here.............................-->




<br><br><br><br><br>
<!-- app version -->
<p class="text-center"><?php echo $appversion; ?></p>
  <br><br>

<!-- footer starts here -->
<div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
 <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
</div>
</body>
</html>
