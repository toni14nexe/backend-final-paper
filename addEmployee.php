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
    
    $role = $_GET['role'];
    $password = $_GET['password'];
    $firstname = $_GET['fname'];
    $lastname = $_GET['lname'];
    $username = $_GET['username'];
    $fullname = $firstname . ' ' . $lastname;
    $employees = 'employees';
    
    $sql = "INSERT INTO `PurpleUsers`(`firstname`, `lastname`, `fullname`, `username`, `password`, `role`, `verified`, `email`, `verificationLink`) VALUES ('$firstname', '$lastname', '$fullname', '$username', '$password', '$role', 1, '', '')";
    if ($conn->query($sql) === TRUE) {
    } else {}
    $connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);  
    $sql = "SELECT * FROM PurpleUsers WHERE role='waiter' OR role='chef' ORDER BY fullname";  
    $result = mysqli_query($connect, $sql);  
    $json_array = array();  
    while($row = mysqli_fetch_assoc($result))  
    {  
        $json_array[] = $row;  
    }  
    file_put_contents($employees, json_encode($json_array));
    
    $conn->close();
    
    header("Location: $pageLink");
?>