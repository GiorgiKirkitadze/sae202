<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Cercle des Égarés</title>
    <link rel="stylesheet" href="/view/css/style.css?v=65">
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $est_admin = isset($_SESSION['admin_logged_in']);
    ?>
    <header>
        <a href="<?php echo $est_admin ? '/gestion/dashboard' : '/'; ?>" class="logo">
            <img src="/view/img/logo.webp" alt="Logo" class="logo-img">
            <?php if (!$est_admin): ?>Le cercle des égarés<?php endif; ?>
        </a>
        <nav>
            <?php if (!$est_admin): ?>
            <a href="/evenement">ÉVÈNEMENT</a>
            <a href="/tarifs">TARIFS</a>
            <a href="/contact">Contact</a>
            <a href="/faq">FAQ</a>
            <?php endif; ?>
            <?php if ($est_admin): ?>
                <button type="button" class="nav-connected" id="agentMenuBtn" aria-label="Menu admin">
                    <span class="nav-admin-name"><?php echo htmlspecialchars($_SESSION['admin_user']); ?></span>
                    <img src="/view/img/connected.svg" alt="">
                </button>
            <?php elseif (isset($_SESSION['user_logged_in'])): ?>
                <button type="button" class="nav-connected" id="agentMenuBtn" aria-label="Menu agent">
                    <img src="/view/img/connected.svg" alt="">
                </button>
            <?php else: ?>
                <a href="/user/connexion" class="btn-nav">CONNEXION</a>
            <?php endif; ?>
        </nav>

        <?php if ($est_admin): ?>
        <div class="agent-popup" id="agentPopup">
            <button type="button" class="agent-popup-close" id="agentPopupClose" aria-label="Fermer"><img src="/view/img/croix.svg" alt=""></button>
            <div class="agent-popup-head">
                <span class="agent-popup-avatar"><img src="/view/img/hoodie.webp" alt=""></span>
                <p class="agent-popup-title"><?php echo htmlspecialchars($_SESSION['admin_user']); ?></p>
            </div>
            <nav class="agent-popup-links">
                <a href="/gestion/dashboard">DASHBOARD</a>
                <a href="/gestion/score">SCORE</a>
            </nav>
            <a href="/gestion/logout" class="agent-popup-logout"><span>DECONNEXION</span></a>
        </div>
        <?php elseif (isset($_SESSION['user_logged_in'])): ?>
        <div class="agent-popup" id="agentPopup">
            <button type="button" class="agent-popup-close" id="agentPopupClose" aria-label="Fermer"><img src="/view/img/croix.svg" alt=""></button>
            <div class="agent-popup-head">
                <span class="agent-popup-avatar"><img src="/view/img/hoodie.webp" alt=""></span>
                <p class="agent-popup-title">AGENT ANONYME</p>
                <p class="agent-popup-sub"><?php echo htmlspecialchars($_SESSION['user_prenom']); ?></p>
            </div>
            <nav class="agent-popup-links">
                <a href="/profil">PROFIL</a>
                <a href="/profil/equipe">ÉQUIPE</a>
                <a href="/profil/rejoindre">REJOINDRE</a>
                <a href="/profil/score">SCORE</a>
                <a href="/profil/avis">LAISSEZ UN AVIS</a>
            </nav>
            <a href="/user/deconnexion" class="agent-popup-logout"><span>DECONNEXION</span></a>
        </div>
        <?php endif; ?>

        <?php if ($est_admin || isset($_SESSION['user_logged_in'])): ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('agentMenuBtn');
            var popup = document.getElementById('agentPopup');
            var close = document.getElementById('agentPopupClose');
            if (!btn || !popup) return;
            function setOpen(open) {
                popup.classList.toggle('is-open', open);
                popup.style.display = open ? 'block' : 'none';
            }
            setOpen(false);
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                setOpen(!popup.classList.contains('is-open'));
            });
            close.addEventListener('click', function() {
                setOpen(false);
            });
            document.addEventListener('click', function(e) {
                if (popup.classList.contains('is-open') && !popup.contains(e.target) && e.target !== btn) {
                    setOpen(false);
                }
            });
        });
        </script>
        <?php endif; ?>
    </header>
