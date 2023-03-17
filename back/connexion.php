<?php
session_start();
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}



$query = $dbh->prepare('SELECT id, firstname, lastname, email, role_id, password FROM users WHERE email = ?');
$query->execute([$_POST['email']]);
$user = $query->fetch();


if (!$user) {
    $_SESSION['connection_error_email'] = "L'email est incorrect !";

    header('location: /tpblog/front/connexion.php');
    exit;
} else {
    unset($_SESSION['connection_error_email']);

    if ($_POST['password']==$user['password']){                    /*(password_verify($_POST['password'], $user['password']))*/ 
        unset($_SESSION['connection_error_password']);
        $_SESSION['is_connected'] = true;
        $_SESSION['connection_id'] = $user['id'];
        $_SESSION['connection_firstname'] = $user['firstname'];
        $_SESSION['connection_lastname'] = $user['lastname'];
        $_SESSION['role'] = $user['role_id'];

        header('location: /tpblog/front/blog.php');
        exit;
    } else {
        $_SESSION['connection_error_password'] = "Le mot de passe est incorrect !";

        header('location: /tpblog/front/connexion.php');
        exit;
    }
}

?>