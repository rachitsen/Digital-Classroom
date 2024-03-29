<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
  <style>
.pcard {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: auto;
  border-radius: 20px;
  padding:3px;
  background-color: white;
  margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        text-align: center;
}

.pcard:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
}

.pcontainer {
  padding: 2px 26px;
}

</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Welcome -<?php echo $_SESSION['username']?></title>
     </head>
       <body style="background-color: #CDECFF">
    <?php require 'common/nav.php';
    ?>

<?php
include "common/dbconnect.php";
$username = $_SESSION['username'];
echo '<br>';
$email = $_SESSION['email'];
$query = "SELECT * FROM `student_access` WHERE email = '$email'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{
	?>
	<?php
	while($result=mysqli_fetch_assoc($data))
	 {
    $classid = $result['classid'];
    $sql = "SELECT * FROM `classrooms` WHERE classid = '$classid'";
    $d = mysqli_query($conn,$sql);
    $t=mysqli_num_rows($d);
    while($res=mysqli_fetch_assoc($d))
     {
       echo "
       <div class='card w-75 h-150 my-3 rounded-lg' style='box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);margin-left: 13%;      
  margin-right: 18%;
  width: auto;'>
  <div class='card-body pl-2'>
    <h2 class='card-title' style='color:#585858 '><b>".$res['class_name']."</b></h2>
    <p class='card-text'>".$res['class_details']."</p>
    <form method='POST'><button type='submit' name='button' value='$classid' class='btn btn-primary' style='background-color:#64C9CF'><b>Enter</b></button></form>
  </div>
</div>";
   }
}
}
else
{
	echo '<div class="alert alert-light" role="alert">
  <p style="text-align:center">Not enrolled in any class</p>
</div>';
}

		if(array_key_exists('button', $_POST)) {
			$classid = $_POST['button'];
      unset($_SESSION['classid']);
      $_SESSION['classid']=$classid;
      echo "<meta http-equiv='refresh' content='0; url=student-class.php'>";
      
		}
		function button1() {
			echo "This is Button1 that is selected";
        }
?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>