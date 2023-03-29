<?php
    $pageLink = 'https://toni-web.com/thepurplehat/refreshAPI.php';

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
    $connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);  
    
    $itemsNum = $_GET['itemsNum'];
    $order = $_GET['order'];
    $table = $_GET['table'];
    $genNum = $_GET['genNum'];
    $correctNum = false;
    $time = time();
    $JSON = '[';
    $tableFile = file_get_contents($table);
    
    $orderArray = json_decode($order, true);
    
    $sql = "SELECT fullname FROM PurpleUsers WHERE id<3";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if($row["fullname"] == $genNum){
              $correctNum = true;
          }
        }
    }else{}
    
    if($correctNum == true){
        for($i=0; $i<$itemsNum; $i++){
            $id = $orderArray[$i]["i"];
            $sql = "SELECT * FROM PurpleProducts WHERE id='" . $id . "'";  
            $result = mysqli_query($connect, $sql);  
            while($row = mysqli_fetch_assoc($result))  
            {  
                $oneRow[$i] = $row;
                $quantity = $oneRow[$i]['inStock'] - $orderArray[$i]["q"];
                $JSON = $JSON . '{"id":"' . $oneRow[$i]['id'] . '","name":"' . $oneRow[$i]['name'] . '","price":"' . $oneRow[$i]['price'] . '","quantity":"' . $orderArray[$i]['q' ]. '","sequence":"' . $orderArray[$i]["s"] . '", "time":"' . $time . '","type":"' . $oneRow[$i]['mainType'] . '"}';
                if($i < $itemsNum-1){
                    $JSON = $JSON . ',';
                }
                if($quantity < 0){
                    //  header("Location: $pageLink?placeOrder=failed&id=$id");; //////////////////////////////// issue #8
                } else{
                    /*if($oneRow[$i]['dependency'] > 0){
                        $dependency = $oneRow[$i]['dependency'];
                        $sql = "UPDATE PurpleProducts SET inStock='$quantity' WHERE id='$id'";
                        if ($conn->query($sql) === TRUE) {} else {}
                        $sql = "UPDATE PurpleProducts SET inStock='$quantity' WHERE id='$dependency'";
                        $JSON = $JSON . "]";
                        $JSON_file = array();
                        $JSON_file[] = $JSON;
                        file_put_contents($table, json_encode($JSON_file[0]));
                        if ($conn->query($sql) === TRUE) {
                        } else {
                        }
                    } else{
                        $sql = "UPDATE PurpleProducts SET inStock='$quantity' WHERE id='$id'";
                        $JSON = $JSON . "]";
                        $JSON_file = array();
                        $JSON_file[] = $JSON;
                        file_put_contents($table, json_encode($JSON_file[0]));
                        if ($conn->query($sql) === TRUE) {
                        } else {
                        }
                    }*/
                }
            }
            if($i == $itemsNum-1){
                $JSON = $JSON . "]";
                $JSON_file = array();
                $JSON_file[] = $JSON;
                file_put_contents($table, json_encode($JSON_file[0]));
            }
        }
        
        $conn->close();
        header("Location: $pageLink");
    }
    if($correctNum == false){
        $conn->close();
        header("Location: $pageLink?wrongCode=true");
    }
?>