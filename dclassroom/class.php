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
    background-color: #F5F5F5;
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
  background-color: #F5F5F5;
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
  <body style="background-color: #F5F5F5";>
<?php include 'common/nav_teacher.php';?>
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


//   echo '<div class="card bg-dark text-white" style="width:full;height:60%">
//   <img class="card-img" src="image/class3.jpg" alt="Card image">
//   <div class="card-img-overlay">
//     <h2 class="card-title mb-2">'.$result['class_name'].'</h2>
//     <p class="card-text">'.$result['class_details'].'</p>
   
//   </div>
// </div>';
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
  if($_SESSION['typeid']=='Teacher')
  { 

    echo'<br><a href="addstudent.php" style="text-decoration: none;width:80%">
    <div class="pcard pcontainer my-1" style="width:90%">
  <h2 style= "color:#1D3458,"><img width="3.5%" src="https://media.istockphoto.com/vectors/blue-add-plus-icon-in-flat-style-with-long-shadow-vector-id1133187284?b=1&k=20&m=1133187284&s=170667a&w=0&h=aTGnfBwcicpMhFSOb0l-p_2VXHTbuk4-WKD6K33Zz7E="> Add Students</h2>
</div>
</a>';}
  ?>
<?php
include "common/dbconnect.php";
$classid = $_SESSION['classid'];
echo '<br>';
$query = "SELECT * FROM `student_access` WHERE classid = '$classid'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);
$i =1;
if($total != 0)
{
	?>
       <table class="styled-table" style="width:90%;">
         <thead>


           <tr class="active-row">

             <td>Classmates</td>
             <td><img src="images/smemail.png" width="8%" alt=""></td>
            </tr>

          </thead>
	<?php
  while($result=mysqli_fetch_assoc($data))
  {

      echo "
      <tbody>
      <tr>
      <td ><img src='images/smprofile.jpg' width='4%'> ".$result['student_name']."</td>
      <td >".$result['email']."</td>
      <td style='text-align: right;'><a href='delete_student.php?e=$result[email]'><img width='8%' src='data:image/png;base64,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'></a></td>
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




