<?php
session_start();
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1','root','user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$contenu = $_POST['contenu'];
$article_id = $_POST['article_id'];
$user_id = $_SESSION['connection_id'];


$query = $dbh->prepare("INSERT INTO comments (content, article_id, user_id, created_at) VALUES (:content, :article_id, :user_id, NOW())");
$query->execute([
    
    'content' => $contenu,
    'article_id' => $article_id,
    'user_id' => $user_id
]);

header('Location: /front/article.php?id='.$article_id);
exit();
?>
