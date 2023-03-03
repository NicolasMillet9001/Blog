<?php
session_start();
if (!$_SESSION['is_connected']) {
    header('location: /Tpblog/front/connexion.php');
}
?>