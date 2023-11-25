<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="../style/panier.css">
</head>

<body>
    <img src="/assets/left_arrow.svg" alt="" class="return" onclick='window.history.back()'>
    <section class="panier">
        <?php

        $database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);


        $conn = $database->getConnection();


        if (isset($_SESSION["Id_client"]) && !empty($_SESSION["Id_client"])) {
            $idClient = $_SESSION["Id_client"];
        } else {
            $idClient = 0;
        }


        // Vérifiez si les données du formulaire ont été soumises pour ajouter un article
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idClient = $_POST['id_client'];
            $idLivre = $_POST['id_livre'];
            $quantity = $_POST['quantity'];

            // Effectuez l'insertion dans la base de données
            $sql = "INSERT INTO Articles_panier (ID_client, ID_livre, quantity) VALUES ($idClient, $idLivre, $quantity)";

            if ($conn->query($sql) === TRUE) {
                echo "Article ajouté au panier avec succès.";


            } else {
                echo "Erreur lors de l'ajout de l'article au panier : " . $errorInfo[2];
            }
        }


        // Récupérer les articles du panier
        $sql = "SELECT * FROM Article_panier";
        $result = $conn->query($sql);


        if ($result->rowCount() > 0) {
            echo "<table border='1'>
            <tr>
            <th>Id_article_panier</th>
            <th>Id_client</th>
            <th>Id_livre</th>
            <th>Quantité</th>
            </tr>";

            $total = 0;

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                <td>" . (isset($row["ID_article_panier"]) ? $row["ID_article_panier"] : "") . "</td>
                <td>" . (isset($row["ID_client"]) ? $row["ID_client"] : "") . "</td>
                <td>" . (isset($row["ID_livre"]) ? $row["ID_livre"] : "") . "</td>
                <td>" . (isset($row["quantity"]) ? $row["quantity"] : "") . "</td>
                </tr>";


                // Calculez le total
                $sql = "SELECT * FROM Livres WHERE ID_livre = " . (isset($row["ID_livre"]) ? $row["ID_livre"] : "");
                $result2 = $conn->query($sql);
                if ($result2->rowCount() > 0) {
                    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                        $total += $row2["prix"] * $row["quantity"];
                    }
                }
            }

            echo "</table>";

            // Afficher le total
            echo "<p>Total : " . $total . "€</p>";
        } else {
            echo "Le panier est vide.";
        }

        $conn = null;
        ?>

        <!-- Formulaire pour ajouter un article -->
        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            <label for="id_client">ID Client:</label>
            <input type="text" name="id_client" required>

            <label for="id_livre">ID Livre:</label>
            <input type="text" name="id_livre" required>

            <label for="quantity">Quantité:</label>
            <input type="text" name="quantity" required>

            <button type="submit">Ajouter au Panier</button>
        </form>
    </section>
</body>

</html>