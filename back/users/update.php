<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if (!empty($_POST['motdepasse'])) {
    $query = $dbh->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :user_id');
    $query->execute(['firstname' => $_POST['prenom'], 'lastname' => $_POST['nom'], 'email' => $_POST['email'], 'password' => $_POST['motdepasse'], 'user_id' => $_POST['user_id']]);
} else {
    $query = $dbh->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :user_id');
    $query->execute(['firstname' => $_POST['prenom'], 'lastname' => $_POST['nom'], 'email' => $_POST['email'], 'user_id' => $_POST['user_id']]);
}

header("location: /front/users.php");
?>