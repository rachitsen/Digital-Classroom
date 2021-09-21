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
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  border-radius: 20px;
  padding:5px;
}

.card:hover {
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
       <body style="background-color: #DFBEF7;">
    <?php require 'common/nav.php';
    ?>

  <?php
  if($_SESSION['typeid']=='Teacher')
  {
    echo'<a href="addclassrooms.php" style="text-decoration: none;">
    <div class="card pcontainer my-3">
  <h2 style= "color:#1D3458,">Create New Classroom</h2>
</div>
</a>';}
  ?>
<?php
include "common/dbconnect.php";
$username = $_SESSION['username'];
echo '<br>';
$query = "SELECT * FROM `classrooms` WHERE username = '$username'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{
	?>
       <table border="2px">
       	<tr>

            <th>Classroom name</th>
       		<th>Subject</th>
       		<th>ClassDetails</th>
       	</tr>
     
	<?php
	while($result=mysqli_fetch_assoc($data))
	 {
	 
       echo "
       <tr>
       <td><a href='addstudent.php'>".$result['class_name']."</a></td>
       <td>".$result['costum']."</td>
       <td>".$result['class_details']."</td>
       </tr>";
	 }
}
else
{
	echo "no record";
}
?>






    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>
