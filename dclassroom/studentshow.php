<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Student'){?>
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


$name=$_POST['name'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $highestqualification=$_POST['highestqualification'];
    $skills=$_POST['skills'];
    
    $sql ="INSERT INTO `students`(`username`, `name`,`email`, `contact`,`gender`,`dob`,`highestqualification`,`skills`) VALUES ('$username','$name','$email','$contact','$gender','$dob','$highestqualification','$skills')";
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
  background:linear-gradient(to right, #78a7ba 0%, #385D6C 50%, #78a7ba 99%);
}

.signup-form {
  font-family: "Roboto", sans-serif;
  width:650px;
  margin:30px auto;
  background:linear-gradient(to right, #ffffff 0%, #fafafa 50%, #ffffff 99%);
  border-radius: 10px;
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
  color:#1BBA93;
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
</head>
      

<body>
<?php
     if($created)
     {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Successfully</strong> Your prifile has been udapted <b>'.$name.'</b> is added.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
     }
    ?>
<?php 
include 'common/dbconnect.php';
$username=$_SESSION['username'];
$query = mysqli_query($conn,"SELECT *  FROM students WHERE username='$username'");
if(mysqli_num_rows($query) != 0)
{
  // echo 'user already present';
header("location: studentup.php");
}
  else{
    echo'
  <form class="signup-form" action="/dclassroom/studentshow.php" method="post">

  <!-- form header -->
  <div class="form-header">
  </div>

  <!-- form body -->
  <div class="form-body">
     

<!-- Firstname and Lastname -->
<div class="horizontal-group">
<h2> Personal Details</h2>
  <div class="form-group left">
      <label for="name" class="label-title">Name *</label>
      <input type="text" id="name" class="form-input" name="name" placeholder="Enter your first name" required="required" />
  </div>
  <div class="form-group right">
      <label for="email" class="label-title">Email *</label>
      <input type="text" id="email" name="email" class="form-input" placeholder="Enter your email" />
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
              <input type="radio" name="gender" value="male" id="male"> Male</label>
          <label for="female">
              <input type="radio" name="gender" value="female" id="female"> Female</label>
      </div>
  </div>

  <div class="form-group right">
      <label for="dob" class="label-title">Date Of Birth</label>
      <div>
          <label>
          <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dob" ></label>
          
      </div>
  </div>
  
</div>


<div class="horizontal-group">

<div class="form-group left">
  <label for="highestqualification" class="label-title">Highest Qualification *</label>
  <input type="text" id="highestqualification" class="form-input" name="highestqualification" placeholder="Enter Educational details" required="required">
</div>

<div class="form-group right">
  <label for="skills" class="label-title">Skills *</label>
  <input type="text" name="skills" class="form-input" id="skills" placeholder="enter your skills" required="required">
</div>

</div>

<!-- Profile picture and Age -->
<div class="horizontal-group">

<div class="form-group left" >
<label for="choose-file" class="label-title">Upload Profile Picture</label>
<input type="file" id="choose-file" size="80">
</div>



</div>
  
  
  <!-- form header -->
<div class="form-header">
<h1>Create Account</h1>
<span><button type="submit" class="btn btn-primary">Submit</button></span> <h5 style=text-align:center><b> <a href="studentup.php">Update</a></b></h5>

</div>';
  }
?>

</form>
</body>
</html>  
	