<?php

session_start();

if (!isset($_SESSION["sendUser"])) {
    $_SESSION["sendUser"] = 0;
}

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();

if (isset($_POST) && !empty($_POST)) {

    $_SESSION["sendUser"] += 1;

    $sql = "INSERT INTO Clients (Nom, Prenom, Email, Password, Num_tel)
                VALUES (:Nom, :Prenom, :Email, :Password, :Num_tel)";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(":Nom", htmlspecialchars($_POST["nom"]), PDO::PARAM_STR);
    $stmt->bindValue(":Prenom", htmlspecialchars($_POST["prenom"]), PDO::PARAM_STR);
    $stmt->bindValue(":Email", htmlspecialchars($_POST["email"]), PDO::PARAM_STR);
    $options = [
        'cost' => 14,
    ];
    $stmt->bindValue(":Password", (password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT, $options)), PDO::PARAM_STR);
    $stmt->bindValue(":Num_tel", htmlspecialchars($_POST["phone"]), PDO::PARAM_STR);

    if ($_SESSION["sendUser"] == 1) {
        $stmt->execute();
        header("Location: /home");
    } else {
        echo "Already send";
    }
} else {

?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <link rel="stylesheet" href="/style/login.css">
        <!-- <link rel="stylesheet" href="/style/signup.css"> -->
        <title>Sign Up</title>
    </head>

    <style id="style_mod">

    </style>


    <body>
        <h1>Inscription</h1>
        <div class=contain>
            <div class=element>
        <form method="post" action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>
       
                <div class="form-group">
                    <label for="prenom">Prenom :</label>
                    <input type="text" id="prenom" name="prenom" required class="input">
                </div>

            

            <label for="phone">Numéro de téléphone :</label>
            <input id="phone" type="tel" name="phone" class="input" /><br><br>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required class="input"><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required class="input"><br><br>
        <div class="btn">
       <input type="submit" value="Done" class="button-60">  
        </div>
       
       <p>By clicking on "Sign up", you accept the</p> 
        <p1 class="deco">Terms and Conditions of Use.</p1>
    </div>
        </form></div>
    </body>






    </html>

    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "fr",
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>

<?php

    $_SESSION["sendUser"] = 0;
}

if ($_SESSION["sendUser"] != 1) {
    empty($_POST);
    unset($_POST);
}

?>