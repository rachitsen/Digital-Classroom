<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>

<?php
$created = false;
if  ($_SERVER['REQUEST_METHOD']=='POST')
{
include "common/dbconnect.php";
$username=$_SESSION['username']; 
$classname= $_POST['classname'];
$custom= $_POST['subject'];
$classdetails= $_POST['classdetails'];
$dateofcreation= date("d/m/y");
$classid = uniqid();

    $sql ="INSERT INTO `classrooms` (`username`, `classid`, `class_name`, `class_details`, `date_of_creation`, `costum`) VALUES ('$username', '$classid', '$classname', '$classdetails', '$dateofcreation', '$custom')";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
     $created = true;
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

    <title>Create Classroom</title>
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
form { 
margin: 1cm; 
width:450px;
}
.box{
margin-top: 1.5cm; 
width:600px; 
height: 420px;
box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 20px;
  padding:0.1px;
background:white;

}


</style>
  </head>
  <body style="background-color: #CDECFF;">
    <?php require 'common/nav.php' ?>
    <?php
     if($created)
     {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Successfully</strong> Your new classroom <b>'.$classname.'</b> is created.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
     }
    ?>
    <?php
  if($_SESSION['typeid']=='Teacher')
  {
    echo'<a href="classrooms.php" style="text-decoration: none;">
    <div class="card pcontainer my-3">
  <h2 style= "color:#1D3458,">All Classrooms</h2>
</div>
</a>';}
  ?>
    
    <!-- create classroom form -->
    <div class="container my-5 box">
      <h2 style="color: #316B83;text-align:center;font-weight:bolder">Create New Classroom</h2>
    <form action="addclassrooms.php" method="POST">
  <div class="mb-3 my-4">
    <label for="classname" class="form-label" style="color: #1D3458;text-align:center" ><b>Enter Classroom name</label>
    <input type="text"  name ="classname" class="form-control" id="classname" style="width: 500px;" required="required">

    <label for="classname" class="form-label my-3" style="color: #1D3458;" >Enter Subject</label>
    <input type="text"  name="subject" class="form-control" id="classname" style="width: 500px;" required="required" >
    
  <div class="mb-3">
    <label for="classdetails" class="form-label my-3" style="color: #1D3458;">Enter Classroom Details</label>
    <div class="form-outline">
  <textarea class="form-control"  name = "classdetails" id="classdetails" rows="2" style="width: 500px;" required="required"></textarea>
</div>
  </div>
  <span><button type="submit" class="btn btn-primary" style="background-color: #64C9CF;border-color:unset">Create</button></span>
</form>

    </div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>