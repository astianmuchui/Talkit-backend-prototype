<?php
session_start();
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
            if($act_one){
                $query_two = "SELECT * FROM users WHERE `uname` = '$name' AND `pwd` = '$_pwd' LIMIT 1";
                $result = mysqli_query($db,$query_two);
                $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
                mysqli_free_result($result);
                mysqli_close($db);
                foreach ($users as $user){
                    $id = $user['uid'];
                    $finall = $id*7;
                    $_SESSION['id'] = $finall;
                    header("Location: ./profile.php?id=$finall");
                }

            }
        }
    }
    function getUsers(){
        global $users;
        try {
            $db = mysqli_connect('localhost','root','','chat-system');
        } catch (Exception $e) {
            echo $e;
        }      
        $query_two = "SELECT * FROM users";
        $result = mysqli_query($db,$query_two);
        $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($db);
       
    }
?>