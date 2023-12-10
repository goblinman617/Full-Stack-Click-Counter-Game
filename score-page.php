<?php
$servername = "localhost";
$db_username = "bhanson";
$db_password = "password";
$db_name = "ccdb";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}else{
    
}


?>