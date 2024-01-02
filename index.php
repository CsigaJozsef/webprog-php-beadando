<?php

    $colors = [
        'electric' => '#ede137',
        'fire' => '#f2445b',
        'grass' => '#6be85a',
        'water' => '#60c5f7',
        'bug' => '#f0ab6e',
        'normal' => '#d1d1d1',
        'poison' => '#996699'
    ];

    $pokemons = json_decode(file_get_contents("data/ikemon.json"), true);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main-style.css">
    <title>IKémon</title>
</head>
<body>

    <div class="menu">
        <h1>IKémon > Home</h1>
        <a href="php/login.php"><h4>login/sign up</h4></a>
    </div>

    <hr>

    <div class="all-cards">
        <?php foreach($pokemons as $cardId => $pokemon): ?>
            <div id="<?= $cardId ?>" style="border: 2px <?= $colors[$pokemon["type"]] ?> solid;" >
                <img src="<?= $pokemon["image"] ?>" style="background-color: <?= $colors[$pokemon["type"]] ?>;" alt="">
                <a href="php/card-details.php?cardId=<?= $cardId ?>"><h4><?= $pokemon["name"] ?></h4></a>
                <p>🏷️ <?= $pokemon["type"] ?></p>
                <span>
                    ❤️ <?= $pokemon["hp"] ?> 
                    ⚔️ <?= $pokemon["attack"] ?>
                    🛡️ <?= $pokemon["defense"] ?>
                </span><br>
                <button style="background-color: <?= $colors[$pokemon["type"]] ?>;"> <?= $pokemon["price"] ?> </button>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>