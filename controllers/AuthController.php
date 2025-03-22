<?php
require_once 'models/User.php';

class AuthController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'login';

        switch ($action) {
            case 'register':
                $this->register();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                $this->login();
        }
    }

    private function register() {
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
    }

    private function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User();
            if ($user->login($username, $password)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user->getIdByUsername($username);
                header('Location: index.php?action=candidates');
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            include 'views/login.html';
        }
    }

    private function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>
