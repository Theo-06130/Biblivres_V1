<?php

session_start();

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();

$sql = "SELECT * 
        FROM Livres
        JOIN Auteur ON Livres.Id_Auteur = Auteur.Id_Auteur
        JOIN Langue ON Livres.Id_Langue = Langue.Id_Langue
        ORDER BY Titre_Livre";

$stmt = $conn->prepare($sql);

$stmt->execute();

$data = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

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
    <link rel="stylesheet" href="/style/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
    <title>Home page</title>
</head>


<body>
    <header>
        <?php
        if (isset($_SESSION["Id_client"]) && !empty($_SESSION["Id_client"])) {
            ?>
            <div class="div_icon_profil">
                <p>
                    <?php echo strtoupper($_SESSION["Prenom"][0]) ?>
                </p>
                <a class="logout" href="/logout">Se deconnecter</a>
            </div>
            <?php
        } else {
            ?>
            <div class="logs">
                <div class="div_MeConnecter">
                    <h4 id="MeConnecter" onclick="log()">Me connecter</h4>
                    <p id="chevron">></p>
                </div>
                <a class="signUp" id="SignUp" href="/signUp">S'inscrire</a>
                <a class="login" id="LogIn" href="/login">Se connecter</a>
            </div>
            <?php
        }
        ?>
        <div class="name_page">
            <h2>Accueil</h2>
        </div>
        <div class="icon_settings" onclick="document.location.href = 'parametre'">
            <img src="/assets\settings.svg" alt="settings">
        </div>

    </header>
    <nav>
        <ul>
            <li><a href="/home" id='current_Page'>Accueil</a></li>
            <!-- <div class="underline"></div> -->
            <li><a href="/genres">Genres</a></li>
            <li><a href="/livre">Livres</a></li>
            <li><a href="/auteur">Auteur</a></li>
            <li><a href="/types">Types</a></li>
            <li><a href="/langues">Langues</a></li>
        </ul>
    </nav>

    <h3>Récemment consulté</h3>
    <div class="last_see">
        <?php
        foreach ($data as $key => $value) {
            echo "
        <a href='/livre/$value[Id_Livre]'>
        <div class='book'>

            <img src='data:image/png;base64," . base64_encode($value["Miniature"]) . "' alt=''>
            
        </div>
        </a>";
        }

        ?>
    </div>
    <h3>Genres favoris</h3>
    <div class="Genre_Fav">
        <button class="Romance">Romance</button>
        <button class='Fantaisie'>Fantaisie</button>
        <button class='Horreur'>Horreur</button>
        <button class='Action'>Action</button>
        <button class='Comique'>Comique</button>
        <button class='Tragique'>Tragique</button>
    </div>
    <h3>Auteur favoris</h3>
    <div class="Favorite_Author">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
        <img src="assets\test_auteur.jpeg" alt="">
    </div>
    <div class="all_livres">
        <h3>Tous les livres</h3>
        <img src="assets\plus.svg" alt="">
    </div>
    <div class="all_book_home">
        <?php
        foreach ($data as $key => $value) {
            echo "
        <a href='/livre/$value[Id_Livre]'>
        <div class='book'>

            <img src='data:image/png;base64," . base64_encode($value["Miniature"]) . "' alt=''>
            
        </div>
        </a>";
        }

        ?>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script type="module" src="/site/JS/script.js"></script>
<script type="module" src="/site/JS/home.js"></script> -->
<script type="module">
</script>
<script src="/script/menu_log.js"></script>



<!-- <h2 class='value_Book'>$value[Titre_Livre]</h2> -->
<!-- <p class='value_Book'>de $value[Nom] pour $value[Prix]€</p> -->