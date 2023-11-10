<?php

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[1] == "livre" && !isset($parts[2])) {
    header("Location: /home");
}

include("src/DisplayData.php");

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();

$sql = "SELECT * 
            FROM Livres
            JOIN Auteur ON Livres.Id_Auteur = Auteur.Id_Auteur
            JOIN Langue ON Livres.Id_Langue = Langue.Id_Langue
            WHERE Id_Livre = $parts[2]";


$stmt = $conn->prepare($sql);

$stmt->execute();

$data = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

if (empty($data)) {
    header("Location: /home");
}

// display_data($data);

setlocale(LC_TIME, "fr_FR");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/style/livre.css">
    <title>Home page</title>
</head>

<style id="style_mod">

</style>

<body>
    <div class="Accueil">
        <button class="echap" onclick="home()">
            Échap
        </button>
    </div>
    <div class="content">
        <?php
        foreach ($data as $key => $value) {
            echo "
            <h2
            <input type='text' value='$value[Titre_Livre]'>
            </h2>
            <p>
            <input id='indate' type='date'> 
            </p>
            <p>
            <input type='text' value='$value[Acronyme]'>
            </p>
            <p>
            <input type='text' value='$value[Nom]'>
            </p>
            <h3>
            <input type='text' value='$value[Prix]'>€
            </h3>
            <img src='data:image/png;base64," . base64_encode($value["Miniature"]) . "' alt=''>
            <p>
            <input type='text' value='$value[Intrigue]'>
            </p>
            <script>
            document.getElementById('indate').value = '$value[Date_Publi]';
            </script>";
        }

        ?>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script type="module" src="/site/JS/script.js"></script>
<script type="module" src="/site/JS/home.js"></script> -->
<script type="module">

</script>
<script>
    function home() {
        document.location.href = "/adminlivre";
    }
</script>

</html>