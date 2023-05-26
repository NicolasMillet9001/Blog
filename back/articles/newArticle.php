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
        <a href="/front/blog.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Écrire un article</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/front/blog.php" class="nav-link active" aria-current="page">Home</a></li>
            <?php 
            echo ($_SESSION['role']==1) ? '<li class="nav-item"><a href="/front/users.php" class="nav-link" aria-current="page">Utilisateurs</a></li><li class="nav-item"><a href="/front/articles.php" class="nav-link" style="margin-right:5px">Articles</a></li>' : '';
            echo ($_SESSION['role']==2) ? '<li class="nav-item"><a href="/front/articles.php" class="nav-link" style="margin-right:5px">Mes Articles</a></li><li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link" type="submit">Compte</form></button></li>' : '';
            echo ($_SESSION['role']==3) ? '<li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link" type="submit">Compte</form></button></li>' : '';
            ?>
            <li class="nav-item">
                <form action="/back/deconnexion.php">
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>

<form action="uploadArticle.php" method="post">
    <label class="form-label" for="titre">Titre :</label>
    <input class="form-control" id="titre" type="text" name="titre">

    <label class="form-label mt-3" for="contenu">Contenu :</label><br>
    <textarea cols="146" rows="10" id="contenu" name="contenu"></textarea><br><br>

    <label for="date_publication">Date de publication :</label><br>
	<input type="datetime-local" id="date_publication" name="date_publication" value="<?php echo date('Y-m-d\TH:i', strtotime('+1 hour +1 minute')); ?>"><br><br>
	
    <input style="padding:10px" type="submit" value="Enregistrer">   
</form>

</body>
</html>