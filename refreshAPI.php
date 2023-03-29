<?php
    $linkFile = 'link';
    $pageLink = file_get_contents($linkFile);

    $API = 'api';
    
    //host = 'localhost'
    $db_host = 'localhost';
    //user_root = 'root'
    $db_user = 'toniwebc_root';
    //pass_host = '' ili 'CD4}T7%PlYIKe9d*'
    $db_pass = 'Z_J6Dt^ExBr^';
    //dbname = 'zavrsni'
    $db_name = 'toniwebc_zavrsni';
    
    $wrongCode = $_GET['wrongCode'];
    
    $connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);  
    $sql = "SELECT * FROM PurpleProducts ORDER BY name";  
    $result = mysqli_query($connect, $sql);  
    $json_array = array();  
    while($row = mysqli_fetch_assoc($result))  
    {  
        $json_array[] = $row;  
    }  

    file_put_contents($API, json_encode($json_array));
    
    if($wrongCode == true){
        header("Location: $pageLink?wrongCode=true");
    }
    if($wrongCode == false){
        header("Location: $pageLink");
    }
?>