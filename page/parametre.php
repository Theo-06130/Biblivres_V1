<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/parametre.css">
    <title>Parametre</title>
</head>

<body>
    <h1>Parametre</h1>
    <div class="container">
    <form method="post" action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>

        <label for="prenom">Nom :</label>
        <input type="text" id="nom" name="nom" required class="input"><br><br>

        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" required class="input"><br><br>

        <label for="phone">Numéro de téléphone :</label>
        <input id="phone" type="tel" name="phone" class="input" /><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required class="input"><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required class="input"><br><br>

        
            <input type="submit" value="Log-out" class="btn">
        
</div>
        
        </div>
    </form>
</body>

</html>