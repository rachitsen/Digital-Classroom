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
    width: 85%;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.30);
    
}
.styled-table thead tr {
    background-color: #6D8299;
    color: #ffffff;
    text-align: center;
    font-size: 5mm;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
    border-color: #CDECFF;
    
}
.styled-table tbody tr {
    border-bottom: 1px solid #A9E4D7;
}
.styled-table tbody tr:nth-of-type(odd) {
    background-color: #ffffff;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #22577A;
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
  </style>
</head>
<body style=" background-color: #CDECFF;">
<?php 
if($_SESSION['typeid']=='teacher'){
include 'common/nav_teacher.php';
}
else
{
    include 'common/nav_student.php';
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


<table class="styled-table " style=" margin-left: auto;margin-right: auto;">
<thead>

    <th>Notes</th>
    <th>Upload date</th>
    <th>Downloads</th>
    <th>Action</th>
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
      <td style='text-align:center;'><a href='download_notes.php?file_id=".$file['id']."'>Download</a></td>
    </tr>
      ";}
    ?>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>
