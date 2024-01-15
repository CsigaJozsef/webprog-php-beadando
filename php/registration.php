<?php

session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$password_again = $_POST['password-again'] ?? '';
$email = $_POST['email'] ?? '';

$errors = [];
$success = false;

if (count($_POST) > 0) {

    if (trim($username) === ''){
        $errors['username'] = "A username kitöltése kötelező";
    }
    else if (strlen($username) < 4){
        $errors['username'] = "A username legalább 4 karakter kell, hogy legyen!";
    }

    if (trim($email) === ''){
        $errors['email'] = "Az email kitöltése kötelező";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Addj valid emailcímet";
    }

    if (trim($password) === ''){
        $errors['password'] = "A password kitöltése kötelező";
    }
    else if (strlen($password) < 12){
        $errors['password'] = "A password legalább 12 karakter kell, hogy legyen!";
    }
    else if (!hasNumber($password)){
        $errors['password'] = "A password kell, hogy tartalmazzon számokat!";
    }
    else if (0 !== strcmp($password, $password_again)){
        echo($password.", ".$password_again);
        $errors['password'] = "A password és a password-again meg kell egyezzen!";
    }

    $errors = array_map(fn($e) => "<span style='color: red'>$e</span>", $errors);

    if (count($errors) == 0) {

        $reg = json_decode(file_get_contents('../data/users.json'), true);
    
        if (!isset($reg[$username])) {
            $reg[$username] = [
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'money' => 500,
                'cards' => []
            ];
    
            file_put_contents('../data/users.json', json_encode($reg, JSON_PRETTY_PRINT));
            $success = true;
            // echo($password);
        }
    }

}

// var_dump($errors);

function hasNumber($word)
{
    return preg_match('~[0-9]+~', $word);
}

if ($success){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/authorization.css">
    <title>Registration</title>
</head>

<body>

    <h1>IKémon > Registration</h1>

    <?php if(!isset($_SESSION["type"]) or $_SESSION["type"] == ""):?>
        <form action="" method="post">
            <br>E-mail<br><input type="text" name="email" value="<?= $email ?>"><br>
            <?= $errors['email'] ?? '' ?> <br>
            Username<br><input type="text" name="username" value="<?= $username ?>"><br>
            <?= $errors['username'] ?? '' ?> <br>
            <br>Password<br><input type="password" name="password" value="<?= $password ?>"><br>
            Password again<br><input type="password" name="password-again" value="<?= $_POST["password-again"] ?>"><br>
            <?= $errors['password'] ?? '' ?> <br>

            <br><button type="submit">Register</button><br><br>
            Already have an account? <a href="login.php">Login here!</a>
        </form>
        <?php else:?>
            <div>
                <h4>Error</h4>
                <p>You are alredy logged in!<br> Logout before trying to login again!</p>
            </div>
        <?php endif; ?> 

    <div class="home-link"><a href="../index.php">Whoopsie, let's go back (home page)</a></div>

</body>

</html>