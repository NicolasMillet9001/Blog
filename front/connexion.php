<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="/tpblog/style.css">
    
</head>
<body>    
    <div>
        <h1>
            Connexion 
            <button class="button" style="padding: 10px 25px 10px 25px; font-size:15px;"onclick="location='/Tpblog/front/inscription.php'">S'inscrire</button>
        </h1>
        
        <form style="margin-top:40px" action="/Tpblog/back/connexion.php" method="post">
            <label for="email">Email</label>
            <input id="email" type="email" name="email">

            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password">

            <button class="button" style="padding:5px; background-color:lightblue" type="submit">Se connecter</button>
        </form>

        
        <?php if (isset($_SESSION['connection_error_email'])): ?>
            <p><?= $_SESSION['connection_error_email'] ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['connection_error_password'])): ?>
            <p><?= $_SESSION['connection_error_password'] ?></p>
        <?php endif; ?>
    </div>
</body>
</html>