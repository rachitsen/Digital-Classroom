<?php
$showAlert=false;
$showError=false;
if  ($_SERVER['REQUEST_METHOD']=='POST'){
include "common/dbconnect.php";

$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$typeid=$_POST['typeid'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
// $exists=false;
//check whether this username exists
$existSql = "SELECT * FROM `users` WHERE username='$username'";
$result=mysqli_query($conn,$existSql);
    $numExistrows=mysqli_num_rows($result);
if($numExistrows>0){
  // $exists=true;
  $showError="username already exist";
}
else{
  // $exists=false;

if($password==$cpassword){
  $hash=password_hash($password,PASSWORD_DEFAULT);
    $sql ="INSERT INTO `users` (`name`,`email`, `username`,`typeid`, `password`) VALUES ( '$name','$email','$username','$typeid', '$hash');";
    $result=mysqli_query($conn,$sql);
    if($result){
      $showAlert = true;
      
    }
}
else{
  $showError="Password do not match ";
    }
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

    <title>SignUp - Digital Classroom</title>
  </head>
  <body style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
background-attachment: fixed;
  background-repeat: no-repeat;">
  <?php require 'common/nav.php' ?>
    <?php
    if($showAlert){
   echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is created and you can login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error!</strong> '.$showError.'
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
       }
       include 'css.php';
    ?>

   
<div class="form-group">
    <?php include 'css.php';?>
 <div class="bg-img">
  <form action="/dclassroom/signup.php" method="post" class="signupcontainer">
    <h1>Sign Up</h1>
    <label for="name" class="form-label"></label>
    <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required>

    
    <input type="text" class="form-control" placeholder="Enter Email" name="email" aria-describedby="emailHelp" required>

    
    <input type="text" class="form-control" placeholder="Enter Unique Username" name="username"  required>

    <label class="checkbox-inline">
      <input type="checkbox" name="typeid" value="Teacher" ><b> Teacher</b>
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="typeid" value="Student"><b> Student</b>
    </label>
   <br>
    <input type="password" placeholder="Enter Password" class="form-control" id="password" name="password" required>
     
    
    <input type="password" placeholder="Enter Confirm Password" maxlength="23" class="form-control" id="cpassword" name="cpassword">
    
    <button type="submit" name="submit" class="btn">Sign Up</button>
    <h5 style=text-align:center><b>Get <a href="login.php">Login</a></b></h5>
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