<?php
    require_once './functions/functions.php';    
    require_once './classes/classes.php';
    checkLogin();
    new user();
    FetchUser();        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/portal.css">
    <title>Profile</title>
</head>
<body>
    <header>
        <div class="title">
            <p> Talk it </p>
        </div>
        <nav>
            <ul>
                <li><a href="./chats.php" class="btn">Start chat</a></li>
                <li><a href="#" class="btn">My chats</a></li>
                <li><a href="#" class="btn">Logout</a></li>
                
            </ul>
        </nav>
    </header>
    <main>
        <div class="sidebar">
            <img src="./assets/img/images-removebg-preview.png" alt="" width="150" height="150">
            <h2><?php echo $user['uname'] ?></h2>
            
        </div>
        <div class="leftbar">
            <h2>My Chats</h2>
            <div class="chat">
                <a href="#">Adam</a>
                <small>Hi too</small>
                <small>17:20</small>
            </div>
            <div class="chat">
                <a href="#">Amanda</a>
                <small>Good Evening</small>
                <small>17:18</small>
            </div>
            <div class="chat">
             <a href="#">Diego</a> 
                <small>Hi there</small>
                <small>17:10</small>
            </div>
            
        </div>
    </main> 

</body>
</html>