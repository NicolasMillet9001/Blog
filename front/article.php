<?php
include '../back/checkIsConnected.php';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$article_id = $_GET['id'];

$sql = $dbh->prepare('SELECT * FROM articles WHERE id = :id');
$sql->execute([':id' => $article_id]);
$article = $sql->fetch(PDO::FETCH_ASSOC);

// Récupération des commentaires pour l'article en question
$sql2 = $dbh->prepare('SELECT c.*, u.firstname, u.lastname, u.id FROM comments AS c JOIN users AS u ON c.user_id = u.id WHERE c.article_id = :article_id ORDER BY c.created_at DESC');
$sql2->execute([':article_id' => $article_id]);
$comments = $sql2->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $article['title'] ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
</head>
<body style="margin:20px">
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/Tpblog/front/blog.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Article : <?=$article['title']?></span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/Tpblog/front/blog.php" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="/Tpblog/front/users.php" class="nav-link">Utilisateurs</a></li>
            <li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" aria-current="page" style="margin-right:5px">Articles</a></li>
            <li class="nav-item">
                <form action="/TPblog/back/deconnexion.php">
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>
</div>

<div>
    <h1><?= $article['title'] ?></h1><br>
    <p><?= nl2br($article['content']) ?></p>
</div>



<!-- Affichage des commentaires -->
<div id="commDiv">
    <hr style="width: 400%; align:'center'">
    <div>
        <h4>Commentaires</h4>
        <?php if (count($comments) > 0) : ?>
            <ul>
                <?php foreach ($comments as $comment) : ?>
                    <li>
                        <p><?= $comment['content'] ?></p>
                        <?php echo ((isset($_SESSION['role']) && $_SESSION['role']==1) || $_SESSION['connection_id']==$comment['user_id']) ? '<form style="display:inline-block" action="../back/commentaires/deleteComm.php" method="post">
                            <input type="hidden" name="comment_id" value="'. $comment['id'] .'">
                            <input type="hidden" name="article_id" value="'. $article_id .'">
                            <button onclick="return confirm(`Êtes-vous sûr de vouloir supprimer ce commentaire ?`)" class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                        </form>' : ''; ?> 
                        <small style="font-style: italic; color: rgba(19, 41, 49, 0.5);">Posté par <?= $comment['firstname'] . ' ' . $comment['lastname'] ?> le <?= $comment['created_at'] ?></small><hr>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucun commentaire pour le moment.</p>
        <?php endif; ?>
    </div>

    <div>
        <button id="comment-button" style="margin-left:150px; bottom:30px; right:30px; display:block;" class="btn btn-primary" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 20 20">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
            </svg>
            Écrire un Commentaire
        </button>

        <div id="comment-form-container" style="display:none">
            <form method="post" action="../back/commentaires/ajoutComm.php">
                <input type="hidden" name="article_id" value="<?= $article_id ?>">
                <div class="mb-3">
                    <label for="contenu" class="form-label">Commentaire</label>
                    <textarea cols="50" rows="5" class="form-control" id="contenu" name="contenu" maxlength="255" oninput="updateCharCounter()" required></textarea>
                    <p id="char-counter">255/255</p>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter le commentaire</button>
            </form>
        </div>
    </div>
</div>
<footer style="margin-bottom:15px"></footer>

<script src="../script.js"></script>
<script>loadArticle()</script>

</body>
</html>