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

if (isset($_GET['login'])){
    $uname = $_GET['uname'];
    $pass = $_GET['pass'];

    $sql = "SELECT * FROM user WHERE username = '$uname' AND `password` = '$pass'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        // store the username 
        // go to the ame page
        echo "<script type='text/javascript'>

        sessionStorage.setItem('User', '$uname');
        sessionStorage.setItem('Login', 'true');
        location.href = 'game.html';

        </script>";
    }else{
        // login failed, go back to index.html
        echo "<script type='text/javascript'>

        sessionStorage.setItem('Login', 'false');
        location.href = 'index.html';

        </script>";
    }
}
?>