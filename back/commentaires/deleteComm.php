<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1', 'root', 'user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$article_id = $_POST['article_id'];

$query = $dbh->prepare("DELETE FROM comments WHERE id = ?");
$query->execute([$_POST['comment_id']]);

header('Location: /Tpblog/front/article.php?id='.$article_id);
exit();
?>