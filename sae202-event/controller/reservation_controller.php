<?php
require_once('model/reservation_model.php');

function index() {
    session_start();
    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }
    require('view/autres_pages/header.php');
    require('view/reservation_view.php');
    require('view/autres_pages/footer.php');
}

function reserver() {
    session_start();
    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }

    $nom_equipe = strip_tags(trim($_POST['nom_equipe'] ?? ''));
    $nb_joueurs = (int)($_POST['nb_joueurs'] ?? 0);

    $jour  = (int)($_POST['jour']  ?? 0);
    $mois  = (int)($_POST['mois']  ?? 0);
    $annee = (int)($_POST['annee'] ?? 0);
    $date_valide = checkdate($mois, $jour, $annee);
    $date_reservation = $date_valide
        ? sprintf('%04d-%02d-%02d', $annee, $mois, $jour)
        : '';

    $heure_reservation = '00:00:00';

    $costumes      = ($_POST['costumes']      ?? '0') === '1' ? 1 : 0;
    $service_video = ($_POST['service_video'] ?? '0') === '1' ? 1 : 0;

    $noms   = $_POST['joueur_nom']   ?? [];
    $emails = $_POST['joueur_email'] ?? [];
    $joueurs = [];
    if (is_array($noms)) {
        foreach ($noms as $i => $nom) {
            $nom = strip_tags(trim($nom));
            $email = strip_tags(trim($emails[$i] ?? ''));
            if ($nom !== '' || $email !== '') {
                $joueurs[] = ['nom' => $nom, 'email' => $email];
            }
        }
    }
    $joueurs_json = empty($joueurs) ? null : json_encode($joueurs, JSON_UNESCAPED_UNICODE);

    if (
        empty($nom_equipe) ||
        $nb_joueurs < 2 || $nb_joueurs > 6 ||
        !$date_valide
    ) {
        echo "<script>alert('Données invalides. Veuillez vérifier le formulaire.'); window.location.href='/reservation';</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $code = createReservation($user_id, $nom_equipe, $nb_joueurs, $date_reservation, $heure_reservation, $costumes, $service_video, $joueurs_json);
    if ($code) {
        $_SESSION['resa_confirmation'] = [
            'nom_equipe'    => $nom_equipe,
            'nb_joueurs'    => $nb_joueurs,
            'date'          => $date_reservation,
            'costumes'      => $costumes,
            'service_video' => $service_video,
            'code'          => $code,
        ];
        header('Location: /reservation/confirmation');
        exit();
    } else {
        echo "<script>alert('Une erreur est survenue.'); window.location.href='/reservation';</script>";
    }
}

function confirmation() {
    session_start();
    if (!isset($_SESSION['user_logged_in'])) {
        header('Location: /user/connexion');
        exit();
    }
    if (empty($_SESSION['resa_confirmation'])) {
        header('Location: /reservation');
        exit();
    }
    $resa = $_SESSION['resa_confirmation'];
    unset($_SESSION['resa_confirmation']);

    require('view/autres_pages/header.php');
    require('view/reservation_confirmation_view.php');
    require('view/autres_pages/footer.php');
}
?>
