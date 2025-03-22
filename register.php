<?php
require_once 'models/Database.php';
require_once 'models/User.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $user = new User();
    if ($user->register($username, $password)) {
        echo "Inscription réussie!";
    } else {
        echo "Erreur lors de l'inscription.";
    }
} else {
    include 'views/register.html';
}
?>
