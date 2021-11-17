<?php
    session_start();
    class chatroom {
        private $session_id;
        private $get_id;
        private $db;
        private $roomName;
        public function constructRoom(){
            $this->db = mysqli_connect('localhost','root','','chat-system');
            $this->session_id = $_SESSION['id'];
            $this->get_id = $_GET['id'];
            $link_er = "Chats";
            $arr_nums = array($this->session_id,$this->get_id);
            $init_num = max($arr_nums);
            $fin_num = min($arr_nums);
            if($init_num === $fin_num){
                header("Location: ../profile.php");
            }
            $this->roomName = base64_encode($init_num.$link_er.$fin_num);
            //Query
            $rooms = mysqli_fetch_assoc(mysqli_query($this->db,"SELECT * FROM `rooms` WHERE `tname` = '$this->roomName'"));
            if($rooms == true ){
                //Simultaneous
                $_SESSION['chat_room'] = $this->roomName;
                $_SESSION['recepientID'] = $this->get_id;
                header("Location: ../chat.php");
            }else{
                $create = "CREATE TABLE `$this->roomName` (
                    `id` int(255) NOT NULL,
                    `id_1` varchar(255) NOT NULL,
                    `id_2` varchar(255) NOT NULL,
                    `message` varchar(255) NOT NULL,
                    `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                    $buildRoom = mysqli_query($this->db,$create);
                if($buildRoom){
                        #ADD PRIMARY KEY TO THE ID
                    $alter =  "ALTER TABLE `$this->roomName` CHANGE `id` `id` INT(255) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`)";
                    $run = mysqli_query($this->db,$alter);

                    if($run){
                        //Insert record
                      if( mysqli_query($this->db,"INSERT INTO `rooms` (tname) VALUES('$this->roomName')")){
                            //Make session variables
                            $_SESSION['chat_room'] = $this->roomName;
                            $_SESSION['recepientID'] = $this->get_id;
                            header("Location: ../chat.php");
                            //redirect to relevant page
                      }
                    }
                }
            }
            mysqli_close($this->db);   
        }
    }   

?>