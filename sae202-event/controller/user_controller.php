<?php
require_once('model/user_model.php');

function connexion() {
    require('view/autres_pages/header.php');
    require('view/connexion_view.php');
    require('view/autres_pages/footer.php');
}

function inscription() {
    require('view/autres_pages/header.php');
    require('view/inscription_view.php');
    require('view/autres_pages/footer.php');
}

function valider_inscription() {
    if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $prenom    = strip_tags(trim($_POST['prenom']));
        $nom       = strip_tags(trim($_POST['nom']));
        $email     = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $telephone = !empty($_POST['telephone']) ? strip_tags(trim($_POST['telephone'])) : null;
        $naissance = !empty($_POST['naissance']) ? strip_tags(trim($_POST['naissance'])) : null;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Adresse email invalide.'); window.location.href='/user/connexion';</script>";
            return;
        }
        if (strlen($_POST['password']) < 6) {
            echo "<script>alert('Le mot de passe doit contenir au moins 6 caractères.'); window.location.href='/user/connexion';</script>";
            return;
        }
        if (isset($_POST['confirm_password']) && $_POST['password'] !== $_POST['confirm_password']) {
            echo "<script>alert('Les mots de passe ne correspondent pas.'); window.location.href='/user/connexion';</script>";
            return;
        }

        $existe = getUserByEmail($email);
        if (!$existe) {
            $mdp_hash   = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $nouveau_id = createUser($prenom, $nom, $email, $mdp_hash, $telephone, $naissance);
            if ($nouveau_id) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                unset($_SESSION['admin_logged_in'], $_SESSION['admin_user']);
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_prenom']    = $prenom;
                $_SESSION['user_id']        = $nouveau_id;
                header('Location: /');
                exit();
            }
        } else {
            echo "<script>alert('Cet email est déjà utilisé.'); window.location.href='/user/inscription';</script>";
        }
    }
}

function valider_connexion() {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Email ou mot de passe incorrect.'); window.location.href='/user/connexion';</script>";
            return;
        }
        $user = getUserByEmail($email);
        if ($user && password_verify($_POST['password'], $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            unset($_SESSION['admin_logged_in'], $_SESSION['admin_user']);
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_prenom']    = $user['prenom'];
            $_SESSION['user_id']        = $user['id'];
            header('Location: /');
            exit();
        } else {
            echo "<script>alert('Email ou mot de passe incorrect.'); window.location.href='/user/connexion';</script>";
        }
    }
}

function deconnexion() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    unset($_SESSION['user_logged_in']);
    unset($_SESSION['user_prenom']);
    unset($_SESSION['user_id']);
    header('Location: /');
}
?>
