<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
  
}
?>
<?php

$created = false;
$no=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
include 'common/dbconnect.php';
include 'css.php';
error_reporting(0);
$username=$_SESSION['username']; 


$n=$_POST['n'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
    $gender=$_POST['gender'];
    $doj=$_POST['doj'];
    $degree=$_POST['degree'];
    $skills=$_POST['skills'];
    $yoe=$_POST['yoe'];
    $sql ="INSERT INTO `teachers`(`username`, `fullname`,`email`, `contact`,`gender`,`doj`,`degree`,`skills`,`yoe`) VALUES ('$username','$n','$email','$contact','$gender','$doj','$degree','$skills','$yoe')";
    $result=mysqli_query($conn,$sql);
if($result)
    {
      $created = true;
     }
     
     }
  ?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>Profile</title>
<style>@import url('httpss://fonts.googleapis.com/css?family=Roboto');
	
	body {
        background-color: #CDECFF;
}

.signup-form {
  font-family: "Roboto", sans-serif;
  width:650px;
  height:545px;
  margin:30px auto;
  background:linear-gradient(to right, #ffffff 0%, #fafafa 50%, #ffffff 99%);
  border-radius: 10px;
  box-shadow: 5px 10px 16px  #888888;
}



.form-header h1 {
  font-size: 30px;
  text-align:center;
  color:#666;
  padding:20px 0;
  border-bottom:1px solid #cccccc;
}
/*---------------------------------------*/
/* Form Body */
/*---------------------------------------*/
.form-body {
  padding:10px 40px;
  color:#666;
}

.form-group{
  margin-bottom:20px;
}

.form-body .label-title {
  color:#38A3A5;
  font-size: 17px;
  font-weight: bold;
}

.form-body .form-input {
    font-size: 17px;
    box-sizing: border-box;
    width: 100%;
    height: 34px;
    padding-left: 10px;
    padding-right: 10px;
    color: #333333;
    text-align: left;
    border: 1px solid #d6d6d6;
    border-radius: 4px;
    background: white;
    outline: none;
}



.horizontal-group .left{
  float:left;
  width:49%;
}

.horizontal-group .right{
  float:right;
  width:49%;
}

input[type="file"] {
 outline: none;
 cursor:pointer;
 font-size: 17px;
}

#range-label {
 width:15%;
 padding:5px;
 background-color: #1BBA93;
 color:white;
 border-radius: 5px;
 font-size: 17px;
 position: relative;
 top:-8px;
}


::-webkit-input-placeholder {
 color:#d9d9d9;
}

/*---------------------------------------*/
/* Form Footer */
/*---------------------------------------*/
.form-footer {
 clear:both;
}
/*---------------------------------------*/
/* Form Footer */
/*---------------------------------------*/
.signup-form .form-footer  {
  background-color: #EFF0F1;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  padding:10px 40px;
  text-align: right;
  border-top: 1px solid #cccccc;
}



.btn {
   display:inline-block;
   padding:10px 20px;
   background-color: #1BBA93;
   font-size:17px;
   border:none;
   border-radius:5px;
   color:#bcf5e7;
   cursor:pointer;
}

.btn:hover {
  background-color: #169c7b;
  color:white;
}
</style>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
      

<body style="background-color: #CDECFF">

<?php
include 'common/nav_teacher.php';
     if($created)
     {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Successfully</strong> Your new student <b>'.$n.'</b> is added.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
     }
    ?>
<?php 
include 'common/dbconnect.php';

$username=$_SESSION['username'];
$query = mysqli_query($conn,"SELECT *  FROM teachers WHERE username='$username'");
if(mysqli_num_rows($query) != 0)
{
  // echo 'user already present';
  ?>
  <script type="text/javascript">
  window.location.href = 'http://localhost/dclassroom/teacherup.php';
  </script>
  <?php
}
  else{
    echo'
  <form class="signup-form" action="/dclassroom/teachershow.php" method="post">
  <!-- form header -->
  <div class="form-header">
  </div>
  <!-- form body -->
  <div class="form-body">
     
<!-- Firstname and Lastname -->
<div class="horizontal-group">
<h1 style="color:#316B83;align:center"> Teacher Details</h1>
  <div class="form-group left">
      <label for="n" class="label-title">Name *</label>
      <input type="text" id="n" class="form-input" name="n" placeholder="Enter your first name" required="required" />
  </div>
  <div class="form-group right">
      <label for="email" class="label-title">Email *</label>
      <input type="text" id="email" name="email" class="form-input" placeholder="Enter your email" required="required">
  </div>
</div>
<div class="form-group">
  <label for="contact" class="label-title">Contact*</label>
  <input type="integer" id="contact" class="form-input" name="contact" placeholder="enter your contact number" required="required">
</div>
<!-- Gender and Hobbies -->
<div class="horizontal-group">
  <div class="form-group left">
      <label class="label-title">Gender:</label>
      <div class="input-group">
          <label for="male">
              <input type="radio" name="gender" value="male" id="male" required="required"> Male</label>
          <label for="female">
              <input type="radio" name="gender" value="female" id="female" required="required"> Female</label>
      </div>
  </div>
  <div class="form-group right">
      <label for="doj" class="label-title">Date Of Joining</label>
      <div>
          <label>
          <input type="date" class="form-control" placeholder="Enter date of joining" name="doj" required="required"></label>
          
      </div>
  </div>
  
</div>
<div class="horizontal-group">
<div class="form-group left">
  <label for="degree" class="label-title">Degree  *</label>
  <input type="text" id="degree" class="form-input" name="degree" placeholder="Enter Educational details" required="required">
</div>
<div class="form-group right">
  <label for="skills" class="label-title">Skills *</label>
  <input type="text" name="skills" class="form-input" id="skills" placeholder="enter your skills" required="required">
</div>
</div>

<div class="form-group right">
<label for="yoe" class="label-title">Year Of Expirence</label>
<input type="integer"   class="form-input" placeholder="Enter Years of Experience" name="yoe" required="required">
</div>
</div>
<div  style="padding-left: 6%;">
<button type="submit" class="btn btn-primary" style:"align:center">Submit</button> </div></div>
<h5 style="text-align:center"><b><a href="teacherup.php" >Update</a></b></h5>


</div>';
  }
?>

</form>
</body>
</html> 