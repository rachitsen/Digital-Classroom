<?php
session_start();
?>

  
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    margin-left: auto;
    
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 0.5cm;
    box-shadow: 0 8px 16px 8px rgba(0,0,0,0.2);
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#2F4F4F), to(#20B2AA));
    background: linear-gradient(to right, #6A5ACD, #20B2AA)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
    
}

.m-b-25 {
    margin-bottom: 15px
}

.img-radius {
    border-radius: 50px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 2px !important
}

.m-b-10 {
    margin-bottom: 2px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}

input[type=text] {
    margin-top: 0.5cm;
  width: 195px;
  box-sizing: border-box;
  border: 2px solid #20B2AA;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  box-shadow: 0 8px 26px 0 rgba(0,0,0,0.2);
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 65%;
  
}
    </style>
    </head>
    <body style="background-color: #CDECFF";>
    <nav class="navbar navbar-expand-lg navbar-dark " 
style="background-color:#333333">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <a class="navbar-brand" href="Login_home.php">
  <img src="images/dclogo.png" width="200" alt="">
</a>
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>>
          <a class="nav-link" href="admin.php?q=0">Classrooms</a>
        </li>
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>>
          <a class="nav-link" href="admin.php?q=1">Teachers</a>
        </li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
          <a class="nav-link" href="admin.php?q=2">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
        
        <span style="float:right"><a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;border-radius: 10%;" aria-current="page" href="#" style="text-align:left; "><img src="images/profile.jpg" alt="..." height="26" style="border-radius: 50%;"> admin</a>
        </span>
        </div>
      </nav>
      
      <!--Classrooms-->
      <?php if(@$_GET['q']==0) {
include "common/dbconnect.php";
echo '<br>';
echo '<div style="text-align:center">
    <form method="POST">
      <input type="text" name="search" placeholder="Search Class Name">
    </form>
    </div>';
    error_reporting(0);
            $search=$_POST["search"];
$query = "SELECT * FROM `classrooms` WHERE (class_name LIKE '%$search%') || (username LIKE '%$search%')";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{
	?>
     
	<?php
	while($result=mysqli_fetch_assoc($data))
	 {
    $classid = $result['classid'];
       echo "
       <div class='card w-75 h-150 my-3 rounded-lg' style='box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);margin-left: 13%;      
  margin-right: 18%;
  width: auto;'>
  <div class='card-body pl-2'>
    <h2 class='card-title' style='color:#585858 '><b>".$result['class_name']."</b></h2>
    <p class='card-text'>".$result['class_details']."</p>
    
  </div>
</div>";

   }
}
else
{
	echo '<div class="alert alert-light" role="alert">
  Classes not created
</div>';
}

		
		
    }
    // Teachers
    if(@$_GET['q']== 1) {
        include "common/dbconnect.php";
        echo '<div style="text-align:center">
<form method="POST">
  <input type="text" name="search" placeholder="Search Username">
</form>
</div>';
error_reporting(0);
        $search=$_POST["search"];
        $q=("SELECT * FROM `teachers` WHERE (username LIKE '%$search%') || (email LIKE '%$search%')");
        $data = mysqli_query($conn,$q);
$total=mysqli_num_rows($data);
while($result=mysqli_fetch_assoc($data) )
{
    echo '<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img width="50%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgCIoKxXZss5sCIP3jHf-fWgBE9y5M3wKLRg&usqp=CAU" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600">'.$result['username'].'</h6>
                                <p>'.$result['skills'].'</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Name</p>
                                <h6 class="text-muted f-w-400">'.$result['fullname'].'</h6>
                            </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">'.$result['email'].'</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400">'.$result['contact'].'</h6>
                                    </div>
                                    <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Gender</p>
                                    <h6 class="text-muted f-w-400">'.$result['gender'].'</h6>
                                </div>
                                <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Degree</p>
                                <h6 class="text-muted f-w-400">'.$result['degree'].'</h6>
                            </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

    }
   
}
// Students
if(@$_GET['q']== 2) {
    include "common/dbconnect.php";
    echo '<div style="text-align:center">
    <form method="POST">
      <input type="text" name="search" placeholder="Search Username">
    </form>
    </div>';
    error_reporting(0);
            $search=$_POST["search"];
            $q=("SELECT * FROM `students` WHERE (username LIKE '%$search%') || (email LIKE '%$search%')");
   
    $data = mysqli_query($conn,$q);
$total=mysqli_num_rows($data);
while($result=mysqli_fetch_assoc($data) )
{
    echo '<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">  <img width="50%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgCIoKxXZss5sCIP3jHf-fWgBE9y5M3wKLRg&usqp=CAU"class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600">'.$result['username'].'</h6>
                                <p>'.$result['skills'].'</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Name</p>
                                <h6 class="text-muted f-w-400">'.$result['fullname'].'</h6>
                            </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">'.$result['email'].'</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400">'.$result['contact'].'</h6>
                                    </div>
                                    <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Gender</p>
                                    <h6 class="text-muted f-w-400">'.$result['gender'].'</h6>
                                </div>
                                <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Qualification</p>
                                <h6 class="text-muted f-w-400">'.$result['highestqualification'].'</h6>
                            </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

    }
   
}

?>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>