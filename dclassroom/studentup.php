<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Student'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}

?>
<?php
  include "common/dbconnect.php";
 
$username=$_SESSION['username'];
$query=mysqli_query($conn,"SELECT * FROM Students where username='$username'")or die(mysqli_error($conn));
$row=mysqli_fetch_array($query);
  ?>
<!DOCTYPE html>
<html lang="en-US">
  <html>
    <head>
    <title>Update Profile</title>
    <style>@import url('httpss://fonts.googleapis.com/css?family=Roboto');
	
	body {
        background-color: #CDECFF;
}

.signup-form {
  font-family: "Roboto", sans-serif;
  width:650px;
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
    margin-top: 10%;
  padding:10px 40px;
  color:#666;
  padding-bottom: 5%;
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
echo '
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#333333">
  <div class="container-fluid" >
 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#" >Digital Classroom</a>
        </li>
        
        
      
           <li class="nav-item">
         
       <a class="nav-link" href="student-classroom.php">Classrooms</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="studentshow.php">Personal Profile</a>
            </li>
            
           
        <li class="nav-item">
        <a class="nav-link" href="/dclassroom/logout.php">Logout</a>
        </li></ul>
        
        <div class="d-flex flex-row bd-highlight"  >
<a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;" aria-current="page" style="align:left; "><img src="image/user2.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
</div>';
    
      echo'
    </div>
  </div>
</nav>';
?>
<form class="signup-form" action="/dclassroom/studentup.php" method="post">

  <!-- form header -->
  <div class="form-header">
  </div>

  <!-- form body -->
  <div class="form-body">
     

<!-- Firstname and Lastname -->
<div class="horizontal-group">
<h1 style="color:#316B83;text-align:center">Update Details</h1><br>
  <div class="form-group left">
      <label for="name" class="label-title">Name *</label>
      <input type="text" id="name" class="form-input" name="name" value="<?php echo $row['fullname']; ?>" required="required" />
  </div>
  <div class="form-group right">
      <label for="email" class="label-title">Email *</label>
      <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" class="form-input"  />
  </div>
</div>

<div class="form-group">
  <label for="contact" class="label-title">Contact*</label>
  <input type="integer" id="contact" class="form-input" name="contact" value="<?php echo $row['contact']; ?>" required="required">
</div>
<!-- Gender and Hobbies -->
<div class="horizontal-group">

  <div class="form-group left">
      <label class="label-title">Gender:</label><?php echo $row['gender']; ?>
      <div class="input-group">
          <label for="male">
              <input type="radio" name="gender" value="male" id="male" required="required">Male</label>
          <label for="female">
              <input type="radio" name="gender" value="female" id="female" required="required">Female</label>
      </div>
  </div>

  <div class="form-group right">
      <label for="dob" class="label-title">Date Of Birth</label>
      <div>
          <label>
          <input type="date" class="form-control" value="<?php echo $row['dob']; ?>" name="dob" ></label>
          
      </div>
  </div>
  
</div>


<div class="horizontal-group">

<div class="form-group left">
  <label for="highestqualification" class="label-title">Highest Qualification *</label>
  <input type="text" id="highestqualification" class="form-input" name="highestqualification" value="<?php echo $row['highestqualification']; ?>" required="required">
</div>

<div class="form-group right">
  <label for="skills" class="label-title">Skills *</label>
  <input type="text" name="skills" class="form-input" id="skills" value="<?php echo $row['skills']; ?>" required="required">
</div>

</div>

<!-- Profile picture and Age -->
<div class="horizontal-group">

<div class="form-header">

<span><button type="submit" class="btn btn-primary">Update</button></span>

</div>

</form>

<?php

if(ISSET($_POST['email'])){
   
	$username=$_SESSION['username'];


	
	$name = $_POST['name'];
	$email  = $_POST['email'];
	$contact= $_POST['contact'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $highestqualification=$_POST['highestqualification'];
    $skills=$_POST['skills'];
    $query="UPDATE students SET  fullname='$name' , email='$email' , contact='$contact' , gender='$gender' , dob='$dob', highestqualification='$highestqualification',skills='$skills' WHERE username='$username'";
    $data=mysqli_query($conn,$query);
    if($data)
    {
    	echo "<font color='green'>record updated";

    }
    else
    	{echo "<font color='red'>record not updated";
      }
}


?>




</body>
</html>