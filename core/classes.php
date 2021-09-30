<?php
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
        public function fetchDB(){
         $conn = $this->conn;
         $stmt = $conn->prepare('SELECT * FROM users');
         

   
            
        }
    }
    $connection = new Database();
    $connection->connectDB();
    $connection->fetchDB();
?>