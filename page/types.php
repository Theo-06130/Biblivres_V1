<?php

session_start();

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();

$sql = "SELECT * 
        FROM Livres
        JOIN Auteur ON Livres.Id_Auteur = Auteur.Id_Auteur
        JOIN Types ON Livres.Id_Types = Types.Id_Types
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
    <link rel="stylesheet" href="/style/types.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
    <title>types page</title>
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
            <h2>Types</h2>
        </div>
        <?php
        if (isset($_SESSION["Id_client"]) && !empty($_SESSION["Id_client"])) {
            ?>
            <div class="icon_settings" onclick="document.location.href = 'parametre'">
                <img src="/assets\settings.svg" alt="settings">
            </div>
            <?php
        } else {
            ?>
            <div class="icon_settings" onclick="alert('Connectez vous pour accéder au paramètre'),show_log()">
                <img src="/assets\settings.svg" alt="settings">
            </div>
            <?php
        }
        ?>
    </header>
    <nav>
        <ul>
            <li><a href="/home" id='current_Page'>Accueil</a></li>
            <!-- <div class="underline"></div> -->
            <li><a href="/genres">Genres</a></li>
            <li><a href="/livres">Livres</a></li>
            <li><a href="/auteur">Auteur</a></li>
            <li><a href="/types">Types</a></li>
            <li><a href="/langues">Langues</a></li>
        </ul>
    </nav>
    <main>
        <div class="all_types">
            <?php
            foreach ($data as $key => $value) {
                echo "
                <button>$value[Types]</button>
                ";
            }

            ?>
        </div>
    </main>
</body>
<script src="/script/menu_log.js"></script>

</html>