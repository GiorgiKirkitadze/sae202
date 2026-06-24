<?php
require_once('model/reservation_model.php');
require_once('model/user_model.php');
require_once('model/commentaire_model.php');

function index() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $prenom  = $_SESSION['user_prenom'];
    $user    = getUserById($user_id);

    $flash = null;
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
    }

    require('view/autres_pages/header.php');
    require('view/profil_view.php');
    require('view/autres_pages/footer.php');
}

function equipe() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $user_id      = $_SESSION['user_id'];
    $reservations = getReservationsByUser($user_id);
    foreach ($reservations as $i => $r) {
        $reservations[$i]['code_invitation'] = assurerCodeInvitation($r['id']);
        $reservations[$i]['membres']         = getMembresEquipe($r['id']);
    }

    $rejointes = getEquipesRejointes($user_id);
    foreach ($rejointes as $i => $r) {
        $rejointes[$i]['membres'] = getMembresEquipe($r['id']);
    }

    $flash = null;
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
    }

    require('view/autres_pages/header.php');
    require('view/profil_equipe_view.php');
    require('view/autres_pages/footer.php');
}

function rejoindre() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $code = strtoupper(strip_tags(trim($_POST['code'] ?? '')));
        $resa = $code !== '' ? getReservationByCode($code) : null;

        if (!$resa) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => "Code d'invitation invalide."];
        } elseif ((int)$resa['user_id'] === (int)$user_id) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Vous êtes le chef de cette équipe.'];
        } elseif (estMembreEquipe($resa['id'], $user_id)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Vous faites déjà partie de cette équipe.'];
        } else {
            $joueurs = !empty($resa['joueurs']) ? json_decode($resa['joueurs'], true) : [];
            $occupes = 1 + (is_array($joueurs) ? count($joueurs) : 0) + count(getMembresEquipe($resa['id']));
            if ($occupes >= 6) {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Cette équipe est déjà complète (6 participants maximum).'];
            } elseif (addMembreEquipe($resa['id'], $user_id)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Vous avez rejoint l\'équipe "' . $resa['nom_equipe'] . '" !'];
                header('Location: /profil/equipe');
                exit();
            } else {
                $_SESSION['flash'] = ['type' => 'error', 'message' => "Erreur lors de l'inscription dans l'équipe."];
            }
        }

        header('Location: /profil/rejoindre');
        exit();
    }

    $flash = null;
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
    }

    require('view/autres_pages/header.php');
    require('view/profil_rejoindre_view.php');
    require('view/autres_pages/footer.php');
}

function score() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $toutes = array_merge(getReservationsByUser($user_id), getEquipesRejointes($user_id));
    usort($toutes, function ($a, $b) {
        return strtotime($a['date_reservation'] . ' ' . $a['heure_reservation'])
             - strtotime($b['date_reservation'] . ' ' . $b['heure_reservation']);
    });

    $scores   = getAllScoresMap();
    $derniere = !empty($toutes) ? end($toutes) : null;
    $score    = null;
    for ($i = count($toutes) - 1; $i >= 0; $i--) {
        if (isset($scores[$toutes[$i]['id']])) {
            $derniere = $toutes[$i];
            $score    = $scores[$toutes[$i]['id']];
            break;
        }
    }

    require('view/autres_pages/header.php');
    require('view/profil_score_view.php');
    require('view/autres_pages/footer.php');
}

function avis() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $commentaires = getCommentairesByUser($_SESSION['user_id']);

    $flash = null;
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
    }

    require('view/autres_pages/header.php');
    require('view/profil_avis_view.php');
    require('view/autres_pages/footer.php');
}

function annuler() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (isset($_SESSION['user_logged_in']) && isset($_GET['id'])) {
        $resa_id = (int)$_GET['id'];
        $user_id = $_SESSION['user_id'];

        if (deleteReservation($resa_id, $user_id)) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Votre réservation a été annulée.'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => "Erreur lors de l'annulation."];
        }
    }

    header('Location: /profil/equipe');
    exit();
}

function modifier() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom           = strip_tags(trim($_POST['prenom']      ?? ''));
        $nom              = strip_tags(trim($_POST['nom']         ?? ''));
        $email            = filter_var(trim($_POST['email']       ?? ''), FILTER_SANITIZE_EMAIL);
        $telephone        = !empty($_POST['telephone']) ? strip_tags(trim($_POST['telephone'])) : null;
        $naissance        = !empty($_POST['naissance']) ? strip_tags(trim($_POST['naissance'])) : null;
        $new_password     = $_POST['new_password']                ?? '';
        $confirm_password = $_POST['confirm_password']            ?? '';

        if (empty($prenom) || empty($nom) || empty($email)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Tous les champs sont obligatoires.'];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Adresse email invalide.'];
        } elseif (!empty($new_password) && strlen($new_password) < 6) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Le mot de passe doit contenir au moins 6 caractères.'];
        } elseif (!empty($new_password) && isset($_POST['confirm_password']) && $new_password !== $confirm_password) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Les mots de passe ne correspondent pas.'];
        } else {
            $hashed = !empty($new_password) ? password_hash($new_password, PASSWORD_DEFAULT) : null;
            if (updateUser($user_id, $prenom, $nom, $email, $hashed, $telephone, $naissance)) {
                $_SESSION['user_prenom'] = $prenom;
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Profil mis à jour avec succès.'];
            } else {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Erreur lors de la mise à jour. Cet email est peut-être déjà utilisé.'];
            }
        }
    }

    header('Location: /profil');
    exit();
}

function commenter() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $message = strip_tags(trim($_POST['message'] ?? ''));
    $note    = (int)($_POST['note'] ?? 5);
    if ($note < 1) $note = 1;
    if ($note > 5) $note = 5;

    if (empty($message)) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Le témoignage ne peut pas être vide.'];
    } elseif (strlen($message) > 1000) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Le témoignage ne peut pas dépasser 1000 caractères.'];
    } elseif (addCommentaire($_SESSION['user_id'], $message, $note)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Témoignage soumis. Il sera publié après modération.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Erreur lors de la soumission.'];
    }

    header('Location: /profil/avis');
    exit();
}
?>
