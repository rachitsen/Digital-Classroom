<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>
<?php
if  ($_SERVER['REQUEST_METHOD']=='POST'){
include "common/dbconnect.php";
$username=$_SESSION['username'];
$name=$_POST['name'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$gender=$_POST['gender'];
$doj=$_POST['doj'];
$degree=$_POST['degree'];
$skills=$_POST['skills'];
$yoe=$_POST['yoe'];
// $exists=false;
//check whether this username exists
/*$existSql = "SELECT * FROM `users` WHERE username='$username'";
$result=mysqli_query($conn,$existSql);
    $numExistrows=mysqli_num_rows($result);
if($numExistrows>0){
    $sql ="INSERT INTO 'teachers' ('username') VALUES ('$username');
}*/
    echo"<h4> welcome:$username</h4>";
    $sql ="INSERT INTO `teachers`(`username`,`name`, `email`, `contact`, `gender`, `doj`, `degree`, `skills`, `yoe`) VALUES ('$username','$name','$email','$contact','$gender','$doj','$degree','$skills','$yoe')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } 
   

}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title> Teacher details</title>
 
  </head>
  <body style=" background-color: white;background-image: linear-gradient(lightblue, blueviolet);">
  <?php require 'common/nav.php' ?>
    <?php
            
    ?>

   
<div class="form-group">
    <?php include 'css.php';
     ?>
 <div class="bg-img">
  <form action="/dclassroom/teacherinfo.php" method="post" class="container">
    <h2> Teacher Details</h2>
    <label for="name" class="form-label"><b>Name</b></label>
    <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required>

    <label for="email" class="form-label"><b>Email</b></label>
    <input type="text" class="form-control" placeholder="Enter Email" name="email" aria-describedby="emailHelp" required>

    <label for="contact" class="form-label"><b>Contact</b></label>
    <input type="integer" class="form-control" placeholder="Enter contact" name="contact" required>

    <label class="checkbox-inline"><b> Gender</b>
      <input type="checkbox" name="gender" value="Male">Male
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="gender" value="Female">female
    </label>
<br>
    <label for="doj" class="form-label"><b>Date of Joining</b></label>
    <input type="date" class="form-control" placeholder="Enter date of joining" name="doj" >

    <label for="degree" class="form-label"><b>Degree</b></label>
    <input type="text" class="form-control" placeholder="Enter Educational details" name="degree">

    <label for="skills" class="form-label"><b>Skills</b></label>
    <input type="text" class="form-control" placeholder="Enter skills" name="skills" >

    <label for="yoe" class="form-label"><b>Years of Experience</b></label>
    <input type="integer" class="form-control" placeholder="Enter Years of Experience" name="yoe">




    
    <button type="submit" name="submit" class="btn">Save</button>
    <h5 style=text-align:center><b>Get <a href="welcome.php">Welcome</a></b></h5>
  </form>
</div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>