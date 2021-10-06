<?php
#=============================================================================================================================================#
    class Database{
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
#============================================================================================================================================#
    class chatroom{
        private $session_id;
        private $get_id;
        private $db;
        private $chatroom_name;
        public function BuildRoom(){
            global $db;
            $this->session_id = $_SESSION['id']/7;
            $this->get_id = $_GET['id'];
            #Ensure That one doesn"t create a chatroom with him/herself 
            if($this->session_id == $this->get_id){
                $pageID = $this->session_id*7;
                header("Location: ../profile.php?id=$pageID");                
            }else{
                $this->db = mysqli_connect('localhost','root','','chat-system');
                $this->chatroom_name = $this->session_id ."and". $this->get_id;
                $inverted_name = $this->get_id."and". $this->session_id; 
                #Check for the existence of the chatroom
                $query = "SHOW TABLES;"; # Query to get all chatrooms
                $result = mysqli_query($this->db,$query);
                $tables = mysqli_fetch_all($result);
                mysqli_free_result($result);
                if(in_array($this->chatroom_name,$tables) || in_array($inverted_name,$tables)){
                    //FUNCTION TO REDIRECT HERE
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
                            //Make session variables
                            $_SESSION['chat_room'] = $this->chatroom_name;
                            $_SESSION['recepientID'] = $this->get_id;
                            
                            //redirect to relevant page
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
            $randLetters = array("545HDFGXMFNJDHHSCFNGJIFNFG","7899KIOVFNENFDDSVJBITHGVBAKFRY","64977VTGIZXHKCHJDGWFYDINHCV","450KICADMPJHFBGHFVHFB","JTTSXCLAORVJOD328FB","JSQMLFHAM468ASBFEHI","ATMEGA328PCBCVGJRF","OHM546CCSCJFGBKSDHYGDYE","ASSASCOUDWITEOGIAV4555","D8979HFGHJHGDIRBVFMGNJGHRU","J261646VHGIGHRBGXVCGJGFVFH","PF658979JGOJGRGIVCBUVSREP","NE555CCHGHJIW","TADA2030GTROUYVHDG");
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
            $database = new Database();
            $database->connectDB();
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
                    $randLetters = array("545HDFGXMFNJDHHSCFNGJIFNFG","7899KIOVFNENFDDSVJBITHGVBAKFRY","64977VTGIZXHKCHJDGWFYDINHCV","450KICADMPJHFBGHFVHFB","JTTSXCLAORVJOD328FB","JSQMLFHAM468ASBFEHI","ATMEGA328PCBCVGJRF","OHM546CCSCJFGBKSDHYGDYE","ASSASCOUDWITEOGIAV4555","D8979HFGHJHGDIRBVFMGNJGHRU","J261646VHGIGHRBGXVCGJGFVFH","PF658979JGOJGRGIVCBUVSREP","NE555CCHGHJIW","TADA2030GTROUYVHDG");
                    $randNo = rand(0,14);
                    $base = $randLetters[$randNo];
                    $encoded_base64 = base64_encode($password);
                    $final_passcode = $base.$encoded_base64;
                    $u_name = $this->username;
                    $sql = "INSERT INTO users (`uname`,`pwd`) VALUES ('$u_name','$final_passcode')";
                    $db = mysqli_connect('localhost','root','','chat-system');    
                    if(mysqli_query($db,$sql)){
                        $query = "SELECT * FROM users WHERE `uname` = '$u_name' AND `pwd` = '$final_passcode' LIMIT 1";
                        $result = mysqli_query($db,$query);
                        $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
                        mysqli_free_result($result);
                        foreach ($users as $user){
                            $id = $user['uid'];
                            $finall = $id*7;
                            $_SESSION['id'] = $finall;
                            header("Location: ./profile.php?id=$finall");
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
            $this->randLetters = array("545HDFGXMFNJDHHSCFNGJIFNFG","7899KIOVFNENFDDSVJBITHGVBAKFRY","64977VTGIZXHKCHJDGWFYDINHCV","450KICADMPJHFBGHFVHFB","JTTSXCLAORVJOD328FB","JSQMLFHAM468ASBFEHI","ATMEGA328PCBCVGJRF","OHM546CCSCJFGBKSDHYGDYE","ASSASCOUDWITEOGIAV4555","D8979HFGHJHGDIRBVFMGNJGHRU","J261646VHGIGHRBGXVCGJGFVFH","PF658979JGOJGRGIVCBUVSREP","NE555CCHGHJIW","TADA2030GTROUYVHDG");
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
            $this->randLetters = array("545HDFGXMFNJDHHSCFNGJIFNFG","7899KIOVFNENFDDSVJBITHGVBAKFRY","64977VTGIZXHKCHJDGWFYDINHCV","450KICADMPJHFBGHFVHFB","JTTSXCLAORVJOD328FB","JSQMLFHAM468ASBFEHI","ATMEGA328PCBCVGJRF","OHM546CCSCJFGBKSDHYGDYE","ASSASCOUDWITEOGIAV4555","D8979HFGHJHGDIRBVFMGNJGHRU","J261646VHGIGHRBGXVCGJGFVFH","PF658979JGOJGRGIVCBUVSREP","NE555CCHGHJIW","TADA2030GTROUYVHDG");   
            $conn = mysqli_connect('localhost','root','','chat-system');
            $query = "SELECT * FROM `users` where `uname` = '$this->name'";
            $result = mysqli_query($conn,$query);
            $user = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($conn);
            if($result == true){
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
                            header("Location: ./profile.php");
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
?>