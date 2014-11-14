<?php

include 'form2.php';
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "user");

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
session_start();

$result = null;

if ($_SESSION["user"]!=null) {
    ECHO "INLOGGAASD";
} else {
    $_SESSION["user"] = NULL;
}

if (isset($_POST["action"])) {
    $user = $_POST["username"];
    $password = $_POST["pass"];
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT * FROM user WHERE username=:username AND password=:password";



    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":username", $user);
    $stmt->execute();
    $result = $stmt->fetch();





    if ($result != null) {
        echo "loggade in";

        $_SESSION["user"] = $_POST["username"];
        echo $_POST["username"];
        echo "<a href='phpiskill.php'>Kill le session</a>";
    } else {
        echo "inlogg misslyckad";
    }
}




if (isset($_POST["action2"])) {
    include 'form1.php';
}

if (isset($_POST["action3"])) {



    $reguser = $_POST["regusername"];
    $regpass = $_POST["regpass"];
    $sql = "INSERT INTO user(id,username,password) VALUES('','$reguser','$regpass')";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":regpassword", $regpass);
    $stmt->bindParam(":regusername", $reguser);
    $stmt->execute();
}
?>
        