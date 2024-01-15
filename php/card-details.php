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

if(!isset($_GET["cardId"])){
    header('location: ../index.php');
}

$pokemons_data = json_decode(file_get_contents("../data/ikemon.json"), true);
$pokemon_details = $pokemons_data[$_GET["cardId"]];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail.css">
    <title><?= $pokemon_details["name"] ?></title>
</head>
<body bgColor="<?= $colors[$pokemon_details["type"]] ?>">

    <h1>IKémon > Details</h1>

    <div class="data-sheet">
        <div class="data-sheet-header">
            <h1><?= $pokemon_details["name"] ?></h1>
            <img src="<?= $pokemon_details["image"] ?>" alt="">
        </div>

        <hr>
        
        <div class="data-sheet-info">
            <ul class="card-attributes">
                <li><?= $pokemon_details["type"] ?></li>
                <li><?= $pokemon_details["hp"] ?></li>
                <li><?= $pokemon_details["attack"] ?></li>
                <li><?= $pokemon_details["defense"] ?></li>
            </ul>

            <p><?= $pokemon_details["description"] ?></p>
        </div>

    </div>
</body>
</html>