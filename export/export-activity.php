<?php
session_start();
require_once('../php/connection.php');

$cmd=$_SESSION['export'];//assign session variable
$title=$_SESSION['export-name'];
$output='';
$count=0;

$sql1=$cmd;
$run1=mysqli_query($conn,$sql1);
$num=mysqli_num_rows($run1);

$output="Videologic Service . " . " Activity Data . Export Date : " . date("d-m-yy") . "<br><br>"
          ."<strong>" . " User: " . $_SESSION['user'] . " || UserRole: " .$_SESSION['role'] . " || title :  $title" . "</strong><br><br>"
          ."<strong>" . "Total Activity: " . $num . "</strong><br><br>";


    $output.='
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>User Access</th>
          <th>Action</th>
          <th>Remarks</th>
          <th>Time Stamp</th>
        </tr>
      </thead>

    ';
// }


while ($data=mysqli_fetch_assoc($run1))
 {
   $count=$count+1;

$output.='<tbody><tr>
  <td>'.$count.'</td>
  <td>'.$data['username'].'</td>
  <td>'.$data['useraccess'].'</td>
  <td>'.$data['action'].'</td>
  <td>'.$data['remarks'].'</td>
  <td>'.$data['timestamp1'].'</td>
  </tr>
</tbody>';


}

$output.='</table>';

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
