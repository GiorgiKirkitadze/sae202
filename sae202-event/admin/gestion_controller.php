<?php
require_once('admin/admin_model.php');
require_once('model/reservation_model.php');

function index() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (isset($_SESSION['admin_logged_in'])) {
        header('Location: /gestion/dashboard');
        exit();
    }
    require('view/autres_pages/header.php');
    require('admin/admin_login_view.php');
    require('view/autres_pages/footer.php');
}

function login() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = strip_tags(trim($_POST['username']));
        $password = $_POST['password'];
        $admin = getAdmin($username);
        if ($admin && password_verify($password, $admin['password'])) {
            unset($_SESSION['user_logged_in'], $_SESSION['user_prenom'], $_SESSION['user_id']);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user']      = $admin['username'];
            header('Location: /gestion/dashboard');
            exit();
        } else {
            $error = "Login ou mot de passe incorrect.";
            require('view/autres_pages/header.php');
            require('admin/admin_login_view.php');
            require('view/autres_pages/footer.php');
        }
    } else {
        header('Location: /gestion');
        exit();
    }
}

function dashboard() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: /gestion');
        exit();
    }

    $stats        = getStats();
    $reservations = getAllReservations();
    $commentaires = getCommentairesEnAttente();
    $masquer_footer = true;

    require('view/autres_pages/header.php');
    require('admin/admin_dashboard_view.php');
    require('view/autres_pages/footer.php');
}

function dossier() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: /gestion');
        exit();
    }

    $reservation = isset($_GET['id']) ? getReservationAdmin((int)$_GET['id']) : null;
    if (!$reservation) {
        header('Location: /gestion/dashboard');
        exit();
    }

    $joueurs = !empty($reservation['joueurs']) ? json_decode($reservation['joueurs'], true) : [];
    if (!is_array($joueurs)) $joueurs = [];
    $masquer_footer = true;

    require('view/autres_pages/header.php');
    require('admin/admin_dossier_view.php');
    require('view/autres_pages/footer.php');
}

function score() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: /gestion');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
        saveScore(
            (int)$_POST['reservation_id'],
            strip_tags(trim($_POST['resultat']        ?? '')),
            strip_tags(trim($_POST['indices_trouves'] ?? '')),
            strip_tags(trim($_POST['temps_etape5']    ?? ''))
        );
        header('Location: /gestion/score');
        exit();
    }

    $reservations = getAllReservations();
    $scores       = getAllScoresMap();
    $masquer_footer = true;

    require('view/autres_pages/header.php');
    require('admin/admin_score_view.php');
    require('view/autres_pages/footer.php');
}

function moderer() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: /gestion');
        exit();
    }

    if (isset($_POST['action']) && isset($_POST['id'])) {
        $id     = (int)$_POST['id'];
        $action = $_POST['action'];
        if ($action === 'approuver') {
            approuverCommentaire($id);
        } elseif ($action === 'rejeter') {
            rejeterCommentaire($id);
        }
    }

    header('Location: /gestion/dashboard');
    exit();
}

function supprimer() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: /gestion');
        exit();
    }
    if (isset($_GET['id'])) {
        deleteReservationAdmin((int)$_GET['id']);
    }
    header('Location: /gestion/dashboard');
    exit();
}

function logout() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    session_destroy();
    header('Location: /');
    exit();
}
?>
