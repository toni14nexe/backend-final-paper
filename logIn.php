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
    $password = $_GET['password'];
    $token = $_GET['token'];
    
    $stmt = $pdo->prepare("SELECT * FROM PurpleUsers WHERE username=? AND password=?");
    $stmt->execute([$username, $password]); 
    $user = $stmt->fetch();
    if ($user) {
        $sql = "UPDATE PurpleUsers SET token='$token' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT fullname, role, verified FROM PurpleUsers WHERE username='$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    if($row["verified"] == 1){
                        if($row["role"] == 'generator'){
                        $newCode = rand(1000,9999);
                        $sql = "UPDATE PurpleUsers SET fullname='$newCode' WHERE username='generator'";
                        if ($conn->query($sql) === TRUE) {
                            header("Location:".$pageLink."main/?newCode=" . $newCode . "&token=" . $token . "&ok=true&role=generator");
                        }
                        } else {
                            header("Location:".$pageLink."main/?username=" . $username . "&fullname=" . $row["fullname"] . "&token=" . $token . "&ok=new&role=" . $row["role"]);
                        }
                    } else {
                        header("Location: $pageLink?error");
                    }
                }
            } else {
                header("Location: $pageLink?error");
            }
        } else {
            header("Location: $pageLink?error");
        }
    } else {
        header("Location: $pageLink?wrongLogIn");
    }

    $conn->close();
?>