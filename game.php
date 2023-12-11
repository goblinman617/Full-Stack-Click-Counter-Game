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
    // we connected
}


if(isset($_POST['restart-game'])){
    $uname = $_POST['f-username'];
    $clicks = $_POST['f-clicks'];
    $cps = $_POST['f-cps'];
    $date = $_POST['f-date'];

    if ($clicks == "" || $clicks == "0"){ // no saving
        echo "<script type='text/javascript'>

        location.href = 'game.html';

        </script>";

        return;
    }

    $clicks = intval($clicks);
    $cps = floatval($cps);

    $sql = "INSERT INTO score (username, ctotal, cps, `date`) VALUES ('$uname', $clicks, $cps, '$date')";

    if ($conn->query($sql) == true){
        echo "<script type='text/javascript'>

        location.href = 'game.html';

        </script>";
    }else{
        echo "ERROR";
    }

}

if(isset($_POST['view-scores'])){
    $uname = $_POST['f-username'];
    $clicks = $_POST['f-clicks'];
    $cps = $_POST['f-cps'];
    $date = $_POST['f-date'];

    if ($clicks == "" || $clicks == "0"){ // no score to save
        echo "<script type='text/javascript'>

        location.href = 'score-page.php';

        </script>";

        return;
    }

    $clicks = intval($clicks);
    $cps = floatval($cps);

    $sql = "INSERT INTO score (username, ctotal, cps, `date`) VALUES ('$uname', $clicks, $cps, '$date')";

    if ($conn->query($sql) == true){
        echo "<script type='text/javascript'>

        location.href = 'score-page.php';

        </script>";
    }else{
        echo "ERROR";
    }

    return;
}

if(isset($_POST['logout'])){
    $uname = $_POST['f-username'];
    $clicks = $_POST['f-clicks'];
    $cps = $_POST['f-cps'];
    $date = $_POST['f-date'];

    if ($clicks == "" || $clicks == "0"){ // no score to save
        echo "<script type='text/javascript'>

        sessionStorage.removeItem('User');
        location.href = 'index.html';

        </script>";

        return;
    }

    $clicks = intval($clicks);
    $cps = floatval($cps);

    $sql = "INSERT INTO score (username, ctotal, cps, `date`) VALUES ('$uname', $clicks, $cps, '$date')";

    if ($conn->query($sql) == true){
        echo "<script type='text/javascript'>

        sessionStorage.removeItem('User');
        location.href = 'index.html';

        </script>";
    }else{
        echo "ERROR";
    }
}

?>