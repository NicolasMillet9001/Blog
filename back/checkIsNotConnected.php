<?php
session_start();
if (isset($_SESSION['is_connected']) && $_SESSION['is_connected']) {
    header('location: /front/blog.php');
}
?>