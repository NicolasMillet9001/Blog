<?php
include '../checkIsConnected.php';
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="Tpblog/front/blog.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Écrire un article</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/Tpblog/front/blog.php" class="nav-link active" aria-current="page">Home</a></li>
            <?php 
            echo ($_SESSION['role']==1) ? '<li class="nav-item"><a href="/Tpblog/front/users.php" class="nav-link" aria-current="page">Utilisateurs</a></li><li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Articles</a></li>' : '';
            echo ($_SESSION['role']==2) ? '<li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Mes Articles</a></li><li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link" type="submit">Compte</form></button></li>' : '';
            echo ($_SESSION['role']==3) ? '<li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link" type="submit">Compte</form></button></li>' : '';
            ?>
            <li class="nav-item">
                <form action="/Tpblog/back/deconnexion.php">
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>

<form action="createUser.php" method="post">
    <label class="form-label" for="firstname">Prénom :</label>
    <input class="form-control" id="firstname" type="text" name="firstname">

    <label class="form-label mt-3" for="lastname">Nom :</label><br>
    <input class="form-control" id="lastname" type="text" name="lastname"><br>

    <label for="role_id">Attribuer un rôle:</label>
    <select name="role_id" id="role_id">
        <option value="">--Choix du rôle--</option>
        <option value="1">Administrateur</option>
        <option value="2">Auteur</option>
        <option value="3">utilisateur</option>    
    </select>

    <br><label class="form-label mt-3" for="email">Adresse mail :</label><br>
    <input class="form-control" id="email" type="text" name="email">
	
    <label class="form-label mt-3" for="password">Mot de Passe :</label><br>
    <input class="form-control" id="password" type="text" name="password">

    <input style="padding:10px" type="submit" value="Enregistrer">   
</form>

</body>
</html>