<?php
    try {
        $db = mysqli_connect('localhost','root','','chat-system');
    } catch (Exception $e) {
        echo $e;
    }
?>