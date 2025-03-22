<?php
require_once 'models/Database.php';
require_once 'models/User.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();
    if ($user->login($username, $password)) {
        $_SESSION['user_id'] = $user->getIdByUsername($username);
        header('Location: index.php?action=candidates');
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    include 'views/login.html';
}
?>
