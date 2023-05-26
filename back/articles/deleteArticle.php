<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$query = $dbh->prepare("DELETE FROM articles WHERE id = ?");
$query->execute([$_POST['article_id']]);

header("location: /front/articles.php");
?>