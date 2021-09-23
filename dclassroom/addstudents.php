<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>

<?php
$added = false;
if  ($_SERVER['REQUEST_METHOD']=='POST')
{
include "common/dbconnect.php";
$username=$_SESSION['username'];
$classid =$_SESSION['classid'];
$sn=$_POST['sn'];
$email=$_POST['email'];

$sql ="INSERT INTO `student_access`(`username`, `classid`,`student_name`, `email`) VALUES ('$username','$classid','$sn','$email')";
$result=mysqli_query($conn,$sql);
if($result)
{
 $added = true;
}

}
?>

<!doctype html>
<html lang="en">
  <head>
    <style>
      .card {
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title></title>
    </head>
  <body style="background-color: #DFBEF7;">
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
      </div>
      <div class="d-flex flex-row bd-highlight">
      <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;border-radius: 10%;" aria-current="page" href="#" style="align:left; "><img src="image/user2.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
  </nav>'
  
?>
  <?php
     if($added)
     {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Successfully</strong> Your new student <b>'.$sn.'</b> is added.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
     }
    ?>
    <?php
  if($_SESSION['typeid']=='Teacher')
  {
    echo'<a href="class.php" style="text-decoration: none;">
    <div class="card pcontainer my-3">
  <h2 style= "color:#1D3458,">All students</h2>
</div>
</a>';}
  ?>

<div class="container my-5">
      <h1>Add New Student</h1>
    <form action="addstudent.php" method="POST">
  <div class="mb-3 my-4">
    <label for="student" class="form-label">Enter Student Name</label>
    <input type="text"  name ="sn" class="form-control" id="student" >

    <label for="email" class="form-label my-3">Enter Email</label>
    <input type="text"  name="email" class="form-control" id="email" >
    
  


  <span><button type="submit" class="btn btn-primary">Add</button></span>
</form>

    </div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>
