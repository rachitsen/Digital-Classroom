<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Student'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>

 <?php
$added = false;
if  ($_SERVER['REQUEST_METHOD']=='POST')
{
include "common/dbconnect.php";
$username=$_SESSION['username'];
$classid =$_SESSION['classid'];
$email = $_SESSION['email'];
$doubt = $_POST['doubt'];
$doubt_id = uniqid();

date_default_timezone_set("Asia/Calcutta");
$t=date("Y-m-d G:i:s");
echo $t;
$sql ="INSERT INTO `d_box`(`username`, `classid`,`doubt_id`,`doubt`,`email`,`doubt-time`) VALUES ('$username','$classid','$doubt_id','$doubt','$email','$t')";
$result=mysqli_query($conn,$sql);
if($result)
{
 header("Location:/dclassroom/student-doubtbox.php");
 exit;
}
else{
  echo "code not working";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
  <section class="msger">
    <?php require 'common/nav_doubt.php';?>
    
 <header class="msger-header">
   <div class="msger-header-title">
     <i class="fas fa-comment-alt"></i> Doubt Box
    </div>
    <div class="msger-header-options">
      <span><i class="fas fa-cog"></i></span>
    </div>
  </header>
  <form method="POST" action="student-doubtbox.php" class="msger-inputarea">
    
    <input class="msger-input"  id="doubt" name="doubt"
    placeholder="Leave a doubt here">
    <!-- <label for="doubt"></label> -->
    <!-- </div> -->
    <input type="submit"  id="submit" class="msger-send-btn" value="submit" onclick="return mess();" >
  </form>
  
  
  <body style="background-color: #CDECFF">          
 


    

<?php
include "common/dbconnect.php";
$username= $_SESSION['username'];
$query = "SELECT * FROM `d_box` WHERE username = '$username'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total != 0)
{
	while($result=mysqli_fetch_assoc($data))
	 {
    
      echo "
      <main class='msger-chat'>
      <div class='msg right-msg'>
        <div
         class='msg-img'
         style='background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)'
        ></div>
       
      <div class='msg-bubble'>
      <div class='msg-info'>
    <div class='msg-info-name'>".$result['username']."</div>
    <div class='msg-info-time'>";?>
    <?php
   
    echo $result['doubt-time'];
    echo "</div>
    </div>
    <div class='msg-text'>
  
    ".$result['doubt']."
  </div>
  </div>
      </div>
      ";
      if($result['answer']!=''){echo"
      <div class='msg left-msg'>
      <div class='msg-img'
      style='background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgUNaoFwOOa3sOnMoc8CVUJ65bhS822etxVQ&usqp=CAU)'
      ></div>
            <div class='msg-bubble'>
              <div class='msg-info'>
                <div class='msg-info-name'>Teacher</div>
                <div class='msg-info-time'>".$result['answer-time']."</div>
                </div>
                <div class='msg-text'>
                ".$result['answer']."
                </div>
      </div>
    </div>";}
    echo "
    </main>";
      }
   
}
else
{
	echo "no doubts";
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