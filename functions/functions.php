<?php
    function checkLogin(){
        global $status;
        if(($_GET['id']) || (!empty($_GET['id']))){
            $status = 'logged in';    
        }else{
            header("Location: ./login.php");
        }
    
    }

    function FetchUser(){
        global $user;
        $id = $_SESSION['id'];
        if(isset($id)){
            try {
                $db = mysqli_connect('localhost','root','','chat-system');
                $query = "SELECT * FROM users WHERE `uid` = $id";
                $result = mysqli_query($db,$query);
                $user = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                mysqli_close($db);            
                
            } catch (Exception $e) {
                echo $e;
                
            }
        }else{
            header("Location: ./login.php");
        }
        

        
    }
?>