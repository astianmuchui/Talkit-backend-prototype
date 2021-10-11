<?php
    session_start();
    class chatroom {
        private $session_id;
        private $get_id;
        private $db;
        private $chatroom;
        public function constructRoom(){
            $this->db = mysqli_connect('localhost','root','','chat-system');
            $this->session_id = $_SESSION['id'];
            $this->get_id = $_GET['id'];
            if($this->session_id == $this->get_id){
                header("Location:  profile.php");
                }       
                $this->chatroom_name = base64_encode($this->session_id ."and". $this->get_id);
                $inverted_name = base64_encode($this->get_id."and". $this->session_id);
                $results = mysqli_query($this->db,"SELECT * FROM rooms");
                $current_chatrooms = mysqli_fetch_all($results ,MYSQLI_ASSOC);
                mysqli_free_result(mysqli_query($this->db,"SELECT * FROM rooms"));                
                foreach($current_chatrooms as $chat_room){
                    $room = $chat_room['tname'];
                    if(($this->chatroom_name == $room)){
                        header("Location:  profile.php?Chatroom_Already_Exists");
                    }
                    if(($inverted_name == $room)){
                        header("Location:  profile.php?Chatroom_Already_Exists_");                  
                    }
                    if(($inverted_name !== $room) && ($this->chatroom_name == $room)){
                            //Create Room
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
                                    if(mysqli_query($this->db,"INSERT INTO `rooms` (`tname`)  VALUES ('$this->chatroom_name')")){
                                        //Make session variables
                                    $_SESSION['chat_room'] = $this->chatroom_name;
                                    $_SESSION['recepientID'] = $this->get_id;
                                    header("Location: ../chat.php");
                                    }
                                    
                                    //redirect to relevant page
                                }
                            }
                    }else{
                        header("Location:  ../profile.php?Error");
                    }
                }
        mysqli_close($this->db);        
    }
}
?>