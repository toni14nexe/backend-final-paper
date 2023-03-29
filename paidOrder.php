<?php
    $pageLink = 'https://toni-web.com/thepurplehat/refreshAPI.php';
    
    $table = $_GET['table'];
    $tableFile = file_get_contents('tables/' . $table);
    $tableFile = substr($tableFile, 0, 3) . '\"waiter\":\"true\",\"tableName\":\"' . $table . '\",' . substr($tableFile, 3);
    
    $allOrders = file_get_contents('tables/allOrders');
    if(strlen($allOrders)<2){
        $allOrders = '[' . $tableFile . ']';
    }else{
        $allOrders = substr($allOrders, 0, strlen($allOrders)-1) . ',' . $tableFile . substr($allOrders, strlen($allOrders)-1);
    }
    file_put_contents('./tables/'.$table, '');
    file_put_contents('./tables/allOrders', $allOrders);
    
    header("Location: $pageLink");
?>