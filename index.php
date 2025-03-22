<?php
require_once 'controllers/AuthController.php';
require_once 'controllers/VoteController.php';
require_once 'controllers/CandidateController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'register':
        $controller = new AuthController();
        $controller->handleRequest();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->handleRequest();
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php?action=login');
        break;
    case 'vote':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
        } else {
            $controller = new VoteController();
            $controller->handleRequest();
        }
        break;
    case 'candidates':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
        } else {
            $controller = new CandidateController();
            $controller->handleRequest();
        }
        break;
    default:
        $controller = new AuthController();
        $controller->handleRequest();
}
?>
