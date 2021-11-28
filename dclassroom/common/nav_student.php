<?php
    echo '<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#333333">
    <a class="navbar-brand" href="home.php">
  <img src="images/dclogo.png" alt="Digital Classroom" width="200" alt="">
</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
          <a class="nav-link" href="student-classroom.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student-class.php">Classroom</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="account.php?q=1">Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="download_notes.php">Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student-doubtbox.php">Doubt Box</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/dclassroom/logout.php">Logout</a>
        </li>
      </ul>
      
      <div class="d-flex flex-row bd-highlight">
      <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;" aria-current="page" href="#" style="align:left; "><img src="images/profile.jpg" alt="..." height="26" style="border-radius: 50%;"> '.$_SESSION['username'].'</a>
      </div>
  </nav>'

?>