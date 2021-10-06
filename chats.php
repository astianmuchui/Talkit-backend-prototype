<?php
    require './classes/classes.php';
    $fetch = new users();
    $fetch->getUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/chats.css">
    <title>Start chat</title>
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
        <div class="form-container">
            
             <form action="" method="post">
                 <input type="text" name="" id="" placeholder="Search users">
                 <button type="submit"><i class="fas fa-search"></i></button>
             </form>   
        </div>

        <div class="users-container">
            <div class="bar">
                <p>Available users (<?php echo count($users); ?>)</p>
            </div>
            <?php foreach($users as $user): ?>
                
            <div class="card">
                <p><?php echo $user['uname'] ?></p>
                <?php $uid = $user['uid'];?>
                <a href="./action/create_room.php?id=<?php echo $uid; ?>">start chat</a>

            </div>
            <?php endforeach; ?>
            
        </div>

    </main>



    <script src="./assets/js/font_awesome_main.js"></script>
</body>
</html>