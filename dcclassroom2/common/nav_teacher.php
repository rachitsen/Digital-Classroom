<?php
    echo '<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#333333">
    <a class="navbar-brand" href="Login_home.php">
  <img src="image/dclogo.png" alt="Digital Classroom" width="200" alt="">
</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
      
        <li class="nav-item">
          <a class="nav-link" href="classrooms.php">Classrooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upload_notes.php">Share Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Doubt Box</a>
        </li>
      </ul>
      
      <div class="d-flex flex-row bd-highlight">
      <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;border-radius: 10%;" aria-current="page" href="#" style="align:left; "><img src="image/user2.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
      </div>
  </nav>'

?>