<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  $loggedin=false;
}
echo '
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#333333">
  <div class="container-fluid" >
  <a class="navbar-brand" href="Login_home.php">
  <img src="image/dclogo.png" width="200" alt="">
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="home.php" >Home</a>
        </li>';
        
        if(!$loggedin){
       echo '<li class="nav-item">
      <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Signup</a>
        </li>';
        }
        if($loggedin){
          echo '<li class="nav-item">';
          if($_SESSION['typeid']=='Student'){
      echo '<a class="nav-link" href="student-classroom.php">Classrooms</a>
        </li>';}
        else{
        echo '<li class="nav-item">
          <a class="nav-link" href="classrooms.php">Classrooms</a>
        </li>';
        }
        if($_SESSION['typeid']=='Student'){
          echo '<a class="nav-link" href="studentshow.php">Personal Profile</a>
            </li>';}
            else{
            echo '<li class="nav-item">
              <a class="nav-link" href="teachershow.php">Personal Profile</a>
            </li>';
            }
        echo '<li class="nav-item">
        <a class="nav-link" href="/dclassroom/logout.php">Logout</a>
        </li></ul>
        
        <div class="d-flex flex-row bd-highlight"  >
<a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;" aria-current="page" style="align:left; "><img src="image/user2.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
</div>';
    }
      echo'
    </div>
  </div>
</nav>';
?>
 
 
  