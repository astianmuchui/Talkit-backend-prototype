<?php
    $feedback = '';
    function sanitizeForm($name,$_pwd){
        global $feedback;
        if(empty($name)){
            $feedback = '<small>Please enter your name</small>';
        }
        if(empty($_pwd)){
            $feedback = '<small>Please enter a password </small>';
        }
        if(!empty($name) && !empty($_pwd)){
            try {
                $db = mysqli_connect('localhost','root','','chat-system');
            } catch (Exception $e) {
                echo $e;
            }
            $query_one = "INSERT INTO users (`uname`,`pwd`) VALUES ('$name','$_pwd')";
            $act_one = mysqli_query($db,$query_one);
        }
    }
?>