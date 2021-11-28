<?php
include "common/dbconnect.php";
session_start();
$username=$_SESSION['username'];
$classid =$_SESSION['classid'];


//remove quiz
if($_SESSION['typeid'] == 'Teacher'){
  if(@$_GET['q']== 'rmquiz') {
$quiz_id=@$_GET['quiz_id'];

$result = mysqli_query($conn,"SELECT * FROM questions WHERE quiz_id='$quiz_id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$question_id = $row['question_id'];
$r1 = mysqli_query($conn,"DELETE FROM options WHERE question_id='$question_id'") or die('Error');
$r2 = mysqli_query($conn,"DELETE FROM answers WHERE question_id='$question_id' ") or die('Error');
}
$r3 = mysqli_query($conn,"DELETE FROM questions WHERE quiz_id='$quiz_id' ") or die('Error');
$r4 = mysqli_query($conn,"DELETE FROM quiz WHERE quiz_id='$quiz_id' ") or die('Error');

header("location:dash.php?q=5");
}
}
//add quiz
if($_SESSION['typeid'] == 'Teacher'){
if(@$_GET['q']== 'addquiz') {
 
$quiz_name = $_POST['name'];
$quiz_name= ucwords(strtolower($quiz_name));
$total_que = $_POST['total'];
$correct_marks = $_POST['right'];
$wrong_marks = $_POST['wrong'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$tag = $_POST['tag'];
$description = $_POST['desc'];
$quiz_id=uniqid();
$q3=mysqli_query($conn,"INSERT INTO quiz VALUES  ('$classid','$username','$quiz_id','$quiz_name' ,'$correct_marks' , '$wrong_marks','$total_que','$start_time','$end_time','$description','$tag', NOW())");

header("location:dash.php?q=4&step=2&quiz_id=$quiz_id&n=$total_que");
}
}

//add question
if($_SESSION['typeid'] == 'Teacher'){
if(@$_GET['q']== 'addqns' ) {
$n=@$_GET['n'];
$quiz_id=@$_GET['quiz_id'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
 $question_id=uniqid();
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($conn,"INSERT INTO questions VALUES  ('$quiz_id','$question_id','$qns' , '$ch' , '$i')");
  $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a=$_POST[$i.'1'];
$b=$_POST[$i.'2'];
$c=$_POST[$i.'3'];
$d=$_POST[$i.'4'];
$qa=mysqli_query($conn,"INSERT INTO options VALUES  ('$question_id','$a','$oaid')") or die('Error61');
$qb=mysqli_query($conn,"INSERT INTO options VALUES  ('$question_id','$b','$obid')") or die('Error62');
$qc=mysqli_query($conn,"INSERT INTO options VALUES  ('$question_id','$c','$ocid')") or die('Error63');
$qd=mysqli_query($conn,"INSERT INTO options VALUES  ('$question_id','$d','$odid')") or die('Error64');
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$answer_id=$oaid;
break;
case 'b':
$answer_id=$obid;
break;
case 'c':
$answer_id=$ocid;
break;
case 'd':
$answer_id=$odid;
break;
default:
$answer_id=$oaid;
}


$qans=mysqli_query($conn,"INSERT INTO answers VALUES  ('$question_id','$answer_id')");
if(!$qans)
{
  echo "error";
}
 }
header("location:dash.php?q=0");
}
}

//quiz start
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$quiz_id=@$_GET['quiz_id'];
$sn=@$_GET['n'];
$total_que=@$_GET['t'];
$ans=$_POST['ans'];
$start_time=@$_GET['s'];
$end_time=@$_GET['e'];

$question_id=@$_GET['question_id'];

$q=mysqli_query($conn,"SELECT * FROM answers WHERE question_id='$question_id' " );
while($row=mysqli_fetch_array($q) )
{
$answer_id=$row['answer_id'];
}
if($ans == $answer_id)
{
$q=mysqli_query($conn,"SELECT * FROM quiz WHERE quiz_id='$quiz_id' " );
while($row=mysqli_fetch_array($q) )
{
$correct_marks=$row['correct_marks'];
}
if($sn == 1)
{
$q=mysqli_query($conn,"INSERT INTO history VALUES('$classid','$username','$quiz_id' ,'0','0','0','0',NOW())")or die('Error');
}
$q=mysqli_query($conn,"SELECT * FROM history WHERE quiz_id='$quiz_id' AND username='$username' ")or die('Error115');

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['correct_marks'];
}
$r++;
$s=$s+$correct_marks;
$q=mysqli_query($conn,"UPDATE `history` SET `score`=$s,`level`=$sn,`correct_marks`=$r, date= NOW()  WHERE  username = '$username' AND quiz_id = '$quiz_id'")or die('Error124');

} 
else
{
$q=mysqli_query($conn,"SELECT * FROM quiz WHERE quiz_id='$quiz_id' " )or die('Error129');

while($row=mysqli_fetch_array($q) )
{
$wrong_marks=$row['wrong_marks'];
}
if($sn == 1)
{
$q=mysqli_query($conn,"INSERT INTO history VALUES('$classid','$username','$quiz_id' ,'0','0','0','0',NOW() )")or die('Error137');
}
$q=mysqli_query($conn,"SELECT * FROM history WHERE quiz_id='$quiz_id' AND username='$username' " )or die('Error139');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong_marks'];
}
$w++;
$s=$s-$wrong_marks;
$q=mysqli_query($conn,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong_marks`=$w, date=NOW() WHERE  username = '$username' AND quiz_id = '$quiz_id'")or die('Error147');
}
if($sn != $total_que)
{
$sn++;
header("location:account.php?q=quiz&step=2&quiz_id=$quiz_id&n=$sn&t=$total_que&s=$start_time&e=$end_time")or die('Error152');
}
else if($sn == $total_que)
{
$q=mysqli_query($conn,"SELECT score FROM history WHERE quiz_id='$quiz_id' AND username='$username'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($conn,"SELECT * FROM rank WHERE username='$username' and classid='$classid'" )or die('Error161');
$rowcount=mysqli_num_rows($q);
if($rowcount == 0)
{
$q2=mysqli_query($conn,"INSERT INTO rank VALUES('$classid','$username','$s',NOW())")or die('Error165');
}
else
{
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$s+$sun;
$q=mysqli_query($conn,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username='$username' and classid='$classid'")or die('Error174');
}
header("location:account.php?q=result&quiz_id=$quiz_id");
}
else
{
header("location:account.php?q=result&quiz_id=$quiz_id");
}

}

?>