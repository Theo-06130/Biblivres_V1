<?php

session_start();

if (!isset($_SESSION["send"])) {
    $_SESSION["send"] = 0;
}

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();

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
    <title>Home page</title>
</head>

<style id="style_mod">

</style>

<body>

    <div class="content">
        <?php

        if (!isset($_POST) || empty($_POST) || !isset($_FILES) || empty($_FILES)) {

            // get all langue for select
            $sql = "SELECT * 
                    FROM Langue
                    ORDER BY Language ASC";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $dataLangue = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dataLangue[] = $row;
            }

            // get all auteur for select
            $sql = "SELECT * 
                    FROM Auteur
                    ORDER BY Nom ASC";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $dataAuteur = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dataAuteur[] = $row;
            }

            // get all genre for select
            $sql = "SELECT * 
                    FROM Genre
                    ORDER BY Titre_Genre ASC";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $dataGenre = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dataGenre[] = $row;
            }

            // get all type for select
            $sql = "SELECT * 
                    FROM Types
                    ORDER BY Types ASC";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $dataType = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dataType[] = $row;
            }

            ?>

            <form method='post' action='<?php echo $_SERVER["REQUEST_URI"]; ?>' enctype='multipart/form-data'
                style="display:flex; flex-direction:column; background-color: grey;">
                <div>
                    Titre du livre
                    <input type="text" name="titre" placeholder="Titre du livre" required>
                </div>
                <div>
                    Miniature
                    <input type='file' name='file' accept="image/*" id="imgInp" required>
                    <img id="blah" src="#" alt=" " style="width:50px;height:50px;" />
                </div>
                <div>
                    Intrigue
                    <textarea name="intrigue" placeholder="Intrigue du livre" required></textarea>
                </div>
                <div>
                    Langue
                    <select name="langue" required>
                        <?php
                        foreach ($dataLangue as $key => $value) {
                            echo "<option value='$value[Id_Langue]'>$value[Language]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    Date de publication
                    <input type="date" name="date" placeholder="Date de publication" required>
                </div>
                <div>
                    Auteur
                    <select name="auteur" required>
                        <?php
                        foreach ($dataAuteur as $key => $value) {
                            echo "<option value='$value[Id_Auteur]'>$value[Nom]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    Genre
                    <select name="genre" required>
                        <?php
                        foreach ($dataGenre as $key => $value) {
                            echo "<option value='$value[Id_Genre]'>$value[Titre_Genre]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    Type
                    <select name="type" required>
                        <?php
                        foreach ($dataType as $key => $value) {
                            echo "<option value='$value[Id_Types]'>$value[Types]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    Prix
                    <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" name="prix" placeholder="Prix" required>
                    <label for="prix">€</label>
                </div>
                <div>
                    Nombre de page
                    <input type="number" pattern="^(?:\d*\.)?\d+$" step="1" name="page" placeholder="Pages" required>
                </div>
                <div>
                    Editeur
                    <input type="text" name="editeur" placeholder="Editeur" required>
                </div>
                <div>
                    Add new Livre
                    <input type='submit' value='Upload'>
                </div>
            </form>

            <?php

            $_SESSION["send"] = 0;

        } else {

            $_SESSION["send"] += 1;

            $sql = "INSERT INTO Livres (Titre_Livre, Miniature, Intrigue, Id_Langue, Date_Publi, Id_Auteur, Id_Genre, Id_Types, Prix, Nb_Pages, Editeur)
                VALUES (:Titre_Livre, :Miniature, :Intrigue, :Id_Langue, :Date_Publi, :Id_Auteur, :Id_Genre, :Id_Types, :Prix, :Nb_Pages, :Editeur)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":Titre_Livre", htmlspecialchars($_POST["titre"]), PDO::PARAM_STR);
            $stmt->bindValue(":Miniature", file_get_contents($_FILES['file']['tmp_name']), PDO::PARAM_LOB);
            $stmt->bindValue(":Intrigue", htmlspecialchars($_POST["intrigue"]), PDO::PARAM_STR);
            $stmt->bindValue(":Id_Langue", ($_POST["langue"]), PDO::PARAM_INT);
            $stmt->bindValue(":Date_Publi", htmlspecialchars($_POST["date"]), PDO::PARAM_STR);
            $stmt->bindValue(":Id_Auteur", ($_POST["auteur"]), PDO::PARAM_INT);
            $stmt->bindValue(":Id_Genre", ($_POST["genre"]), PDO::PARAM_INT);
            $stmt->bindValue(":Id_Types", ($_POST["type"]), PDO::PARAM_INT);
            $stmt->bindValue(":Prix", ($_POST["prix"]), PDO::PARAM_STR);
            $stmt->bindValue(":Nb_Pages", ($_POST["page"]), PDO::PARAM_INT);
            $stmt->bindValue(":Editeur", htmlspecialchars($_POST["editeur"]), PDO::PARAM_STR);

            if ($_SESSION["send"] == 1) {
                $stmt->execute();
            } else {
                echo "Already send";
            }

            $sql = "SELECT * 
                    FROM Livres";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $dataImg = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dataImg[] = $row;
            }


            ?>

            <div style="display:flex; flex-direction:column; background-color: white;">
                <p>Resultat :</p>
                <?php
                // echo "Titre : " . $_POST["titre"] . "<br>";
                // echo "Intrigue : " . $_POST["intrigue"] . "<br>";
                // echo "Langue : " . $_POST["langue"] . "<br>";
                // echo "Miniature : " . $_FILES['file']['name'] . "<br>";
                // $base64_image = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
                // echo '<img src="data:image/png;base64, ' . $base64_image . '" style="width:50px;height:50px;">';
            
                foreach ($dataImg as $key => $value) {
                    echo "Titre : " . $value["Titre_Livre"] . "<br>";
                    $base64_image = base64_encode($value["Miniature"]);
                    echo '<img src="data:image/png;base64, ' . $base64_image . '" style="width:50px;height:50px;">';
                }

                ?>

            </div>

            <?php

        }
        ?>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script type="module" src="/site/JS/script.js"></script>
<script type="module" src="/site/JS/home.js"></script> -->
<script type="module">

    const imgInp = document.getElementById('imgInp')
    const blah = document.getElementById('blah')

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }

    $(document).on('keydown', 'input[pattern]', function (e) {
        var input = $(this);
        var oldVal = input.val();
        var regex = new RegExp(input.attr('pattern'), 'g');

        setTimeout(function () {
            var newVal = input.val();
            if (!regex.test(newVal)) {
                input.val(oldVal);
            }
        }, 1);
    })

</script>

</html>

<?php
if ($_SESSION["send"] != 1) {
    empty($_POST);
    empty($_FILES);
    unset($_POST);
    unset($_FILES);
}
?>