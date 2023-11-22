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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/parametre.css">
    <title>Parametre</title>
</head>

<body>
    <h1>Paramètres</h1>
    <div class="icon_profil">
        <img src="/style/cj.png" class="img_easter_egg" alt="">
        <div class="div_icon_profil">
            <p>
                <?php echo strtoupper($_SESSION["Prenom"][0]) ?>
            </p>
        </div>
    </div>



    <div class="container">
        <form method="post" action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>

            <input type="text" id="Prenom" name="Prenom" disabled required class="input" value=<?php echo ($_SESSION["Prenom"]) ?>>

            <input type="text" id="name" name="name" required class="input" value=<?php echo ($_SESSION["Nom"]) ?>>

            <input type="email" id="email" name="email" required class="input" value=<?php echo ($_SESSION["Email"]) ?>>

            <input type="tel" id="tel" name="tel" required class="input" value=<?php echo ($_SESSION["Num_tel"]) ?>>

            <input type="password" id="password" name="password" class="input" placeholder="Nouveau mot de passe">

            <input type="password" id="confirm_password" name="confirm_password" class="input"
                placeholder="Confirmation mot de passe">
            <hr>

            <div class=boutton_centrage>
                <button type="submit" id="edit" onclick="enable_input()">Modifier</button>
            </div>

    </div>

    </div>
    </form>
</body>

<script src="/script/settings.js"></script>

</html>