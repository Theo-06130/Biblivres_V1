<?php
// Connexion à la base de données
$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();


if ($_ENV["REQUEST_METHOD"] == "POST") {
    $Nom = $_POST["Nom"];
    $profil = $_POST["profil"];
    $Nationalité = $_POST["Nationalité"];
    $Statut = $_POST["Statut"];

    $sql = "INSERT INTO auteurs (Nom,profil,Nationalité,Statut) VALUES ('$Nom', '$profil','$Nationalité','$Statut')";

    if ($conn->query($sql) === TRUE) {
        echo "L'auteur a été ajouté avec succès.";
    } 
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'ajout d'auteur</title>
</head>
<body>
    <h1>Ajouter un auteur</h1>
    <form action="" method="POST">
        <label for="Nom">Nom:</label>
        <input type="text" id="Nom" name="Nom" required><br>
        <label for="profil">profil:</label>
        <input type="text" id="profil" name="profil" required><br>
        <label for="Nationalité">Nationalité:</label>
        <input type="text" id="Nationalité" name="Nationalité" required><br>
        <label for="Statut">Statut:</label>
        <input type="number" id="Statut" name="Statut" required><br>
        <input type="submit" value="Ajouter l'auteur">
    </form>
</body>
</html>

