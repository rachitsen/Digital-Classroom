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
.content-table{
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.6cm;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba (0,0,0,0.15);
   }
   .content-table thead tr{
     background-color: #009879;
     color:white;
     text-align:left;
     font-weight:bold;
   }
   .content-table th,
   .content-table td{
     padding: 12px 15px;
   }
   .content-table tbody tr{
     border-bottom: 1px solid #dddddd;
   }
   .content-table tbody tr:nth-of-type(even){
     background-color: #f3f3f3;
   }
   .content-table tbody tr:last-of-type {
     border-bottom:2px solid #009879;
   }
   
  </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome -<?php echo $_SESSION['username']?></title>
  </head>
  <body style="background-color: #CDECFF";>
     
    <?php
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Digital Classroom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Share Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Doubt Box</a>
        </li>
      </ul>
      
      <div class="d-flex flex-row bd-highlight">
      <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;border-radius: 10%;" aria-current="page" href="#" style="align:left; "><img src="image/user2.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
      </div>
  </nav>'
  
?>
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
   

  echo '<div class="card" style="background-color: grey;">
  <img src="image/classroom.jpg" style="width:20%;" class="pcard pcontainer icenter" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$result['class_name'].'</h5>
    <p class="card-text">'.$result['class_details'].'</p>
  </div>
  
</div>';

      
  }
}
?>
<?php
  if($_SESSION['typeid']=='Teacher')
  { 

    echo'<a href="addstudent.php" style="text-decoration: none;">
    <div class="pcard pcontainer my-3">
  <h2 style= "color:#1D3458,">Add Students</h2>
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

if($total != 0)
{
	?>
       <table class="content-table center" style="width:100%">
         <thead>

           
           <tr>
             
             <td>Student name</td>
             <td>Email</td>
            </tr>
            
          </thead>
	<?php
  while($result=mysqli_fetch_assoc($data))
  {
  
      echo "
      <tbody>
      <tr>
      <td>".$result['student_name']."</td>
      <td>".$result['email']."</td>
      
      </tr>
      </tbody>
      ";
  }
}
else
{
	echo "no record";
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
