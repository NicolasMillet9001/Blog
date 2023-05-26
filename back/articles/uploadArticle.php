<?php
session_start();
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1','root','user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$date_publication = $_POST['date_publication'];

$query = $dbh->prepare("INSERT INTO articles (title, content, published_at, user_id, created_at) VALUES (:title, :content, :published_at, :user_id, NOW())");
$query->execute([
    'title' => $titre,
    'content' => $contenu,
    'published_at' => $date_publication,
    'user_id' => $_SESSION['connection_id']
]);

header('Location: /front/articles.php');
exit();
?>
