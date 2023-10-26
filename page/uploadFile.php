<?php

// $database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

// $conn = $database->getConnection();

// $sql = "SELECT * 
//             FROM Livres
//             JOIN Auteur ON Livres.Id_Auteur = Auteur.Id_Auteur
//             JOIN Langue ON Livres.Id_Langue = Langue.Id_Langue";

// $stmt = $conn->prepare($sql);

// $stmt->execute();

// $data = [];

// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     $data[] = $row;
// }

// display_data($data);


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
    <title>Home page</title>
</head>

<style id="style_mod">

</style>

<body>

    <div class="content">

        <form method='post' action='<?php echo $_SERVER["REQUEST_URI"]; ?>' enctype='multipart/form-data'>
            <input type='file' name='file' required>
            <input type='submit' value='Upload'>
        </form>

        <?php
        $base64_image = $_FILES['file']['tmp_name'];
        $decoder = base64_decode($base64_image);
        echo '<img src="data:image/png;base64, ' . base64_encode(file_get_contents($base64_image)) . '" style="width:50px;height:50px;">';

        ?>


    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script type="module" src="/site/JS/script.js"></script>
<script type="module" src="/site/JS/home.js"></script> -->
<script type="module">

</script>

</html>