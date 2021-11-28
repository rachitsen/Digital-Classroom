<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>
   <?php
  if(isset($_POST['button2'])){
  
  include "common/dbconnect.php";
  $username = $_SESSION['username'];
$classid = $_SESSION['classid'];
$email = $_SESSION['email'];
  $doubt_id =$_SESSION['doubt_id'];
  $answer=$_POST['answer'];
  date_default_timezone_set("Asia/Calcutta");
$t=date("Y-m-d G:i:s");

    
      $sql="UPDATE d_box SET `answer` ='$answer' , `answer-time` ='$t' WHERE doubt_id='$doubt_id'";
      $result=mysqli_query($conn,$sql);
      
  }
  
    ?>
    <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

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
  <body>

  <?php  require 'common/nav_doubt.php'; ?>
    <?php
   
include "common/dbconnect.php";

$username = $_SESSION['username'];
$classid = $_SESSION['classid'];
$email = $_SESSION['email'];
$doubt_id =$_SESSION['doubt_id'];

$query = "SELECT * FROM `d_box` WHERE doubt_id = '$doubt_id'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{ 
	while($result=mysqli_fetch_assoc($data))
  {
    
     echo "
     <section class='msger'>";
     
    echo "
 <header class='msger-header'>
   <div class='msger-header-title'>
     <i class='fas fa-comment-alt'></i>";
     echo" ".$result['username']."
    </div>
    <div class='msger-header-options'>
      <span><i class='fas fa-cog'></i></span>
    </div>
  </header>
     <main class='msger-chat'>
      <div class='msg right-msg'>
        <div
         class='msg-img'
         style='background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)'
        ></div>
       
      <div class='msg-bubble'>
      
      <div class='msg-text'>
     <p class='card-text'>".$result['doubt']."</p>
     </div>
     </div>
     </div>
     <div class='msg left-msg'>
      <div class='msg-img'
      style='background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgUNaoFwOOa3sOnMoc8CVUJ65bhS822etxVQ&usqp=CAU)'
      ></div>
            <div class='msg-bubble'>
            <div class='msg-text'>
     <p class='card-text'>".$result['answer']."</p>
     </div>
      </div>
    </div>
    </main>
  
    ";
     
   }
  }
  ?>

<?php

    echo '

    <form method="POST" action="chat.php">
    
    <div class="form-group">
      <label for="answer"></label>
    <textarea  class="form-control" id="answer" name="answer" placeholder="leave your answer here"></textarea>
    </div>

    
    <form method="POST">
    
     <button type="submit" name="button2" value="$doubt_id" class="btn btn-primary" style="background-color:#64C9CF"><b>Reply</b></button>
     </form>
      
     </form>';
        
  ?>
  </body>
</html>