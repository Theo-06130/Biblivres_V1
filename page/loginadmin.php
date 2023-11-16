
<!-- this page for login admin -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/style/login.css">
   
    <title>Login Page</title>
</head>

<body>
    <h1>Login Admin</h1>
    <div class=contain>

        <form method="post" action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required class="input" placeholder="Email"><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required class="input" placeholder="password"><br><br>
            <div class="btn">
                <input type="submit" value="Done" class="button-60" id="button">
            </div>

            
        </form>


    </div>
</body>

</html>
 <script src="/style/script.js" ></script>