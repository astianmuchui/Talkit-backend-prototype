<?php
    require "./classes/classes.php";
    // $sr = new SEARCH_USER();
    // $sr->search($value);
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
                <li><a href="./logout.php" class="btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <div class="users-container">
            <div class="bar">
                <p>Results ()</p>
            </div>
            
        </div>

    </main>



    <script src="./assets/js/font_awesome_main.js"></script>
</body>
</html>