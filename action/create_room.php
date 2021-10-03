<?php
    session_start();
    $id_one = $_SESSION['id']/7;
    if(isset($_GET['id'])){
        $id_two = $_GET['id'];
        require '../core/config.php';
        $name = $id_one. 'and'. $id_two ;
        if($id_one == $id_two){
            $sess_id = $_SESSION['id'];
            header("Location: ../profile.php?id=$sess_id");
        }else{
        $query = "CREATE TABLE `$name` (
            `id` int(255) NOT NULL,
            `id_1` varchar(255) NOT NULL,
            `message` varchar(255) NOT NULL,
            `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
          ";

          $build = mysqli_query($db,$query);
          if($build){
            $Query = "ALTER TABLE `$name` CHANGE `id` `id` INT(255) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);";
            if(mysqli_query($db,$Query)){
                $_SESSION['table'] = $name;
                header('Location: ../chat.php');                
            }
          }
        }
    }else{
        header('Location: ../login.php');
    }
?>