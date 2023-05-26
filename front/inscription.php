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
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
<div>
    <div>
        <h1>
            Inscription
            <button class="button" style="padding: 10px; font-size:15px; "onclick="location='/front/connexion.php'">Se connecter</button>
        </h1>
        <form style="margin-top:40px" action="/back/inscription.php" method="post">
            <label class="form-label" for="firstname">Prénom</label>
            <input class="form-control" id="firstname" type="text" name="firstname">

            <label class="form-label" for="lastname">Nom</label>
            <input class="form-control" id="lastname" type="text" name="lastname">

            <label class="form-label" for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email">

            <label class="form-label" for="password">Mot de passe</label>
            <input class="form-control" id="password" type="password" name="password">
            
            <button class="button" style="padding: 5px 10px 5px 10px; background-color:lightblue" type="submit">S'inscrire</button>
        </form>
    </div>
</div>
</body>
</html>