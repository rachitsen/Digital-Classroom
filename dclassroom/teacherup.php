<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}

?>
<?php
  include "common/dbconnect.php";
 
$username=$_SESSION['username'];
$query=mysqli_query($conn,"SELECT * FROM teachers where username='$username'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
  ?>
<!DOCTYPE html>
<html lang="en-US">
  <html>
    <head>
    <title>Update Profile</title>
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
<form class="signup-form" action="/dclassroom/teacherup.php" method="post">

  <!-- form header -->
  <div class="form-header">
  </div>

  <!-- form body -->
  <div class="form-body">
     

<!-- Firstname and Lastname -->
<div class="horizontal-group">
<h2> Teacher Details</h2>
  <div class="form-group left">
      <label for="n" class="label-title">Name *</label>
      <input type="text" id="n" class="form-input" name="n" value="<?php echo $row['n']; ?>" required="required" />
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
      <label class="label-title">Gender:</label>
      <?php echo $row['gender'];?>
      <div class="input-group">
          <label for="male">
              <input type="radio" name="gender" value="male" id="male"> Male</label>
          <label for="female">
              <input type="radio" name="gender" value="female" id="female"> Female</label>
</div>
  </div>

  <div class="form-group right">
      <label for="doj" class="label-title">Date Of Joining</label>
      <div>
          <label>
          <input type="date" class="form-control" value="<?php echo $row['doj']; ?>" name="doj" ></label>
          
      </div>
  </div>
  
</div>


<div class="horizontal-group">

<div class="form-group left">
  <label for="degree" class="label-title">Degree  *</label>
  <input type="text" id="degree" class="form-input" name="degree" value="<?php echo $row['degree']; ?>" required="required">
</div>

<div class="form-group right">
  <label for="skills" class="label-title">Skills *</label>
  <input type="text" name="skills" class="form-input" id="skills" value="<?php echo $row['skills']; ?>" required="required">
</div>

</div>

<!-- Profile picture and Age -->
<div class="horizontal-group">

<div class="form-group left" >
<label for="choose-file" class="label-title">Upload Profile Picture</label>
<input type="file" id="choose-file" size="80">
</div>

<div class="form-group right">
<label for="yoe" class="label-title">Year Of Joining</label>
<input type="integer"   class="form-input" value="<?php echo $row['yoe']; ?>" name="yoe">
</div>

</div>


  
  
  <!-- form header -->
<div class="form-header">
<h1>Create Account</h1>
<span><button type="submit" class="btn btn-primary">Update</button></span>

</div>

</form>

<?php

if(ISSET($_POST['email'])){
   
	$username=$_SESSION['username'];


	
	$n = $_POST['n'];
	$email  = $_POST['email'];
	$contact= $_POST['contact'];
    $gender=$_POST['gender'];
    $doj=$_POST['doj'];
    $degree=$_POST['degree'];
    $skills=$_POST['skills'];
    $yoe=$_POST['yoe'];
    $query="UPDATE teachers SET  n='$n' , email='$email' , contact='$contact' , gender='$gender' , doj='$doj', degree='$degree',skills='$skills',yoe='$yoe' WHERE username='$username'";
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