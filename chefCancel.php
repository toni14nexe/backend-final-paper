<?php
    $pageLink = 'https://toni-web.com/thepurplehat/refreshAPI.php';
    
    $table = $_GET['table'];
    
    file_put_contents('./tables/'.$table,"");
    
    header("Location: $pageLink");
?>