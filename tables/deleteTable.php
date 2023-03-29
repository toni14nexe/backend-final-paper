<?php
    $linkFile = 'link';
    $pageLink = file_get_contents($linkFile);

    //host = 'localhost'
    $db_host = 'localhost';
    //user_root = 'root'
    $db_user = 'toniwebc_root';
    //pass_host = '' ili 'CD4}T7%PlYIKe9d*'
    $db_pass = 'Z_J6Dt^ExBr^';
    //dbname = 'zavrsni'
    $db_name = 'toniwebc_zavrsni';
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }

    $mysqli = NEW MySQLi($db_host, $db_user, $db_pass, $db_name);

    $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbu = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8',$db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $pdo = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8',$db_user, $db_pass);
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    
    $username = $_GET['username'];
    $newTableNum = $_GET['newTableNum'];
    $tableNumber = 'tableNumber';

    $sql = "DELETE FROM `PurpleUsers` WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
    } else {
    }

    file_put_contents($tableNumber, $newTableNum);
    
    $conn->close();
    
    header("Location: $pageLink");
?>