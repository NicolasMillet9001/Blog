<?php
include '../back/checkIsConnected.php'
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
    <link rel="stylesheet" href="/Tpblog/style.css">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/Tpblog/front/blog.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Blog</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/Tpblog/front/blog.php" class="nav-link active">Home</a></li>
            <?php 
            echo ($_SESSION['role']==1) ? '<li class="nav-item"><a href="/Tpblog/front/users.php" class="nav-link" aria-current="page">Utilisateurs</a></li><li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Articles</a></li>' : '';
            echo ($_SESSION['role']==2) ? '<li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Mes Articles</a></li><li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link" type="submit">Compte</form></button></li>' : '';
            echo ($_SESSION['role']==3) ? '<li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link" type="submit">Compte</form></button></li>' : '';
            ?>
            <li style="margin-left:5px;" class="nav-item">
                <form action="/TPblog/back/deconnexion.php">
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>
</div>

<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$articles = $dbh->query('SELECT * FROM articles');
//$articles = $dbh->query('SELECT a.*, u.id, u.firstname, u.lastname FROM users AS u RIGHT JOIN articles AS a ON u.id = a.user_id');
?>

<table class="table table-striped">
    <thead>
    <tr>
        <td style="margin-left:15px;">Titre</td>
        <td>Contenu</td>
        <td>Écrit par</td>
        <td>Publié le</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($articles->fetchAll() as $articles) : ?>
        <tr class="artLine" onclick="location.href='article.php?id=<?= $articles['id'] ?>'">
            <td style="margin-left:15px;"><a href="article.php?id=<?= $articles['id'] ?>"><?= $articles['title'] ?></td>
            <td><?= strlen($articles['content']) > 100 ? substr($articles['content'], 0, 100) . '...' : $articles['content'] ?></td>
            <td><?= $articles['user_id'] /*$articles['firstname']." ".$articles['lastname']*/ ?></td>
            <td><?= substr($articles['published_at'],0,-3) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>