<?php
    $sess_id = '4';
    $get_id = '2';
    $db = mysqli_connect('localhost','root','','chat-system');
    $query = "SHOW TABLES"; # Query to get all chatrooms
    $result = mysqli_query($db,$query);
    $tables = mysqli_fetch_array($result,MYSQLI_NUM);
    // var_dump($tables);
    $table_name = $sess_id."and".$get_id;
    $inverted_name = $get_id."and".$sess_id;
    mysqli_free_result($result);
    mysqli_close($db);

    






?>