<?php
    session_start();
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

                #Check for the existence of the chatroom
                $query = "SHOW TABLES;"; # Query to get all chatrooms
                $result = mysqli_query($this->db,$query);
                $tables = mysqli_fetch_all($result);
                mysqli_free_result($result);
                if(in_array($this->chatroom_name,$tables)){
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
                            //Make session variable
                            $_SESSION['chat_room'] = $this->chatroom_name;

                        }
                    }
                }
                mysqli_close($this->db);
            }
    }
}
?>