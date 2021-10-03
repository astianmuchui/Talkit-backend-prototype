<?php
    session_start();
    if($_SESSION['id'] == NULL ){
        //redirect
        header('');
    }
    $uid = $_SESSION['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/chat.css">
    <title>Chat</title>
</head>
<body>
    <header>
        <div class="title">
            <p> Talk it </p>
        </div>
        <nav>
            <ul>
                <li><a href="#" class="btn">Profile</a></li>
                <li><a href="#" class="btn">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="sidebar">
            <img src="./assets/img/images-removebg-preview.png" alt="" width="150" height="150">
            <h2>Jesse Freeman</h2>
            
        </div>
        <div class="leftbar">
            <main class="space">
                <div class="bar">
                    <h3>Amanda</h3>
                </div>
                <div class="chat-space">
                    <div class="message-container">
                        <div class="left-text">
                            <p>Hi there, How you doing</p>
                            <small>11:42 pm</small>
                        </div>
                    </div>

                    <div class="message-container">
                        <div class="right-text">
                            <p>Hi too , I'm doing fine</p>
                            <small>11:43 pm</small>
                        </div>
                    </div> <br> 

                    <div class="message-container">
                        <div class="left-text">
                            <p>What do you think of the new instagram update</p>
                            <small>11:44 pm</small>
                        </div> <br>
                    </div>
                        <div class="message-container">
                            <div class="right-text">
                                <p>I think its very fine</p>
                                <small>11:46 pm</small>
                            </div>
                            <div class="message-container">
                        </div> <br>

                        <div class="message-container">
                            <div class="left-text">
                                <p>What about twitter?</p>
                                <small>11:47 pm</small>
                            </div> <br>
                        </div>
                
                        <div class="message-container">
                            <div class="right-text">
                                <p>Its fine too</p>
                                <small>11:48 pm</small>
                            </div>

            </div>
            <div class="form-container">
                <form action="#" method="post">
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>

    </main>
        <script src="./assets/js/font_awesome_main.js"></script>
</body>
</html>