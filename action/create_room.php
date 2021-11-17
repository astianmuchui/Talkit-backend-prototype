<?php
    if(isset($_GET['id'])){
        require_once '../classes/class_chatroom.php';
        $new = new chatroom;
        $new->constructRoom();
    }else{
        header('Location: ../login.php');
    }
?>