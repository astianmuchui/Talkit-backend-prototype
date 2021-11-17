<?php

    class MEMBER_CHATROOMS {
        
        private $session_id;
        
        private $logged_in_user;
        
        private $db;
        
        public function get_member_chatrooms(){
        
            $this->logged_in_user = $_SESSION['id'];
        
            $this->db = mysqli_connect("localhost","root","","chat-system");
        
            $rs = mysqli_fetch_all(mysqli_query($this->db,"SELECT * FROM `rooms`"),MYSQLI_ASSOC);
        
            mysqli_free_result((mysqli_query($this->db,"SELECT * FROM `rooms`")));            
        
            foreach($rs as $r){
                
                $r_name = base64_decode($r['tname']);
                
                if(strpos($r_name,$this->logged_in_user)){
                    
                    $tnm = $r['tname'];

                    $sql_result = mysqli_query($this->db,"SELECT * FROM `$tnm` ORDER BY `id` desc LIMIT 1");
                    
                    $ltst_msgs = mysqli_fetch_all($sql_result,MYSQLI_ASSOC);

                    mysqli_free_result($sql_result);


                    foreach ($ltst_msgs as $ltst_msg):

                    $decry_bs64_mess = base64_decode($ltst_msg['message']);

                    $decry_hex_mess = hex2bin($decry_bs64_mess);

                    if($ltst_msg['id_1'] == base64_encode($this->logged_in_user)){

                        $b64 = base64_decode($ltst_msg['id_2']);

                        $DB_PARSE = mysqli_fetch_assoc(mysqli_query($this->db,"SELECT * FROM USERS where uid = $b64"));
                        
                        $DB_PARSE_DECODE = base64_decode($DB_PARSE['uname']);
                        
                        $div = '<div class="chat">
                        <a href="#">'.$DB_PARSE_DECODE.'</a>
                        <small>'.$decry_hex_mess.'</small>
                        <small>'.substr($ltst_msg['date'],11,5).'</small>
                         </div>';
                   
                         echo $div;                        
                    }else{
                   
                        $b64crypt = base64_decode($ltst_msg['id_1']);
                   
                        $DB_PARSE = mysqli_fetch_assoc(mysqli_query($this->db,"SELECT * FROM USERS where uid = $b64crypt"));
                   
                        $DB_PARSE_DECODE = base64_decode($DB_PARSE['uname']);
                   
                        $div = '<div class="chat">
                        <a href="#">'.$DB_PARSE_DECODE.'</a>
                        <small>'.$decry_hex_mess.'</small>
                        <small>'.substr($ltst_msg['date'],11,15).'</small>
                         </div>';
                    
                         echo $div;

                    }
                endforeach;
                }
            }
        }
    }
?>