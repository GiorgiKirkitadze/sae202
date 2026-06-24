<?php

function index() {
    $success = null;
    $error   = null;
    require('view/autres_pages/header.php');
    require('view/contact_view.php');
    require('view/autres_pages/footer.php');
}

function envoyer() {
    $success = null;
    $error   = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom       = strip_tags(trim($_POST['nom']       ?? ''));
        $prenom    = strip_tags(trim($_POST['prenom']    ?? ''));
        $email     = filter_var(trim($_POST['email']     ?? ''), FILTER_SANITIZE_EMAIL);
        $email     = str_replace(["\r", "\n"], '', $email);
        $telephone = strip_tags(trim($_POST['telephone'] ?? ''));
        $message   = strip_tags(trim($_POST['message']   ?? ''));

        if (empty($nom) || empty($email) || empty($message)) {
            $error = "Veuillez remplir tous les champs obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide.";
        } else {
            $to      = 'gkirkitadze096@gmail.com';
            $subject = '[Escape Game Nocturne] Nouveau message de contact';
            $body    = "Nom : $nom $prenom\nEmail : $email\nTéléphone : $telephone\n\nMessage :\n$message";
            $headers = "From: noreply@sae202.mmi-troyes.fr\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

            if (@mail($to, $subject, $body, $headers)) {
                $success = "Votre message a bien été transmis. Nous vous répondrons sous peu.";
            } else {
                $error = "Erreur lors de l'envoi. Veuillez réessayer plus tard.";
            }
        }
    }

    require('view/autres_pages/header.php');
    require('view/contact_view.php');
    require('view/autres_pages/footer.php');
}
?>
