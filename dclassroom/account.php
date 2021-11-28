<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Digital Classroom </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php
include "common/dbconnect.php";
?>
<body style="background-color: #E0FFFF;">

<?php
 include "common/dbconnect.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Student'){
  ?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
else
{include "common/dbconnect.php";
  $username = $_SESSION['username'];
  $classid = $_SESSION['classid'];



}?>

<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#333333">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Digital Classroom</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><b> <a class="navbar-brand" href="home.php">
  <img src="images/dclogo.png" alt="Digital Classroom" width="200" alt="">
</a></b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li>
		<li class="pull-right"> <a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Signout</a></li>
		</ul>
            
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->



<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($conn,"SELECT * FROM quiz  WHERE classid='$classid' ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Starting Time</b></td><td><b>Ending Time</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
  $quiz_name = $row['quiz_name'];
	$total_que = $row['total_que'];
	$correct_marks = $row['correct_marks'];
  $start_time = $row['start_time'];
  $end_time = $row['end_time'];
	$quiz_id = $row['quiz_id'];
$q12=mysqli_query($conn,"SELECT score FROM history WHERE quiz_id='$quiz_id' AND username='$username'And classid='$classid'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	
  echo '<tr><td>'.$c++.'</td><td>'.$quiz_name.'</td><td>'.$total_que.'</td><td>'.$correct_marks*$total_que.'</td><td>'.$start_time.'&nbsp;min</td><td>'.$end_time.'&nbsp;min</td>';
  date_default_timezone_set("Asia/Calcutta");
$t=date("Y-m-d G:i:s");
if($t>$start_time && $t<$end_time)
{
echo'
	<td><b><a href="account.php?q=quiz&step=2&quiz_id='.$quiz_id.'&n=1&t='.$total_que.'&s='.$start_time.'&e='.$end_time.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else{
  echo '<td><b>
  <button type="button" class="btn btn-danger">Closed</button></b></td>';
}
echo'
  </tr>';
}
else
{
echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$quiz_name.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total_que.'</td><td>'.$correct_marks*$total_que.'</td><td>'.$start_time.'&nbsp;min</td><td>'.$end_time.'&nbsp;min</td>';

}
}
$c=0;
echo '</table></div></div>';

}?>
<!--<span id="countdown" class="timer"></span>
<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>-->

<!--home closed-->

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$quiz_id=@$_GET['quiz_id'];
$sn=@$_GET['n'];
$total_que=@$_GET['t'];
$start_time=@$_GET['s'];
$end_time=@$_GET['e'];
echo $start_time;
date_default_timezone_set("Asia/Calcutta");
$t=date("Y-m-d G:i:s");
if($t>$start_time && $t<$end_time){
$q=mysqli_query($conn,"SELECT * FROM questions WHERE quiz_id='$quiz_id' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$question_id=$row['question_id'];
echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
}
$q=mysqli_query($conn,"SELECT * FROM options WHERE question_id='$question_id' " );
echo '<form action="update.php?q=quiz&step=2&quiz_id='.$quiz_id.'&n='.$sn.'&t='.$total_que.'&question_id='.$question_id.'&s='.$start_time.'&e='.$end_time.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$option_id=$row['option_id'];
echo'<input type="radio" name="ans" value="'.$option_id.'">'.$option.'<br /><br />';
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
// header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}

  // header("location:account.php?q=1");

}












//result display
if(@$_GET['q']== 'result' && @$_GET['quiz_id']) 
{
$quiz_id=@$_GET['quiz_id'];
$q=mysqli_query($conn,"SELECT * FROM history WHERE quiz_id='$quiz_id' And username='$username'" );
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong_marks'];
$r=$row['correct_marks'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$q=mysqli_query($conn,"SELECT * FROM rank WHERE  classid='$classid' And usernme='$username' " )or die('');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
echo '</table></div>';

}
?>
<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($conn,"SELECT * FROM history WHERE classid='$classid' And username='$username' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$quiz_id=$row['quiz_id'];
$s=$row['score'];
$w=$row['wrong_marks'];
$r=$row['correct_marks'];
$qa=$row['level'];
$q23=mysqli_query($conn,"SELECT quiz_name FROM quiz WHERE  quiz_id='$quiz_id' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$quiz_name=$row['quiz_name'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$quiz_name.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//ranking start
if(@$_GET['q']== 3) 
{
$q=mysqli_query($conn,"SELECT * FROM rank WHERE classid='$classid' ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title"><div class="table-responsive">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Username</b></td><td><b>Email</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['username'];
$s=$row['score'];
$q12=mysqli_query($conn,"SELECT * FROM users WHERE username='$e'" )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$username=$row['username'];
$email=$row['email'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$username.'</td><td>'.$email.'</td><td>'.$s.'</td><td>';
}
echo '</table></div></div>';}
?>



</div></div></div></div>






</body>
</html>
