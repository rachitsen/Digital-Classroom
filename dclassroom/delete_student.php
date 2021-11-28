<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>

<?php
include "common/dbconnect.php";
$email=$_GET['e'];
$query = "DELETE FROM `student_access` WHERE email='$email'";
$data = mysqli_query($conn,$query);
if($data)
{
    echo "Record deleted successfully!";
    header("location: class.php");
}
else{
    echo "Sorry, delete process failed";
}