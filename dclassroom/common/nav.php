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
    <a class="nav-link active" aria-current="page" href="welcome.php" >Home</a>
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
              <li><a class="dropdown-item" href="/dclassroom/index.php">Mark Attendance</a></li>
              <li><a class="dropdown-item" href="#">Notes Section</a></li>
            </ul>
          </div>';
        echo '<li class="nav-item">
        
        
        <a class="nav-link" href="/dclassroom/logout.php">Logout</a>
        </li>
        </li>';
    }
      echo '</ul>
       class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>';
?>