<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
$showError2=false;
$showError3=false;
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
$existemail = "SELECT * FROM `users` WHERE email='$email'";
$result=mysqli_query($conn,$existemail);
    $numExistrows=mysqli_num_rows($result);
    if($numExistrows==0){
      // $exists=true;
      $showError2="Student not registerd yet";
    }
 else{
  $existemail1 = "SELECT * FROM `student_access` WHERE email='$email' and classid = '$classid'";
  $result=mysqli_query($conn,$existemail1);
      $numExistrows=mysqli_num_rows($result);
      if($numExistrows>0){
        // $exists=true;
        $showError3="Student already added in classroom";
      }
      else{
$sql ="INSERT INTO `student_access`(`username`, `classid`,`student_name`, `email`) VALUES ('$username','$classid','$sn','$email')";

$result=mysqli_query($conn,$sql);
if($result)
{
 $added = true;
}

      }
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
#grad1 {
  height: 140px;
  background-color: red; /* For browsers that do not support gradients */
  background-image: linear-gradient(#36d1dc, #5b86e5);}
.pcontainer {
  padding: 2px 26px;
}
.box{
margin-top: 1.5cm; 
width:600px; 
height: 310px;
box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 20px;
  padding:0.1px;
background:white;

}
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Add Students</title>
    </head>
  <body style="background-color: #F5F5F5";>
<?php
    echo '<nav class="navbar navbar-expand-lg navbar-dark "style="background-color:#333333">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      <a class="nav-link" href="classrooms.php" style="padding-top:1mm"><img src="images/dclogo.png" width="190" alt=""></a>
    </li>
        <li class="nav-item">
          <a class="nav-link" href="class.php">Classroom</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dash.php">Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upload_notes.php">Share Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teacher-doubtbox.php">Doubt Box</a>
        </li>
      </ul>
      </div>
      <div class="d-flex flex-row bd-highlight">
      <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;border-radius: 10%;" aria-current="page" href="#" style="align:left; "><img src="images/profile.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
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
     if($showError2){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error!</strong> '.$showError2.'
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
       }  
       if($showError3){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Error!</strong> '.$showError3.'
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
         }  
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
  if($_SESSION['typeid']=='Teacher')
  {
    echo'<a href="class.php" style="text-decoration: none;">
    <div class="card pcontainer my-3" style="width:90%;border-radius:50px">
  <h2 style= "color:#1D3458,"><h2 style= "color:#1D3458,"><img width="3%" src="https://media.istockphoto.com/vectors/blue-add-plus-icon-in-flat-style-with-long-shadow-vector-id1133187284?b=1&k=20&m=1133187284&s=170667a&w=0&h=aTGnfBwcicpMhFSOb0l-p_2VXHTbuk4-WKD6K33Zz7E="> All students</h2>
</div>
</a>';}
  ?>

<div class="container my-2 box">
      <h2 style="text-align: center;color: #316B83;">Add New Student</h2>
    <form action="addstudent.php" method="POST">
  <div class="mb-3 my-4">
    <label for="student" class="form-label" style="color: #1D3458;font-weight:bolder" >Enter Student Name</label>
    <input type="text"  name ="sn" class="form-control" id="student" required="required">

    <label for="email" class="form-label my-3" style="color: #1D3458;font-weight:bolder">Enter Email</label>
    <input type="email"  name="email" class="form-control" id="email" required="required">
    
  

<br>
  <span><button type="submit" class="btn btn-primary">Add</button></span>
</form>

    </div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>