<?php
   require './core/core.inc.php';
    if(isset($_POST['signup'])){
        $name = htmlspecialchars($_POST['u_name']);
        $_pwd = htmlspecialchars($_POST['p_wd']);
        sanitizeForm($name,$_pwd);    
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Sign Up</title>
</head>
<body>
    <header>
        <div class="title">
            <p>Talkit</p>
        </div>
        <nav>
            <ul>
                <li><a href="./login.php" class="btn">Login</a></li>
            </ul>
        </nav>
    </header>

    <p class="feedback"> <?php echo $feedback."<br>"; ?> </p>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="u_name" id="" placeholder="Username">
            <input type="password" name="p_wd" id="" placeholder="password">
            <input type="submit" value="signup" name="signup">
        </form>
    </main>
</body>
</html>