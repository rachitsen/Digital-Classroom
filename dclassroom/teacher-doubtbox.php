<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>


  
    
  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Doubt Box</title>
      <style> 
     :root {
  --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  --msger-bg: #fff;
  --border: 2px solid #ddd;
  --left-msg-bg: #ececec;
  --right-msg-bg: #579ffb;
}

html {
  box-sizing: border-box;
}

*,
*:before,
*:after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

body {
  /* display: flex; */
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-image: var(--body-bg);
  font-family: Helvetica, sans-serif;
}

.msger {
  /* display: flex; */
  flex-flow: column wrap;
  justify-content: space-between;
  width: 100%;
  /* max-width: 867px; */
  /* margin: 25px 10px; */
  height: calc(100% - 50px);
  /* border: var(--border); */
  border-radius: 5px;
  background: var(--msger-bg);
  box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
}

.msger-header {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  border-bottom: var(--border);
  background: #eee;
  color: #666;
}

.msger-chat {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
}
.msger-chat::-webkit-scrollbar {
  width: 6px;
}
.msger-chat::-webkit-scrollbar-track {
  background: #ddd;
}
.msger-chat::-webkit-scrollbar-thumb {
  background: #bdbdbd;
}
.msg {
  display: flex;
  align-items: flex-end;
  margin-bottom: 10px;
}
.msg:last-of-type {
  margin: 0;
}
.msg-img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  background: #ddd;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-radius: 50%;
}
.msg-bubble {
  max-width: 450px;
  padding: 15px;
  border-radius: 15px;
  background: var(--left-msg-bg);
}
.msg-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.msg-info-name {
  margin-right: 10px;
  font-weight: bold;
}
.msg-info-time {
  font-size: 0.85em;
}

.left-msg .msg-bubble {
  border-bottom-left-radius: 0;
}

.right-msg {
  flex-direction: row-reverse;
}
.right-msg .msg-bubble {
  background: var(--right-msg-bg);
  color: #fff;
  border-bottom-right-radius: 0;
}
.right-msg .msg-img {
  margin: 0 0 0 10px;
}

.msger-inputarea {
  display: flex;
  padding: 10px;
  border-top: var(--border);
  background: #eee;
}
.msger-inputarea * {
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 1em;
}
.msger-input {
  flex: 1;
  background: #ddd;
}
.msger-send-btn {
  margin-left: 10px;
  background: rgb(0, 196, 65);
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.23s;
}
.msger-send-btn:hover {
  background: rgb(0, 180, 50);
}

.msger-chat {
  background-color: #fcfcfe;
  
}

  </style>
  
  </head>
  <body style="background-color: #CDECFF">
  
   <nav class="navbar navbar-expand-lg navbar-dark " 
style="background-color:#333333">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      
        <li class="nav-item">
          <a class="nav-link" href="classrooms.php"><img src="images/dclogo.png" width="190" alt=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="class.php" style="padding-top: 4mm;">Classroom</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dash.php" style="padding-top: 4mm;">Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upload_notes.php" style="padding-top: 4mm;">Share Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teacher-doubtbox.php" style="padding-top: 4mm;">Doubt Box</a>
        </li>
        </ul>
        
        <span style="float:right">     <a class="nav-link active " style="background-color: white ;color:black;padding: 10px 20px;" aria-current="page" href="#" style="align:left; "><img src="images/profile.jpg" alt="..." height="26" style="border-radius: 50%;"> <?php echo ''.$_SESSION['username'].''?></a>
        </span>
        </div>
      </nav>
    <section class="msger">
    
    
    
   
    
 <header class="msger-header">
   <div class="msger-header-title">
     <i class="fas fa-comment-alt"></i> Doubt Box
    </div>
    <div class="msger-header-options">
      <span><i class="fas fa-cog"></i></span>
    </div>
    </header>
  <body>
  <?php
include "common/dbconnect.php";

$username = $_SESSION['username'];
$classid = $_SESSION['classid'];
$email = $_SESSION['email'];


$query = "SELECT * FROM `d_box` WHERE classid = '$classid'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{ 
	while($result=mysqli_fetch_assoc($data))
	 {
   $doubt_id = $result['doubt_id'];
        if($result['answer']==''){
     echo "
     <main class='msger-chat'>
     <div class='msg left-msg'>
       <div
        class='msg-img'
        style='background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgUNaoFwOOa3sOnMoc8CVUJ65bhS822etxVQ&usqp=CAU)'
       ></div>
       <div class='msg-bubble'>
      <div class='msg-info'>
    <div class='msg-info-name'>".$result['username']."</div>
    <div class='msg-info-time'>".$result['doubt-time']."</div>
    </div>
    <div class='msg-text'>
  
    ".$result['doubt']."
  </div>
  <form method='POST'>
 
  <button type='submit' name='button' value='$doubt_id' class='btn btn-primary' style='background-color:#64C9CF'><b>Reply</b></button>
  </form>  
  </div>
  </div>
  </div>
      
     
    
      </main>";
        }
   }
  }
    if(array_key_exists('button', $_POST)){
      $doubt_id = $_POST['button'];
     
      unset($_SESSION['doubt_id']);
      $_SESSION['doubt_id']=$doubt_id;
      echo "<meta http-equiv='refresh' content='0; url=chat.php'>";
    }   
  ?>






 <script type="text/javascript">
function mess(){

alert ("your record is successfully saved");
return true;

}
</script>

</body>
</html>