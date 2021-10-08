<?php
    $feedback = '';
    require './classes/classes.php';
    if($_SESSION['id'] !== NULL ){
        $logged_in_user = $_SESSION['id'];
        $table = $_SESSION['chat_room'];
        $recepient = ['recepientID'];
        $x = new ChatUser;
        $x->GetChatUser();
        if(isset($_POST['send'])){
            $message = htmlspecialchars($_POST['message']);
            $y = new message;
            $y->encryptMessage();
        }

    }else{
        header('./login.php');
    }

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
    <center><small class "feedback"><?php echo $feedback; ?></small></center>
    <main>
        <div class="sidebar">
            <img src="./assets/img/images-removebg-preview.png" alt="" width="150" height="150">
            <h2><?php echo $user['uname']; ?></h2>
            
        </div>
        <div class="leftbar">
            <main class="space">
                <div class="bar">
                    <h3><?php $m = new chatReceiver; $m->GetChatReceiver(); ?></h3>
                </div>
                <div class="chat-space">
                    <?php 
                        $b = new sender;
                        $b->get();
                    ?>
            </div>
            <div class="form-container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <textarea name="message" id="" cols="30" rows="10"></textarea>
                    <button type="submit" name="send"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>

    </main>
        <script src="./assets/js/font_awesome_main.js"></script>
</body>
</html>