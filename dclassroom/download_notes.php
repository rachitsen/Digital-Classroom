<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['typeid']=='student'){?>
  <meta http-equiv="refresh" content="0; url=home.php">
  <?php exit;
}
?>

<?php

include 'common/dbconnect.php';
$sql = "SELECT * FROM notes";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM `notes` WHERE id = $id ";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];
   
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE notes SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <meta charset="utf-8" />
  <title>Download Notes</title>
  <style>
      
      .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
   
    
    
}
.styled-table{
  margin-left: auto;
  margin-right: auto;
}


.styled-table thead tr {
    background-color: white;
    color: #1E90FF;
    font-size: 0.8cm;
    border-bottom: 3px solid #008080;
    text-align: left;
    
}
.styled-table th,
.styled-table td {
  font-weight: bolder;
    padding: 12px 15px;
    
}
.styled-table{
  background-color: white;
}
.styled-table tbody th {
    font-weight: bolder;
    border-bottom: 1px solid black;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 1px solid #B8B8B8;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
   

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: auto;
  border-radius: 20px;
  padding:3px;
  background-color: white;
  margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        text-align: center;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
}

.pcontainer {
  padding: 2px 26px;
}
#grad1 {
  height: 140px;
  background-color: red; /* For browsers that do not support gradients */
  background-image: linear-gradient(#36d1dc, #5b86e5);
}
  </style>
</head>
<body style=" background-color: WHITE;">

<?php 
if($_SESSION['typeid']=='teacher'){
include 'common/nav_teacher.php';
}
else
{
  if($_SESSION['typeid'] == 'Teacher'){
    include 'common/nav_teacher.php';
  }
  else{
    include 'common/nav_student.php';
  }
}
?>
<?php
include "common/dbconnect.php";
$classid= $_SESSION['classid'];
$query = "SELECT * FROM `classrooms` WHERE  classid= '$classid'";
$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);
if($total != 0)
{
  while($result=mysqli_fetch_assoc($data))
  {


echo'<div id="grad1" style{
    font-family: sans-serif;

}>
<br>
<h1 style="color:white;margin-left: 6%;">'.$result['class_name'].'</h1>
<p style="color:#FBF4E9;margin-left: 6%;">'.$result['class_details'].'</p>
</div>';


  }
}
?>
<?php
if($_SESSION['typeid']=='teacher'){
    echo '
<a href="upload_notes.php" style="text-decoration: none;">
    <div class="card pcontainer my-3">
  <h2 style= "color:#1D3458,">Upload Notes</h2>
</div>
</a>';
}
?>


<table class="styled-table" style="width:90%">
<thead>

    <th>Notes</th>
    <th style='text-align:center;'>Upload date</th>
    <th style='text-align:center;'>Downloads</th>
    <th style='text-align:center;'>Action</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr>
      <?php
      if($file['classid'] == $_SESSION['classid']){
          echo "
      <td>".$file['name']."</td>
      <td style='text-align:center;'>".$file['dou']."</td>
      <td style='text-align:center;'>".$file['downloads']."</td>
      <td style='text-align:center;'><a href='download_notes.php?file_id=".$file['id']."'><img width='10%'src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLPcET63gOdL2376TgvcFeyZS9o97v7WlOAw&usqp=CAU'></a></td>
    </tr>
      ";}
    ?>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>
