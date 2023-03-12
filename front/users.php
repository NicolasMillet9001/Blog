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
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/Tpblog/front/users.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Utilisateurs</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/Tpblog/front/blog.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="/Tpblog/front/users.php" class="nav-link active" aria-current="page">Utilisateurs</a></li>
            <li class="nav-item"><a href="/Tpblog/front/articles.php" class="nav-link" style="margin-right:5px">Articles</a></li>
            <li class="nav-item">
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

$users = $dbh->query('SELECT * FROM users');
?>

<table class="table table-striped">
    <thead>
    <tr>
        <td style="margin-left:15px;">Prénom</td>
        <td>Nom</td>
        <td>Email</td>
        <td>Créé le</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users->fetchAll() as $user) : ?>
        <tr>
            <td style="margin-left:15px;"><?= $user['firstname'] ?></td>
            <td><?= $user['lastname'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <?php
                $createdAt = new DateTime($user['created_at']);
                echo $createdAt->format('d/m/Y H:i');
                ?>
            </td>
            <td>
                <div class="d-flex">
                    <form action="../back/users/updateForm.php" method="post">
                        <input type="text" name="user_id" value="<?= $user['id'] ?>" hidden>
                        <button class="btn btn-light" type="submit"><i class="bi bi-pencil-square"></i></button>
                    </form>
                    <form action="../back/users/delete.php" method="post">
                        <input type="text" name="user_id" value="<?= $user['id'] ?>" hidden>
                        <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>