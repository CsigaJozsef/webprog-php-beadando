<?php

session_start();

$name = $_GET['name'] ?? '';
$type = $_GET['type'] ?? '';
$hp = $_GET['hp'] ?? '';
$attack = $_GET['attack'] ?? '';
$defense = $_GET['defense'] ?? '';
$price = $_GET['price'] ?? '';
$description = $_GET['description'] ?? '';
$image = $_GET['image'] ?? '';

$errors = [];

if (count($_POST) > 0) {

    if (trim($name) === '') {
        $errors['name'] = "A name mező nem lehet üres";
    }

    if (trim($type) === '') {
        $errors['name'] = "Az image url nem egy valid URL!";
    }

    if (trim($name) === '') {
        $errors['name'] = "Az image url nem egy valid URL!";
    }

    if (trim($name) === '') {
        $errors['name'] = "Az image url nem egy valid URL!";
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors['image'] = "Az image url nem egy valid URL!";
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors['image'] = "Az image url nem egy valid URL!";
    }

}

if (count($errors) == 0) {

    $users = json_decode(file_get_contents('../data/users.json'), true);
    $pokemon = json_decode(file_get_contents('../data/ikemon.json'), true);

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

$all_types = [
    "Normal",
    "Fire",
    "Water",
    "Electric",
    "Grass",
    "Ice",
    "Fighting",
    "Poison",
    "Ground",
    "Flying",
    "Psychic",
    "Bug",
    "Rock",
    "Ghost",
    "Dragon",
    "Dark",
    "Steel",
    "Fairy",
    "Stellar"
]

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/new-pokemon.css">
    <title>Document</title>
</head>

<body>
    <form action="" method="get">

        <div>
            <br><label for="name">Name:</label><br>
            <input type="text" name="name" value="<?= $name ?>">
            <?= $errors['password'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="type">Pokémon type:</label><br>
            <?php foreach ($all_types as $t): ?>
                <input type="radio" name="type" id="<?= $t ?>" value="<?= $t ?>">
                <label for="<?= $t ?>">
                    <?= $t ?>
                </label><br>
            <?php endforeach; ?>
            <?= $errors['type'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="hp">Hp:</label><br>
            <input type="text" name="hp" value="<?= $hp ?>">
            <?= $errors['hp'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="attack">Attack:</label><br>
            <input type="text" name="attack" value="<?= $attack ?>">
            <?= $errors['attack'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="defense">Defense:</label><br>
            <input type="text" name="defense" value="<?= $defense ?>">
            <?= $errors['defense'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="price">Price:</label><br>
            <input type="text" name="price" value="<?= $price ?>">
            <?= $errors['price'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="description">Description:</label><br>
            <input type="text" name="description" value="<?= $description ?>">
            <?= $errors['description'] ?? '' ?> <br>
        </div>

        <div>
            <br><label for="image">Image:</label><br>
            <input type="text" name="image" value="<?= $image ?>">
            <?= $errors['image'] ?? '' ?> <br>
        </div>

    </form>
</body>

</html>