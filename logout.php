<?php
    session_start();
    if($_GET['action']){
        if($_GET['action'] = 'logout'){
            if(session_destroy()){
                header("Location: ./login.php");
            }
        }
    }else{
        header("Location: ./login.php");
    }
?>