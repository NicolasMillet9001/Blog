<?php
include '../checkIsConnected.php'
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
            <span class="fs-4">Update User</span>
        </a>

        <ul style="margin-left:5px;" class="nav nav-pills">
            <li class="nav-item"><a href="/Tpblog/front/blog.php" class="nav-link" aria-current="page">Home</a></li>
            <?php 
            echo ($_SESSION['role']==1) ? '<li class="nav-item"><a href="/Tpblog/front/users.php" class="nav-link active" aria-current="page">Utilisateurs</a></li><li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Articles</a></li>' : '';
            echo ($_SESSION['role']==2) ? '<li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Mes Articles</a></li><li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link active" type="submit">Compte</form></button></li>' : '';
            echo ($_SESSION['role']==3) ? '<li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link active" type="submit">Compte</form></button></li>' : '';
            ?>
            <li style="margin-left:5px;" class="nav-item">
                <form action="/Tpblog/back/deconnexion.php">
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>




<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$query = $dbh->prepare('SELECT id, firstname, lastname, email FROM users WHERE id = ?');
$query->execute([$_POST['user_id']]);

$user = $query->fetch();
?>

<form action="update.php" method="post">
    <input type="text" name="user_id" value="<?= $user['id'] ?>" hidden>
    <label class="form-label" for="prenom">Prénom</label>
    <input class="form-control" id="prenom" type="text" name="prenom" value="<?= $user['firstname'] ?>">
    <label class="form-label mt-3" for="nom">Nom</label>
    <input class="form-control" id="nom" type="text" name="nom" value="<?= $user['lastname'] ?>">
    <label class="form-label mt-3" for="email">Email</label>
    <input class="form-control" id="email" type="text" name="email" value="<?= $user['email'] ?>">
    <label class="form-label mt-3" for="motdepasse">Mot de passe</label>
    <input class="form-control" id="motdepasse" type="password" name="motdepasse">
    <button class="btn btn-primary mt-3" type="submit">Modifier</button>
</form>

