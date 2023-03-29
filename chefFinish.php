<?php
    $pageLink = 'https://toni-web.com/thepurplehat/refreshAPI.php';
    
    $table = $_GET['table'];
    $tableFile = file_get_contents('tables/' . $table);
    $tableFile = substr($tableFile, 0, 3) . '\"chef\":\"true\",' . substr($tableFile, 3);
    
    file_put_contents('./tables/'.$table, $tableFile);
    
    header("Location: $pageLink");
?>