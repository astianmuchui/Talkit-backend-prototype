<?php
session_start();
#=============================================================================================================================================#
    class PDODatabase{
        private $host = 'localhost';
        private $db_name = 'chat-system';
        private $username = 'root';
        private $password = '';
        private $conn;
        public function connectDB(){
            $this->conn = null;
            try{
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $this->conn;
        }
    }
    class vanillaDB{
        public function connect(){
             try {
            $db = mysqli_connect('localhost','root','','chat-system');
            return $db;
        } catch (Exception $e) {
            echo $e;
        }
    }
}
#============================================================================================================================================#
    class chatroom{
        private $session_id;
        private $get_id;
        private $db;
        private $chatroom_name;
        public function BuildRoom(){
            global $db;
            $this->session_id = $_SESSION['id'];
            $this->get_id = $_GET['id'];
            #Ensure That one doesn"t create a chatroom with him/herself 
            if($this->session_id == $this->get_id){
                $pageID = $this->session_id*7;
                header("Location: ../profile.php");                
            }else{
                $this->db = mysqli_connect('localhost','root','','chat-system');
                $this->chatroom_name = base64_encode($this->session_id ."and". $this->get_id);
                $inverted_name = base64_encode($this->get_id."and". $this->session_id); 
                #Check for the existence of the chatroom
                $query = "SHOW TABLES;"; # Query to get all chatrooms
                $result = mysqli_query($this->db,$query);
                $tables = mysqli_fetch_array($result,MYSQLI_NUM);
                mysqli_free_result($result);
                foreach ($tables as $table){
                    if($this->chatroom_name == $table[0]){
                        //FUNCTION TO REDIRECT HERE
                        $_SESSION['chat_room'] = $this->chatroom_name;
                        $_SESSION['recepientID'] = $this->get_id;
                        header("Location: ../chat.php");
                    }else{
                        if($inverted_name == $table[0]){
                            $_SESSION['chat_room'] = $inverted_name;
                            $_SESSION['recepientID'] = $this->get_id;
                            header("Location: ../chat.php");
                        }else{
                            # CREATE CHAT ROOM IF ITS NOT PRE-EXISTING
                            $create = "CREATE TABLE `$this->chatroom_name` (
                                `id` int(255) NOT NULL,
                                `id_1` varchar(255) NOT NULL,
                                `id_2` varchar(255) NOT NULL,
                                `message` varchar(255) NOT NULL,
                                `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                                $buildRoom = mysqli_query($this->db,$create);
                            if($buildRoom){
                                    #ADD PRIMARY KEY TO THE ID
                                $alter =  "ALTER TABLE `$this->chatroom_name` CHANGE `id` `id` INT(255) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`)";
                                $run = mysqli_query($this->db,$alter);

                                if($run){
                                    //Insert record
                                    //Make session variables
                                    $_SESSION['chat_room'] = $this->chatroom_name;
                                    $_SESSION['recepientID'] = $this->get_id;
                                    header("Location: ../chat.php");
                                    //redirect to relevant page
                                }
                            }
                        }
                    }
                }

                mysqli_close($this->db);
            }
    }
}    
#=============================================================================================================================================================================================#
    class encryption{
        private $password;
        public function encrypt(){
            $this->password = $_POST['p_wd'];
            global $password,$final_passcode;    
            $randLetters =  array("545HDFGXMFNJDHHSCFNGJIFNFG",
            "7899KIOVFNENFDDSVJBITHGVBAKFRYFJVNFFKMVNDORU",
            "64977VTGIZXHKCHJDGWFYDINHCVKVOEJFEOFLRVVJPE",
            "450KICADMPJHFBGHFVHFBFJBNRFNDGJBNFIO",
            "JTTSXCLAORVJOD328FBFJBNFTSFJNBIN",
            "JSQMLFHAM468ASBFEHIFJVNGKCFJNV",
            "ATMEGA328PCBCVGJRFJVNRGKDIHVDU",
            "OHM546CCSCJFGBKSDHYGDYEFJKNFJ",
            "ASSASCOUDWITEOGIAV4555VNIDNDOXD",
            "D8979HFGHJHGDIRBVFMGNJGHRUFB",
            "J261646VHGIGHRBGXVCGJGFVFHFBF",
            "PF658979JGOJGRGIVCBUVSREPVIEYLD",
            "NE555CCHGHJIWNDBGJFHFHDBFLOYDHSKA",
            "TADA2030GTROUYVHDGHFVBJKSASASAKAK");  
            $randNo = rand(0,14);
            $base = $randLetters[$randNo];
            $encoded_base64 = base64_encode($password);
            $final_passcode = ".'$base.$encoded_base64'.";
        }   
    }   
#================================================================================================================================================================================#
    class encryptedUser{
        private $username;
        private $password;
        private $encrypted_password;
        public function CreateUser($username,$password){
            global $feedback;
            $this->username = $_POST['u_name'];
            $this->password = $_POST['p_wd'];
            //Sanitize form
            if(empty($this->username)){
                $feedback = "Please enter your name";
            }
            if(empty($this->password)){
                $feedback = "Please create a password";
            }
            if((!empty($this->username) )&& (!empty($this->password)) && !(filter_var($this->password,FILTER_VALIDATE_INT) == FALSE)){
                try{
                    #ENCRYPTION ALGORITHM
                    $this->password = $_POST['p_wd'];
                    $randLetters =  array("545HDFGXMFNJDHHSCFNGJIFNFG",
                    "7899KIOVFNENFDDSVJBITHGVBAKFRYFJVNFFKMVNDORU",
                    "64977VTGIZXHKCHJDGWFYDINHCVKVOEJFEOFLRVVJPE",
                    "450KICADMPJHFBGHFVHFBFJBNRFNDGJBNFIO",
                    "JTTSXCLAORVJOD328FBFJBNFTSFJNBIN",
                    "JSQMLFHAM468ASBFEHIFJVNGKCFJNV",
                    "ATMEGA328PCBCVGJRFJVNRGKDIHVDU",
                    "OHM546CCSCJFGBKSDHYGDYEFJKNFJ",
                    "ASSASCOUDWITEOGIAV4555VNIDNDOXD",
                    "D8979HFGHJHGDIRBVFMGNJGHRUFB",
                    "J261646VHGIGHRBGXVCGJGFVFHFBF",
                    "PF658979JGOJGRGIVCBUVSREPVIEYLD",
                    "NE555CCHGHJIWNDBGJFHFHDBFLOYDHSKA",
                    "TADA2030GTROUYVHDGHFVBJKSASASAKAK");  
                    $randNo = rand(0,14);
                    $base = $randLetters[$randNo];
                    $encoded_base64 = base64_encode($password);
                    $final_passcode = $base.$encoded_base64;
                    $u_name = base64_encode($this->username);
                    $sql = "INSERT INTO users (`uname`,`pwd`) VALUES ('$u_name','$final_passcode')";
                    $db = mysqli_connect('localhost','root','','chat-system');    
                    if(mysqli_query($db,$sql)){
                        $query = "SELECT * FROM users WHERE `uname` = '$u_name' AND `pwd` = '$final_passcode' LIMIT 1";
                        $result = mysqli_query($db,$query);
                        $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
                        mysqli_free_result($result);
                        foreach ($users as $user){
                            $id = $user['uid'];
                            $finall = $id;
                            $_SESSION['id'] = $finall;
                            $layer_one = base64_encode($user['uid']);
                            $layer_two = base64_encode($layer_one);
                            $layer_three = base64_encode($layer_two);
                            header("Location: ./profile.php?id=$layer_three");
                        }
                        mysqli_close($db);
                    }
                }catch(PDOException $f){
                    $feedback = "Couldn't signup <br>".$f->getMessage();
                }
            }
        }
    }
#=====================================================================================================================================================================================#
    class PasswordEncryption{
        private $pwd;
        private $randLetters;
        private $name;
        public function encryptPassword(){
            $this->name = $_POST['u_name'];
            $this->pwd = $_POST['p_wd']; 
            $randLetters =  array("545HDFGXMFNJDHHSCFNGJIFNFG",
            "7899KIOVFNENFDDSVJBITHGVBAKFRYFJVNFFKMVNDORU",
            "64977VTGIZXHKCHJDGWFYDINHCVKVOEJFEOFLRVVJPE",
            "450KICADMPJHFBGHFVHFBFJBNRFNDGJBNFIO",
            "JTTSXCLAORVJOD328FBFJBNFTSFJNBIN",
            "JSQMLFHAM468ASBFEHIFJVNGKCFJNV",
            "ATMEGA328PCBCVGJRFJVNRGKDIHVDU",
            "OHM546CCSCJFGBKSDHYGDYEFJKNFJ",
            "ASSASCOUDWITEOGIAV4555VNIDNDOXD",
            "D8979HFGHJHGDIRBVFMGNJGHRUFB",
            "J261646VHGIGHRBGXVCGJGFVFHFBF",
            "PF658979JGOJGRGIVCBUVSREPVIEYLD",
            "NE555CCHGHJIWNDBGJFHFHDBFLOYDHSKA",
            "TADA2030GTROUYVHDGHFVBJKSASASAKAK");  
            $randNo = rand(0,14);
            $encoded_base64 = base64_encode($this->pwd);
            $final_passcode = $encoded_base64;
        }  
    }
#=================================================================================================================================================================================#
    class PasswordDecryption extends PasswordEncryption{
        private $password;
        public function decryptPassword(){
            global $feedback;
            $this->name = $_POST['u_name'];
            $this->pwd = $_POST['p_wd']; 
            $this->randLetters =  array("545HDFGXMFNJDHHSCFNGJIFNFG",
            "7899KIOVFNENFDDSVJBITHGVBAKFRYFJVNFFKMVNDORU",
            "64977VTGIZXHKCHJDGWFYDINHCVKVOEJFEOFLRVVJPE",
            "450KICADMPJHFBGHFVHFBFJBNRFNDGJBNFIO",
            "JTTSXCLAORVJOD328FBFJBNFTSFJNBIN",
            "JSQMLFHAM468ASBFEHIFJVNGKCFJNV",
            "ATMEGA328PCBCVGJRFJVNRGKDIHVDU",
            "OHM546CCSCJFGBKSDHYGDYEFJKNFJ",
            "ASSASCOUDWITEOGIAV4555VNIDNDOXD",
            "D8979HFGHJHGDIRBVFMGNJGHRUFB",
            "J261646VHGIGHRBGXVCGJGFVFHFBF",
            "PF658979JGOJGRGIVCBUVSREPVIEYLD",
            "NE555CCHGHJIWNDBGJFHFHDBFLOYDHSKA",
            "TADA2030GTROUYVHDGHFVBJKSASASAKAK");  
            $conn = mysqli_connect('localhost','root','','chat-system');
            $u_bs64 = base64_encode($this->name);
            $query = "SELECT * FROM `users` where `uname` = '$u_bs64'";
            $result = mysqli_query($conn,$query);
            $user = mysqli_fetch_assoc($result);                
            if($user == true){
                mysqli_free_result($result);
                mysqli_close($conn);
                //User exists 
                //Proceed to check for password
                $upwd = $user['pwd'];
                foreach($this->randLetters as $randLetter){
                    if(strpos($upwd,$randLetter) !== false){
                        //Remove the cryptic letters
                        $pwd_len = strlen($upwd);
                        $rand_Len = strlen($randLetter);
                        //Decrypt
                        $base64Encoded = substr($upwd,$rand_Len,$pwd_len);
                        $actual_password = base64_decode($base64Encoded);
                        if($this->pwd === $actual_password){
                            $_SESSION['id'] = $user['uid'];
                            //Triple encoding for the id
                            $layer_one = base64_encode($user['uid']);
                            $layer_two = base64_encode($layer_one);
                            $layer_three = base64_encode($layer_two);
                            header("Location: ./profile.php?id=$layer_three");
                        }else{
                            //Wrong password 
                            $feedback = "Wrong password";
                        }
                    }else{
                        //Nothing here
                    }

                }
            }else{
                //Wrong username
                $feedback = "Invalid username";
            }   
        }
    }
#=================================================================================================================================================================================#

    class users {
       public function getUsers(){
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
    }
#=================================================================================================================================================================================#

    class user{
        private $person;
        public function FetchUser(){
            global $user,$db;
            try{
                $id = $_GET['id'];
                $layer_one_id = base64_decode($id);
                $layer_two_id = base64_decode($layer_one_id);
                $actual_id = base64_decode($layer_two_id);
                global $actual_id;
                $_SESSION['id'] = $actual_id;
                $db = mysqli_connect('localhost','root','','chat-system');
                $query = "SELECT * FROM `users` WHERE `uid` = '$actual_id'";
                $result = mysqli_query($db,$query);
                $user = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                mysqli_close($db);

            }catch(Exception $e){
                print $e;
            }
        }
    }
#=================================================================================================================================================================================#
  class ChatUser{
    public function GetChatUser(){
        global $user,$db;
        try{
            $id = $_SESSION['id'];
            $db = mysqli_connect('localhost','root','','chat-system');
            $query = "SELECT * FROM `users` WHERE `uid` = '$id'";
            $result = mysqli_query($db,$query);
            $user = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($db);
        }catch(Exception $e){
            print $e;
        }
    }
  }  

#=================================================================================================================================================================================#
class chatReceiver{
    public function GetChatReceiver(){
        global $user,$db;
        try{
            $id = $_SESSION['recepientID'];
            $db = mysqli_connect('localhost','root','','chat-system');
            $query = "SELECT * FROM `users` WHERE `uid` = '$id'";
            $result = mysqli_query($db,$query);
            $user_r = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($db);
            echo base64_decode($user_r['uname']);
        }catch(Exception $e){
            print $e;
        }
    }
}
#=====================================================================================================================================================================================#

  class message{
        private $message;
        private $logged_in_user;
        private $table;
        private $recepient;
        private $db;
        public function encryptMessage(){
        global $feedback;
        //Declare variables
        $this->db = mysqli_connect('localhost','root','','chat-system');
        $this->message = htmlspecialchars($_POST['message']);
        $this->logged_in_user = $_SESSION['id'];
        $this->recepient = $_SESSION['recepientID'];
        $this->table = $_SESSION['chat_room'];
        //Encrypt message
        $encry_mess_hex = bin2hex(mysqli_real_escape_string($this->db,$this->message));
        $encry_mess_bs64 = base64_encode($encry_mess_hex);
        //Encrypt ID's
        $enc_id_one = base64_encode($this->logged_in_user);
        $enc_id_two = base64_encode($this->recepient);
        //Insert into database
        try{
            if(mysqli_query($this->db,"INSERT INTO `$this->table` (`id_1`,`id_2`,`message`) VALUES ('$enc_id_one','$enc_id_two','$encry_mess_bs64')")){
                //Its all okay
            }else{
                $feedback = "Could not send message ";
            }
        }catch(Exception $f){
            echo $f;
        } 
      }
  }
#=====================================================================================================================================================================================#

  class messages{
        private $table;
        private $logged_in_user;
        private $messages;   
        public function fetchMessages(){
        $this->table =  $_SESSION['chat_room'];    
        $this->logged_in_user = $_SESSION['id'];    
        $connect = mysqli_connect('localhost','root','','chat-system');    
        global $messages;    
        $result = mysqli_query($connect,"SELECT * FROM `$this->table`");
        $messages = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($this->result);
        mysqli_close($connect);
        } 

        
  }
#=====================================================================================================================================================================================#

  class sender extends messages{
     
        public function get(){
        $this->table =  $_SESSION['chat_room'];    
        $this->logged_in_user = $_SESSION['id'];    
        $connect = mysqli_connect('localhost','root','','chat-system');    
        global $messages;    
        $result = mysqli_query($connect,"SELECT * FROM `$this->table` ORDER BY `date` DESC");
        $messages = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($connect);
            foreach($messages as $singMessage){
                global $mes_sage;
                $decry_bs64_mess = base64_decode($singMessage['message']);
                $decry_hex_mess = hex2bin($decry_bs64_mess);
                if($this->logged_in_user == base64_decode($singMessage['id_1'])){
                    $time = substr($singMessage['date'],11,5);
                    $mes_sage = '
                    <div class="message-container">
                    <div class="right-text">
                        <p>'.$decry_hex_mess.'</p>
                        <small>'.$time.'</small>
                    </div> <br>';
                    echo $mes_sage;
                }else{
                    $time = substr($singMessage['date'],11,5);
                    $mes_sage = '
                    <div class="message-container">
                    <div class="left-text">
                        <p>'.$decry_hex_mess.'</p>
                        <small>'.$time.'</small>
                    </div> <br>';
                    echo $mes_sage;
                }
            }
        }
  }
#=====================================================================================================================================================================================#
?>