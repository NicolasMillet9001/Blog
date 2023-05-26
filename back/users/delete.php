<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$query = $dbh->prepare("DELETE FROM users WHERE id = ?");
$query->execute([$_POST['user_id']]);

header("location: /front/users.php");
?>