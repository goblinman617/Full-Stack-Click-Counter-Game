<?php 
session_start();
$servername = "localhost";
$db_username = "bhanson";
$db_password = "password";
$db_name = "ccdb";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}else{
    
}


if (isset($_POST['register'])){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $sql = "SELECT * FROM user WHERE username = '$uname'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        //username is taken
        echo "<script type='text/javascript'>

        sessionStorage.setItem('Login', 'false');
        location.href = 'register.html';

        </script>";

        return;
    }
    
    //username is valid

    $sql = "INSERT INTO user VALUES ('$uname', '$pass', '$fname', '$lname')";

    $conn->query($sql);

    $_SESSION['username'] = $uname;

    echo "<script type='text/javascript'>

    sessionStorage.setItem('User', '$uname');
    sessionStorage.setItem('Login', 'true');
    location.href = 'game.html';

    </script>";
}

?>