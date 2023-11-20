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

    <img src="/style/cj.png" class="img" alt="">
    <p>Ibrahim</p> <!-- Nom de l'utilisateur  a modifier matheo ;)-->


    <div class="container">
        <form method="post" action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>

            <input type="email" id="email" name="email" required class="input" placeholder="Votre mail"><br><br>

            <input type="password" id="password" name="password" required class="input" placeholder="Mot de passe oublier"><br><br>

            <hr>

            <div class=boutton_centrage>
                <input type="submit" value="Log-out" class="btn">
            </div>

    </div>

    </div>
    </form>
</body>

</html>