<?php
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css"> <?php include 'score-page.css'; ?> </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scores</title>
</head>
<body>


    <form action="" method="get" id="score-form">
        <input type="hidden" id="f-username" name="f-username" value=""></input>
        <br><br><br><br>
        <p>sort by</p>
        <input type="submit" id="top" name="top" value="top">
        <input type="submit" id="user-top" name="user-top" value="user-top">
        <input type="submit" id="newest" name="newest" value="newest">
    </form>

    <script type="text/javascript">

    function passUsername(){
        return sessionStorage.getItem("User");
    }
    </script>


    <table id="scores-table">
        <tr>
            <th>username</th>
            <th>total clicks</th>
            <th>clicks per second</th>
            <th>date achieved</th>
        </tr>

        <?php
            session_start();
            $num = 0;
            $servername = "localhost";
            $db_username = "bhanson";
            $db_password = "password";
            $db_name = "ccdb";

            $conn = new mysqli($servername, $db_username, $db_password, $db_name);

            if ($conn->connect_error){
                die("connection failed: " . $conn->connect_error);
            }

            if(isset($_GET["user-top"])){
                $num++;
                $username = $_SESSION['username'];

                $sql = "SELECT username, ctotal, cps, `date` FROM score WHERE username = '$username' ORDER BY ctotal DESC";

                $results = $conn->query($sql);

                $iter = 0;

                if ($results->num_rows > 0){
                    while ($row = $results->fetch_assoc()){
                        if ($iter < 10){
                            echo "<tr>" . "<td>" . $row["username"] . "</td>" . "<td>" . $row["ctotal"] . "</td>" . "<td>" . $row["cps"] . "</td>" . "<td>" . $row["date"] . "</td>" . "</tr>";
                            $iter++;
                        }
                    }
                }else{
                    echo "<tr><td> no scores for current user </td></td>";
                }

            }

            if(isset($_GET["newest"])){
                $num++;
                $sql = "SELECT * from score ORDER BY id DESC";

                $results = $conn->query($sql);

                $iter = 0;

                if ($results->num_rows > 0){
                    while ($row = $results->fetch_assoc()){
                        if ($iter < 10){
                            echo "<tr>" . "<td>" . $row["username"] . "</td>" . "<td>" . $row["ctotal"] . "</td>" . "<td>" . $row["cps"] . "</td>" . "<td>" . $row["date"] . "</td>" . "</tr>";
                            $iter++;
                        }
                    }
                }else{
                    echo "<tr><td> no scores</td></td>";
                }


            }

            //enter sort by top if we don't sort by anything else
            if(isset($_GET["top"]) || $num==0){

                $sql = "SELECT username, ctotal, cps, `date` FROM score ORDER BY ctotal DESC";

                $results = $conn->query($sql);

                $iter = 0;

                if ($results->num_rows > 0){
                    while ($row = $results->fetch_assoc()){
                        if ($iter < 10){
                            echo "<tr>" . "<td>" . $row["username"] . "</td>" . "<td>" . $row["ctotal"] . "</td>" . "<td>" . $row["cps"] . "</td>" . "<td>" . $row["date"] . "</td>" . "</tr>";
                            $iter++;
                        }
                    }
                }else{
                    echo "<tr><td> no scores</td></td>";
                }
            }

        ?>
    </table>

    <a href="game.html">
        <button type="button">game</button>
    </a>
    <br><br><br>
    <a href="index.html">
        <button type="button">logout</button>
    </a>
    
</body>
</html>