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
            JOIN Genre ON Livres.Id_Genre = Genre.Id_Genre
            WHERE Id_Livre = :id";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $parts[2], PDO::PARAM_INT);

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
    <title>livre</title>
</head>


<body>
    <img src="/assets/left_arrow.svg" alt="" class="return" onclick='window.history.back()'>
    <main>

        <article class="main_info">
            <?php
            foreach ($data as $key => $value) {
                echo "
                <img src='data:image/png;base64," . base64_encode($value["Miniature"]) . "' alt='' class='mini_back'>
                <div class='card'>
                    <div class='head_card'>
                        <p class='pages'>$value[Nb_Pages] Pages</p>
                        <p class='lang'>$value[Acronyme]</p>
                    </div>
                    <div class='main_card'>
                        <p>$value[Titre_Genre]</p>
                        <p>Édité par $value[Editeur]</p>
                        <img src='data:image/png;base64," . base64_encode($value["Miniature"]) . "' alt=''>
                        <p>Écrit par $value[Nom]</p>
                    </div>
                    <div class='foot_card'>
                        <img src='/assets/add_wish.svg' alt=''>
                        <h3>$value[Prix]€</h3>
                        <img src='/assets/cart.svg' alt=''>
                    </div>
                </div>";
            }
            ?>
        </article>
        <article class="second_info">
            <?php
            foreach ($data as $key => $value) {
                echo "
                <h3 id='date'>Publié le " . date('d/m/Y', strtotime($value["Date_Publi"])) . " </h3>
                <p>$value[Intrigue]</p>";
            }
            ?>
        </article>
    </main>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script type="module" src="/site/JS/script.js"></script>
<script type="module" src="/site/JS/home.js"></script> -->
<script type="module">

</script>
<script>
    function home() {
        document.location.href = "/home";
    }
</script>

</html>


<!-- <div class="Accueil">
        <button class="echap" onclick="home()">
            Échap
        </button>
    </div>
    <div class="content">
        <?php
        // foreach ($data as $key => $value) {
        //     echo "
        //     <h2>$value[Titre_Livre]</h2>
        //     <p id='date'> " . date('d/m/Y', strtotime($value["Date_Publi"])) . " </p>
        //     <p class='lang'>$value[Acronyme]</p>
        //     <p>de $value[Nom]</p>
        //     <h3>$value[Prix]€</h3>
        //     <img src='data:image/png;base64," . base64_encode($value["Miniature"]) . "' alt=''>
        //     <p>$value[Intrigue]</p>";
        // }
        
        ?>
    </div> -->