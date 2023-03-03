<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


$query = $dbh->prepare('UPDATE articles SET title = :title, content = :content WHERE id = :article_id');
$query->execute(['title' => $_POST['title'], 'content' => $_POST['content'], 'article_id' => $_POST['article_id']]);


header("location: /Tpblog/front/articles.php");
?>