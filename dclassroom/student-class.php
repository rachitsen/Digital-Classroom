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
    table.center {
  margin-left: auto;
  margin-right: auto;
}

.icenter {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
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
.pcontainer {
  padding: 2px 26px;
}

   .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    max-width: 70%;
    
    
}
.styled-table{
  margin-left: auto;
  margin-right: auto;
}


.styled-table thead tr {
    background-color: white;
    color: #1E90FF;
    font-size: 1cm;
    border-bottom: 3px solid #008080;
    text-align: left;
    
}
.styled-table th,
.styled-table td {
  font-weight: bolder;
    padding: 12px 15px;
    
}
.styled-table{
  background-color: white;
}
.styled-table tbody th {
    font-weight: bolder;
    border-bottom: 1px solid black;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 1px solid #B8B8B8;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
   #grad1 {
  height: 140px;
  background-color: red; /* For browsers that do not support gradients */
  background-image: linear-gradient(#36d1dc, #5b86e5);
}
  </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome -<?php echo $_SESSION['username']?></title>
  </head>
  <body style="background-color: white";>
<?php include 'common/nav_student.php';?>
<?php
include "common/dbconnect.php";
$classid= $_SESSION['classid'];
$query = "SELECT * FROM `classrooms` WHERE  classid= '$classid'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);
if($total != 0)
{
  while($result=mysqli_fetch_assoc($data))
  {


echo'<div id="grad1" style{
    font-family: sans-serif;

}>
<br>
<h1 style="color:white;margin-left: 6%;">'.$result['class_name'].'</h1>
<p style="color:#FBF4E9;margin-left: 6%;">'.$result['class_details'].'</p>
</div>';


  }
}
?>

<?php
include "common/dbconnect.php";
$classid = $_SESSION['classid'];
echo '<br>';
$query = "SELECT * FROM `student_access` WHERE classid = '$classid'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{
	?>
       <table class="styled-table" style="width:70%;">
         <thead>


           <tr class="active-row">

             <td>Classmates</td>
             <td style='text-align: center;'><img src="images/smemail.png" width="8%" alt=""></td>
            </tr>

          </thead>
	<?php
  while($result=mysqli_fetch_assoc($data))
  {

      echo "
      <tbody>
      <tr>
      <td><img src='images/smprofile.jpg' width='4%'> ".$result['student_name']."</td>
      <td style='text-align: center;'>".$result['email']."</td>
      
      </tr>
      </tbody>
      ";
  }
}
else
{
	echo '<div class="alert alert-dark" role="alert" style="text-align:center">
  <p><b>Students are not added</b></p>
</div>';
}
?>
</table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>




