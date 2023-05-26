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
        <a href="/front/users.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Utilisateurs</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/front/blog.php" class="nav-link">Home</a></li>
            <?php 
            echo ($_SESSION['role']==1) ? '<li class="nav-item"><a href="/front/users.php" class="nav-link active" aria-current="page">Utilisateurs</a></li><li class="nav-item"><a href="/front/articles.php" class="nav-link" style="margin-right:5px">Articles</a></li>' : '';
            echo ($_SESSION['role']==2) ? '<li class="nav-item"><a href="/front/articles.php" class="nav-link" style="margin-right:5px">Mes Articles</a></li><li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link active" type="submit">Compte</form></button></li>' : '';
            echo ($_SESSION['role']==3) ? '<li class="nav-item"><form action="../back/users/updateForm.php" method="post"><input type="text" name="user_id" value="'. $_SESSION['connection_id'] .'" hidden><button class="btn btn-light nav-link active" type="submit">Compte</form></button></li>' : '';
            ?>
            <li style="margin-left:5px;" class="nav-item">
                <form action="/back/deconnexion.php">
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>
</div>
<div style="margin-left:150px">
    <button style="margin-left:15px;" class="btn btn-primary" type="button" onclick="location='/back/users/newUser.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 20 20">
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
        </svg>
        Ajouter un Utilisateur
    </button>
</div>

<?php
require "../back/config/database.php";
require "../back/models/User.php";

$userModel = new User();
$users = $userModel->getAll();
?>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Rôle</th>            
            <th scope="col">Crée le</th>
            <th scope="col">Actions</th>
            
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user['id'] ?></th>
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?php switch($user['role_id']){   
                    case 1: echo 'Administrateur'; break; 
                    case 2: echo 'Auteur'; break; 
                    case 3: echo 'Utilisateur'; break;
                }?>
                </td>
                <td><?= $user['created_at'] ?></td>
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
</div>
</body>
</html>