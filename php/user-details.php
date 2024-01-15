<?php
session_start();

$colors = [
    'electric' => '#ede137',
    'fire' => '#f2445b',
    'grass' => '#6be85a',
    'water' => '#60c5f7',
    'bug' => '#f0ab6e',
    'normal' => '#d1d1d1',
    'poison' => '#996699'
];

$username = $_SESSION["username"];

$user_data = json_decode(file_get_contents("../data/users.json"), true);
$pokemons = json_decode(file_get_contents("../data/ikemon.json"), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="../css/main-style.css">
    <title><?= $username ?></title>
</head>
<body style="background-color: lightpink;">
<h1>IKémon > User data</h1>

    <div class="data-sheet">
        <div class="data-sheet-header">
            <h1><?= $username ?></h1>
        </div>

        <hr>
        
        <div class="data-sheet-info">
            <ul class="user-attributes">
                <li><?= $user_data[$username]["email"] ?></li>
                <li><?= $user_data[$username]["money"] ?></li>
            </ul>
        </div>
    </div>

    <h2>Your cards</h2>

    <hr>

    <div class="all-cards">
        <?php foreach($user_data[$username]["cards"] as $cardId): ?>
            <?php $pokemon = $pokemons[$cardId]; ?>
            <div id="<?= $cardId ?>" style="border: 2px <?= $colors[$pokemon["type"]] ?> solid;" >
                <img src="<?= $pokemon["image"] ?>" style="background-color: <?= $colors[$pokemon["type"]] ?>;" alt="">
                <a href="php/card-details.php?cardId=<?= $cardId ?>"><h4><?= $pokemon["name"] ?></h4></a>
                <p>🏷️ <?= $pokemon["type"] ?></p>
                <span>
                    ❤️ <?= $pokemon["hp"] ?> 
                    ⚔️ <?= $pokemon["attack"] ?>
                    🛡️ <?= $pokemon["defense"] ?>
                </span><br>
            </div>
        <?php endforeach; ?>
    </div>
    
</body>
</html>