<?php
    $feedback = "";
    include './core/config.php';
    if(isset($_POST['login'])){
        $name = htmlspecialchars($_POST['u_name']);
        $_pwd = htmlspecialchars($_POST['p_wd']);
        $query = "SELECT * FROM users WHERE `uname` = '$name' AND `pwd` = '$_pwd' LIMIT 1";
        $result = mysqli_query($db,$query);
        $users = mysqli_fetch_assoc($result);
        if($users == FALSE){
            $feedback = "Invalid username or password";
        }else{
            $user_uid = $users['uid'];
            header("Location ./profile.php?id=$user_uid");
        }
        mysqli_free_result($result);
        mysqli_close($db);


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="title">
            <p>Talkit</p>
        </div>
        <nav>
            <ul>
                <li><a href="#" class="btn">Signup</a></li>
            </ul>
        </nav>
    </header>

    <p class="feedback"> <?php echo $feedback."<br>"; ?> </p>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="u_name" id="" placeholder="Username">
            <input type="password" name="p_wd" id="" placeholder="password">
            <input type="submit" value="login" name="login">
        </form>
    </main>
</body>
</html>