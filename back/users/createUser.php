<?php
session_start();
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tp1','root','user');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$role_id = $_POST['role_id'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = $dbh->prepare("INSERT INTO users (firstname, lastname, role_id, email, password) VALUES (:firstname, :lastname, :role_id, :email, :password)");
$query->execute([
    'firstname' => $firstname,
    'lastname' => $lastname,
    'role_id' => $role_id,
    'email' => $email,
    'password' => $password
]);

header('Location: /Tpblog/front/users.php');
exit();
?>
