<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  $loggedin=false;
}
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid" >
    <a class="navbar-brand" >Digital Classroom</a>
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
            echo '<div class="dropdown">
            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Features
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="/dclassroom/classrooms.php">Your Classrooms</a></li>
              <li><a class="dropdown-item" href="#">Personal profile</a></li>
            </ul>
          </div>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/dclassroom/logout.php">Logout</a>
        </li></ul>
        
        <div class="d-flex flex-row bd-highlight">
 <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;border-radius: 10%;" aria-current="page" href="#" style="align:left; "><img src="image/user2.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
</div>';
    }
      echo '
    </div>
  </div>
</nav>';
?>
 
 
  
