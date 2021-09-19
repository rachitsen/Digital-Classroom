<?php
$login= false;
$showError= false;
if  ($_SERVER['REQUEST_METHOD']=='POST'){
include "common/dbconnect.php";
$username=$_POST['username'];
$password=$_POST['password'];

    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password,$row['password'])){
          $login = true;
          session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("location: welcome.php");

        }
        else{
          $showError="Invalid credientials";
            }
      }
      
    }

else{
  $showError="Invalid credientials";
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

    <title>Login - Digital Classroom </title>
  </head>
  <body style=" background-color: white;background-image: linear-gradient(lightblue, blueviolet);">
    <?php require 'common/nav.php' ?>
    <?php
    if($login){
   echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error!</strong> '.$showError.'
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
       }
    ?>
    <div class="form-group">
    <?php include 'css.php';?>
 <div class="bg-img">
  <form action="/dclassroom/login.php" method="post" class="container">
    <h1>Login</h1>
<br>
    <label for="username" class="form-label"><b>Username</b></label>
    <input type="text" class="form-control" placeholder="Enter Username" name="username"  required>

    <label for="password" class="form-label"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" class="form-control" id="password" name="password" required>

    <br>
    <button type="submit" name="submit" class="btn">Login</button>
    <h5 style=text-align:center><b>Don't have accoute <a href="signup.php">Register here</a></b></h5>
  
    
</form>
</div>
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
