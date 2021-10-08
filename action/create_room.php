<?php
    if(isset($_GET['id'])){
        
        require_once '../classes/classes.php';
        $NewRoom = new chatroom();
        $NewRoom->BuildRoom();
        $_SESSION['chat_room'] = $this->chatroom_name;
        $_SESSION['recepientID'] = $this->get_id;
    }else{
        header('Location: ../login.php');
    }
?>