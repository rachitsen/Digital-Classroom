<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Digital Classroom</title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!-- navbar fuction  -->

</head>

<body  style="background:#E0FFFF;">

<?php
 include "common/dbconnect.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']!='Teacher'){
  ?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;

}
else
{     
  include "common/dbconnect.php";
  $username = $_SESSION['username'];
  $classid = $_SESSION['classid'];


}?>

</div></div>
<!-- admin start-->

<!--navigation menu-->
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#333333 ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Digital Classroom</span>
        <span class="icon-bar"></span>
         <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php?q=0"><b><a class="navbar-brand" href="home.php">
  <img src="images/dclogo.png" alt="Digital Classroom" width="200" alt="">
</a></b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0">Home<span class="sr-only">(current)</span></a></li>


		<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2">Ranking</a></li>


        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quiz<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dash.php?q=4">Add Quiz</a></li>
            <li><a href="dash.php?q=5">Remove Quiz</a></li>
			
          </ul>
        </li><li class="pull-right"> <a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Signout</a></li>
		
      </ul>
          </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->

<?php if(@$_GET['q']==0) {

$result = mysqli_query($conn,"SELECT * FROM quiz WHERE classid='$classid' ORDER BY date DESC") or die('Error');
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
$q12=mysqli_query($conn,"SELECT score FROM history WHERE quiz_id='$quiz_id' AND username='$username' AND classid='$classid'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$quiz_name.'</td><td>'.$total_que.'</td><td>'.$correct_marks*$total_que.'</td><td>'.$start_time.'&nbsp;min</td><td>'.$end_time.'&nbsp;min</td>
  ';

  echo'
  
	<td><b><a href="dash.php?q=display_qz&step=7&quiz_id='.$quiz_id.'&n=1&t='.$total_que.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Open</b></span></a></b>
  </td>';
  
  echo'
  </tr>';
}
else
{
echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$quiz_name.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total_que.'</td><td>'.$correct_marks*$total_que.'</td><td>'.$time.'&nbsp;min</td>
	</tr>';
}
}
$c=0;
echo '</table></div></div>';

}

//ranking start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($conn,"SELECT * FROM rank WHERE classid='$classid' ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title"><div class="table-responsive">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>Email</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$username=$row['username'];
$s=$row['score'];
$q12=mysqli_query($conn,"SELECT * FROM users WHERE username='$username'" )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$username=$row['username'];
$email=$row['email'];

$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$username.'</td><td>'.$email.'</td><td>'.$s.'</td><td>';
}
}
echo '</table></div></div>';}

?>


<!--home closed-->






<!--add quiz start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step']) ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Quiz Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">
    
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="right"></label>  
  <div class="col-md-12">
  <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="wrong"></label>  
  <div class="col-md-12">
  <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="start_time"></label>  
  <div class="col-md-12">
  <input id="start_time" name="start_time" placeholder="Enter starting time for test " class="form-control input-md" min="1" type="datetime-local">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="end_time"></label>  
  <div class="col-md-12">
  <input id="end_time" name="end_time" placeholder="Enter ending time for test " class="form-control input-md" min="1" type="datetime-local">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="tag"></label>  
  <div class="col-md-12">
  <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="desc"></label>  
  <div class="col-md-12">
  <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>
<!--add quiz end-->

<!--add quiz step2 start-->
<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&quiz_id='.@$_GET['quiz_id'].'&ch=4 "  method="POST">
<fieldset>
';
 
 for($i=1;$i<=@$_GET['n'];$i++)
 {
echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
  <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
   <option value="a">Select answer for question '.$i.'</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?><!--add quiz step 2 end-->

<!--remove quiz-->
<?php if(@$_GET['q']==5) {

$result = mysqli_query($conn,"SELECT * FROM quiz WHERE classid = '$classid' ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Start Time </b></td><td><b>End Time </b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$quiz_name = $row['quiz_name'];
	$total_que = $row['total_que'];
	$correct_marks = $row['correct_marks'];
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];
	$quiz_id = $row['quiz_id'];
	echo '<tr><td>'.$c++.'</td><td>'.$quiz_name.'</td><td>'.$total_que.'</td><td>'.$correct_marks*$total_que.'</td><td>'.$start_time.'&nbsp;min</td><td>'.$end_time.'&nbsp;min</td>
	<td><b><a href="update.php?q=rmquiz&quiz_id='.$quiz_id.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
}
$c=0;
echo '</table></div></div>';

}






//display question and answer

if(@$_GET['q']== 'display_qz' && @$_GET['step']== 7 && $_SESSION['typeid'] == 'Teacher') {
  $quiz_id=@$_GET['quiz_id'];
  $sn=1;
  $total_que=@$_GET['t'];
  $q=mysqli_query($conn,"SELECT * FROM questions WHERE quiz_id='$quiz_id' " );
  

  while($row=mysqli_fetch_array($q) )
  {
    echo '<div class="panel" style="margin:5%">';
  $qns=$row['qns'];
  $question_id=$row['question_id'];
  echo '<b><br>Question &nbsp;'.$sn.'</b><b>) &nbsp'.$qns.'</b><br /><br />';
  
  $q1=mysqli_query($conn,"SELECT * FROM options WHERE question_id='$question_id' " );
  while($row1=mysqli_fetch_array($q1) )
  {
  $option=$row1['option'];
  $option_id=$row1['option_id'];
  echo ''.$option.'<br /><br />';
  }
 $q2=mysqli_query($conn,"SELECT * FROM answers WHERE question_id='$question_id' " );
 while($row2=mysqli_fetch_assoc($q2)){
 $answer_id=$row2['answer_id'];
 
 $q3=mysqli_query($conn,"SELECT * FROM options WHERE option_id='$answer_id' " );
 while($row3=mysqli_fetch_assoc($q3)){
  $option=$row3['option'];
  echo '<b><br>Answer &nbsp;'.$sn.'</b><b>) &nbsp'.$option.'</b><br /><br />';
  $sn++;
 }
}
echo '</div>';
  }
  
 
  
  
  
  // header("location:dash.php?q=4&step=2&eid=$id&n=$total");
  }



?>


</div><!--container closed-->
</div></div>
</body>
</html>
