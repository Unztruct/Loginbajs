<?php 
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "inloggning");        

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
session_start();

$result=null;

if (isset($_SESSION["user"])){
   
}

else {
    $_SESSION["user"] = NULL;
   
}

if (isset($_POST["action"])) {
    
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT * FROM inloggning WHERE username='". $_POST["username"]."' AND password='". $_POST["pass"]."'";
    
    
  
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

}

        ?>

<!DOCTYPE html>

<html>
    <head>
        <link href="css.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title>Inloggningsmekanismgrej</title>
    </head>
    <body>
        <form method="post">
             Username: <input type="text" name="username"><br>
             Password: <input type="password" name="pass"><br><br>
             <input type="submit" value="Login" name="action">
             
        </form>



 <?php
 
 if ($result!=null){
        echo "loggad in ";
        
        $_SESSION["username"] = $_POST["username"];
        echo $_POST["username"];
        
        
    } else  {
         echo "loggad inte in";
        
        
    }
        
        ?>
        <form method="post">
        <input type="submit" value="Register" name="action2">
        </form>
        
        
        <?php 
        
        
        
        if (isset($_POST["action2"])){
        echo "<h1>Registrater</h1>";
        echo "<form method='post'>";
        echo "Choose username: <input type='text' name='regusername'><br>";
        echo "Choose Password: <input type='password' name='¨regpass'><br><br>";
        echo "<input type='submit' value='Submit' name='action3'>";
        echo "</form>";
        }
        
        
          $sql = "INSERT INTO inloggning(id,username,password) VALUES('','$name','$betar')";
        
        ?>
        
    </body>
</html>
