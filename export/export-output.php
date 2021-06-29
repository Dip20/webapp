<?php
session_start();
require_once('../php/connection.php');

$cmd=$_SESSION['export'];//assign session variable
$title=$_SESSION['export-name'];
$output='';
$count=0;
$sql1=$cmd;
$run1=mysqli_query($conn,$sql1);

$output="Videologic Service  " . " Customer complain Data. Export Date : " . date("d-m-yy") . "<br><br>"
          ."<strong>" . " User: " . $_SESSION['user'] . " || UserRole: " .$_SESSION['role'] . " || title :  $title" . "</strong><br><br>";

    $output.='
    <table>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Job ID</th>
          <th scope="col">Customer Name</th>
          <th scope="col">contactno</th>
          <th scope="col">Address</th>
          <th scope="col">Pincode</th>
          <th scope="col">Landmark</th>
          <th scope="col">Productname</th>
          <th scope="col">ModelNo</th>
          <th scope="col">Probelm Details</th>
          <th scope="col">Delarname</th>
          <th scope="col">technicianassigned</th>
          <th scope="col">Status</th>
          <th scope="col">Last Update</th>
          <th scope="col">Serial No</th>
          <th scope="col">Remarks</th>
        </tr>
      </thead>
    ';
// }


while ($data=mysqli_fetch_assoc($run1))
 {
   $count=$count+1;

$output.='<tbody><tr>
  <td>'.$count.'</td>
  <td>'.$data['complaindate'].'</td>
  <td>'.$data['jobno'].'</td>
  <td>'.$data['customername'].'</td>
  <td>'.$data['contactno'].'</td>
  <td>'.$data['customeraddress'].'</td>
  <td>'.$data['customerpincode'].'</td>
  <td>'.$data['customerlandmark'].'</td>
  <td>'.$data['productname'].'</td>
  <td>'.$data['productmodelno'].'</td>
  <td>'.$data['probelmdetails'].'</td>
  <td>'.$data['delarname'].'</td>
  <td>'.$data['technicianassigned'].'</td>
  <td>'.$data['status'].'</td>
  <td>'.$data['statustime'].'</td>
  <td>'.$data['serialno'].'</td>
  <td>'.$data['remarks'].'</td>

  </tr>
</tbody>';


}

$output.='</table>';
$output.="__________________________________________________________________________________________________________________________________________________________________________________________<br><br>";

$output.="<br> Application Developed by : santu sarkar <br> Email id : santusarkar2020@gmail.com";


if (!empty($cmd))
{
    // Prepare and download excel file
    header('content-Type:application/xls');
    header("content-Disposition: attachment; filename=$title.xls");
    echo $output;


    //unset session....................
    unset($_SESSION['export']);
    unset($_SESSION['export-name']);

}else {
  header("location:../output.php");
}
?>
