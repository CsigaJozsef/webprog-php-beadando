<?php

session_start();

$match = false;
$username = "";
$password = "";
$type = "user";

if (count($_POST) > 0 && isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $reg = json_decode(file_get_contents('../data/users.json'), true);

    if (isset($reg[$username])) {
        echo($password);

        if (password_verify($password, $reg[$username]['password'])){
            echo("password is fine");
            $match = true;
        }
    }

    if ($match){
        if (0 == strcmp($username, "admin")){
            $type = "admin";
        }
    }

    // var_dump($match);

}

if ($match){
    session_start();

    $_SESSION["type"] = $type;
    $_SESSION["username"] = $username;

    header("Location: ../index.php");
    exit();
    
}

// var_dump($_SESSION["type"])

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/authorization.css">
    <title>Login</title>
</head>
<body>

    <h1>IKémon > Login</h1>

    <?php if(!isset($_SESSION["type"]) or $_SESSION["type"] == ""):?>
        <form action="" method="post">
            Username<br><input type="text" name="username" value="<?= $username ?>"> <?= $errors['username'] ?? '' ?> <br>
            Password<br><input type="password" name="password" value="<?= $password ?>"> <?= $errors['password'] ?? '' ?> <br>
            <br><button type="submit">Login</button><br><br>
            Don't have an account yet? <a href="registration.php">Register here!</a>
        </form>
    <?php else:?>
        <div>
            <h4>Error</h4>
            <p>You are alredy logged in!<br> Logout before trying to login again!</p>
        </div>
    <?php endif; ?> 

    <?php if(!$match && isset($_POST["password"])):?>
        <div><h4>Hibás felhasználónév vagy jelszó!</h4></div>
    <?php endif;?>

    <div class="home-link"><a href="../index.php">Whoopsie, let's go back (home page)</a></div>

</body>
</html>

<!-- admin: kakakakakaka123 -->