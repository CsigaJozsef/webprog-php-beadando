<?php

session_start();

$all_types = [
    "normal",
    "fire",
    "water",
    "electric",
    "grass",
    "bug",
    "poison",
    // "Ice",
    // "Fighting",
    // "Ground",
    // "Flying",
    // "Psychic",
    // "Rock",
    // "Ghost",
    // "Dragon",
    // "Dark",
    // "Steel",
    // "Fairy",
    // "Stellar"
];

$name = $_GET['name'] ?? '';
$type = $_GET['type'] ?? '';
$hp = $_GET['hp'] ?? '';
$attack = $_GET['attack'] ?? '';
$defense = $_GET['defense'] ?? '';
$price = $_GET['price'] ?? '';
$description = $_GET['description'] ?? '';
$image = $_GET['image'] ?? '';

$errors = [];

if (count($_GET) > 0) {

    if (trim($name) === '') {
        $errors['name'] = "A name mező nem lehet üres";
    }

    if (trim($type) === '') {
        $errors['type'] = "A type mező nem lehet üres!";
    }else if(!in_array($type, $all_types)){
        $errors['type'] = "Válassz type-ot az itt felsoroltak közűl";
    }

    if (trim($hp) === '') {
        $errors['hp'] = "A hp mező nem lehet üres!";
    }else if(filter_var($hp, FILTER_VALIDATE_INT) === false) {
        $errors['hp'] = "A hp csak szám lehet";
    }else{
        $hp = intval($hp);
        if($hp < 1) $errors['hp'] = "A hp csak pozitív szám lehet";
    }

    if (trim($attack) === '') {
        $errors['attack'] = "Az attack mező nem lehet üres!";
    }else if(filter_var($attack, FILTER_VALIDATE_INT) === false) {
        $errors['attack'] = "A attack csak szám lehet";
    }else{
        $attack = intval($attack);
        if($attack < 1) $errors['attack'] = "A attack csak pozitív szám lehet";
    }

    if (trim($defense) === '') {
        $errors['defense'] = "A defense mező nem lehet üres!";
    }else if(filter_var($defense, FILTER_VALIDATE_INT) === false) {
        $errors['defense'] = "A defense csak szám lehet";
    }else{
        $defense = intval($defense);
        if($defense < 1) $errors['defense'] = "A defense pozitív szám kell legyen";
    }

    if (trim($price) === '') {
        $errors['price'] = "Az price mező nem lehet üres!";
    }else if(filter_var($price, FILTER_VALIDATE_INT) === false) {
        $errors['price'] = "A price csak szám lehet";
    }else{
        $price = intval($price);
        if($price < 1) $errors['price'] = "A price csak pozitív szám lehet";
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors['image'] = "Az image url nem egy valid URL!";
    }

    $errors = array_map(fn($e) => "<span style='color: red'>$e</span>", $errors);

    if (count($errors) == 0) {

        $users = json_decode(file_get_contents('../data/users.json'), true);
        $pokemon = json_decode(file_get_contents('../data/ikemon.json'), true);

        $id = 'card'.count($pokemon);
        echo($id);
    
        $pokemon[$id] = [
            'name' => $name,
            'type' => $type,
            'hp' => $hp,
            'attack' => $attack,
            'defense' => $defense,
            'price' => $price,
            'description' => $description,
            'image' => $image
        ];

        $users["admin"]["cards"][] = $id;
    
        file_put_contents('../data/users.json', json_encode($users, JSON_PRETTY_PRINT));
        file_put_contents('../data/ikemon.json', json_encode($pokemon, JSON_PRETTY_PRINT));

        header("Location: ../index.php");
        exit();

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/new-pokemon.css">
    <title>New card</title>
</head>

<body>
    <h1>IKémon > New card</h1>

    <h2>Add a new card!</h2>
    <form action="" method="get">
        <div>
            <h4>Basic</h4>

            <br><label for="name">Name:</label><br>
            <input type="text" name="name" size="32" value="<?= $name ?>">
            <br><?= $errors['name'] ?? '' ?><br>
            
            <div class="pokemon-type">
            <br><label for="type">Pokémon type:</label><br>
            <?php foreach ($all_types as $t): ?>
                <input type="radio" name="type" id="<?= $t ?>" value="<?= $t ?>" <?= $type == "$t" ? 'checked' : ''?>>
                <label for="<?= $t ?>">
                    <?= $t ?>
                </label><br>
            <?php endforeach; ?>
            </div>
            <br><?= $errors['type'] ?? '' ?> <br>
        </div>

        <div class="stats-div">
            <h4>Stats</h4>

            <br><label for="hp">Hp:</label><br>
            <input type="text" name="hp" size="32" value="<?= $hp ?>">
            <br><?= $errors['hp'] ?? '' ?> <br>
        
            <br><label for="attack">Attack:</label><br>
            <input type="text" name="attack" size="32" value="<?= $attack ?>">
            <br><?= $errors['attack'] ?? '' ?> <br>
       
            <br><label for="defense">Defense:</label><br>
            <input type="text" name="defense" size="32" value="<?= $defense ?>">
            <br><?= $errors['defense'] ?? '' ?> <br>
        </div>

        <div>
            <h4>Details</h4>

            <br><label for="price">Price:</label><br>
            <input type="text" name="price" size="32" value="<?= $price ?>">
            <br><?= $errors['price'] ?? '' ?> <br>
        
            <br><label for="description">Description:</label><br>
            <input type="text" name="description" size="32" value="<?= $description ?>"><br>
        
            <br><label for="image">Image:</label><br>
            <input type="text" name="image" size="32" value="<?= $image ?>">
            <br><?= $errors['image'] ?? '' ?> <br>
        </div>

        <button type="submit">Add</button>

    </form>
    <div class="home-link"><a href="../index.php">Whoopsie, let's go back (home page)</a></div>
</body>

</html>