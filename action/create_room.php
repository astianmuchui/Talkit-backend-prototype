<?php
    if(isset($_GET['id'])){
        require_once '../classes/classes.php';
        $NewRoom = new chatroom();
        $NewRoom->BuildRoom();
    }else{
        header('Location: ../login.php');
    }
?>