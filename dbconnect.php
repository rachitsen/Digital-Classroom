<?php
$servername="localhost";
$username="root";
$password= "";
$database="digitalclassroom";
$conn = mysqli_connect($servername , $username , $password, $database);
if(!$conn){
    // echo "connection was successful<br>";
// }
// else{
    die("sorry we failed to connect:". mysqli_connect_error());
}
?>
