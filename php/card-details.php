<?php 

if(!isset($_GET["cardId"])){
    header('location: ../index.php');
}

echo($_GET["cardId"]);
$pokemons_data = json_decode(file_get_contents("../data/ikemon.json"), true);
$pokemon_details = $pokemons_data[$_GET["cardId"]];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pokemon_details["name"] ?></title>
</head>
<body>
    <div class="data-sheet">
        <h1><?= $pokemon_details["name"] ?></h1>

    </div>
</body>
</html>