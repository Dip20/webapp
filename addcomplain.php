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


// browse data for dropdown of select technician
$cmd="SELECT * FROM  tbl_technician";
$run=mysqli_query($conn,$cmd);



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
      <link rel="stylesheet" href="css/addcomplain.css">
  </head>
      <!-- js link -->
      <script src="bootstrap/js/jquery.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <!-- js link ends here -->

      <!-- sweet alart script cdn -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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

<br>
  <!-- forms and  data here -->
  <br>
  <section class="container-fluid ">
      <h4 class="text text-white pt-2 pb-2 text-center bg-info">Add New complain</h4>
    <form action="addcomplain.php" method="post" class="shadow pl-2 pr-2">
      <div class="form-row">
        <div class="form-group col-sm-3">
          <label for="">Customer Name</label>
          <input type="text" class="form-control" id="" required name="name">
        </div>
        <div class="form-group col-sm-3">
          <label for="">Contact NO</label>
          <input type="text" class="form-control" id="" required name="contact" maxlength="10">
        </div>
        <div class="form-group col-sm-3">
          <label for="">Address</label>
          <input type="text" class="form-control" id="" required name="address">
        </div>
        <div class="form-group col-sm-3">
          <label for="">Pincode</label>
          <input type="text" class="form-control" id="" required name="pincode" maxlength="6">
        </div>
        </div>

      <div class="form-row">
        <div class="form-group col-sm-3">
          <label for="">Landmark</label>
          <input type="text" class="form-control" id="" required name="landmark">
        </div>
        <div class="form-group col-sm-3">
          <label for="">Delare Name</label>
          <input type="text" class="form-control" id="" required name="delarname">
        </div>
        <div class="form-group col-sm-3">
          <label for="">Product Name</label>
          <input type="text" class="form-control" id="" required name="productname">
        </div>
        <div class="form-group col-sm-3">
          <label for="">Product Model NO</label>
          <input type="text" class="form-control" id="" required name="model">
        </div>
      </div>

    <div class="form-row">
      <div class="form-group col-sm-3">
          <label for="">Problem Details</label>
          <input type="text" class="form-control" id="" required name="Problem">
      </div>
    <!-- get dropdown data of technician -->
    <div class="form-group col-sm-3">
        <label for="">Technician  Assign</label>
        <select class="custom-select" id="validationCustom04" name="technician" required>
          <option>
            <?php
              while ($data=mysqli_fetch_assoc($run)) {
                $tech=$data['name'];
                echo "<option>".$tech."</option>";
              }
           ?>
           </option>
        </select>
    </div>

    <div class="form-group col-sm-3">
      <label for="">Serial</label>
      <input type="text" class="form-control" id="" name="serial">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Remarks</label>
      <input type="text" class="form-control" id="" name="remarks">
    </div>
  </div>
    <div class="form-group">
      <input type="submit" name="addnew" value="Add Complain" class="btn btn-primary btn-sm" id="btn-addcomplain">

    </form><br><br>
  </div>
</section>
  <br>
<!-- php code here to add new contact -->
<?php
if (empty($_POST['addnew'])) {
  // code...
}else
 {
   if (isset($_POST['addnew']))
    {
      // generate random no
      $r=rand(1000,9999);
      //declear variables
      $name=$_POST['name'];
      $contact=$_POST['contact'];
      $address=$_POST['address'] . "<br>";
      $pin=$_POST['pincode'];
      $landmark=$_POST['landmark'] . "<br>";
      $product=$_POST['productname'];
      $model=$_POST['model'];
      $problem=$_POST['Problem'] . "<br>";
      $delar=$_POST['delarname'];
      $technician=$_POST['technician'];
      $status="pending";
      $serial=$_POST['serial'];
      $remarks=$_POST['remarks'];

      $jobno="ART".Date("dmyy").$r;
      $cdate=date("yy-m-d");
      $ctime=date("d-m-yy") . " , " .  date("h:i:s-a");


// check generated complain id is uniqid in database..
$check="SELECT * FROM tbl_complain WHERE jobno='$jobno'";
$run_check=mysqli_query($ocnn,$check);
if (mysqli_num_rows($run_check))
{
  //job no not unique generate new one.
  $r=rand(1000,9999);// generate new random no
  $jobno="ART".Date("dmyy").$r;
}else {

    // sql query to insert data
    $sql="INSERT INTO tbl_complain (customername,contactno,customeraddress,customerpincode,customerlandmark,productname,productmodelno,
          probelmdetails,delarname,complaindate,jobno,technicianassigned,remarks,status,serialno,statustime)
          VALUES ('$name','$contact','$address','$pin','$landmark','$product','$model','$problem','$delar','$cdate','$jobno','$technician',
          '$remarks','$status','$serial','$ctime')";

    $runsql=mysqli_query($conn,$sql);
    if ($runsql)
     {
       //user activiry tracker
       $_SESSION['jobno']=$jobno;
       $_SESSION['logkey']="3";
       include_once("php/index.php");

        //assign the msg for the modal
        $MSG="Complain for" . "  " . $name . " , "  . "Added successfully, <br>". "Job No is" .  "  " . $jobno . " ." . "<br>";
        //call modal for thanks msg.............................................
        // echo "<script type=text/javascript> $(document).ready(function()
        // {
        // $('#exampleModalCenter').modal('show');
        // });</script>";

        echo '<script type="text/javascript">swal("Complain Added Successfully!", "Job NO is: ' .  $jobno . '" , "success");</script>';  //javascript modal for show addcomplain message


        //call modal for thanks msg.............................................

      }else
        {
          //user activiry tracker
          $_SESSION['logkey']="4";
          include_once("php/index.php");
        //assign the msg for the modal
        $MSG="Unable to add Complain Server not responding <br> Try after sometime.";
        //call modal for Error msg.............................................
        echo "<script type=text/javascript> $(document).ready(function()
        {
        $('#exampleModalCenter').modal('show');
        });</script>";
        //call modal for Error msg.............................................
      }
    }
  }
}


?>

<!-- Modal  place here.............................-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Complain</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <?php echo $MSG ; //call the value ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



  <br><br><br><br><br><br><br>
  <!-- app version -->
  <p class="text-center"><?php echo $appversion; ?></p>
     <br><br>

  <!-- footer starts here -->
  <div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 All right reserved by Videologic || Design & Developed by
    <a href="<?php echo $developer_link; ?>"> <?php echo $developer; ?> </a>   ||   Email id: <?php echo $developer_email; ?>
  </div>
  </body>
  </html>
