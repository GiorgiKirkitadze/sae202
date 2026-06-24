<main class="gestion-page">

    <h1 class="gestion-title">ADMINISTRATEUR</h1>

    <section class="adm-section">
        <div class="adm-dossier adm-score-card">
            <div class="adm-dossier-inner">

                <div class="adm-dossier-head">
                    <img src="/view/img/hoodies.webp" alt="" class="adm-dossier-team-icon">
                    <h2>DOSSIER ÉQUIPE : <?php echo htmlspecialchars($reservation['nom_equipe']); ?> (<?php echo (int)$reservation['nb_joueurs']; ?>)</h2>
                </div>

                <div class="adm-fiche">
                    <div class="adm-fiche-side">
                        <img src="/view/img/hoodie.webp" alt="" class="adm-fiche-icon">
                    </div>
                    <div class="adm-fiche-fields">
                        <p class="adm-fiche-role">Chef d'Équipe</p>
                        <div class="adm-fiche-box">
                            <div class="adm-field">
                                <span class="adm-field-label">NOM PRÉNOM</span>
                                <span class="adm-field-value"><?php echo htmlspecialchars($reservation['nom'] . ' ' . $reservation['prenom']); ?></span>
                            </div>
                            <div class="adm-field">
                                <span class="adm-field-label">ADRESSE MAIL</span>
                                <span class="adm-field-value"><?php echo htmlspecialchars($reservation['email']); ?></span>
                            </div>
                            <div class="adm-field">
                                <span class="adm-field-label">EXPÉDITION</span>
                                <span class="adm-field-value"><?php echo date('d/m/Y', strtotime($reservation['date_reservation'])); ?></span>
                            </div>
                            <div class="adm-field">
                                <span class="adm-field-label">OPTIONS</span>
                                <span class="adm-field-value">Costumes : <?php echo !empty($reservation['costumes']) ? 'Oui' : 'Non'; ?> &middot; Vidéo : <?php echo !empty($reservation['service_video']) ? 'Oui' : 'Non'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($joueurs as $i => $j): ?>
                <div class="adm-fiche">
                    <div class="adm-fiche-side">
                        <img src="/view/img/hoodie.webp" alt="" class="adm-fiche-icon">
                    </div>
                    <div class="adm-fiche-fields">
                        <p class="adm-fiche-role">Joueur <?php echo $i + 1; ?></p>
                        <div class="adm-fiche-box">
                            <div class="adm-field">
                                <span class="adm-field-label">NOM PRÉNOM</span>
                                <span class="adm-field-value"><?php echo htmlspecialchars($j['nom'] ?? ''); ?></span>
                            </div>
                            <div class="adm-field">
                                <span class="adm-field-label">ADRESSE MAIL</span>
                                <span class="adm-field-value"><?php echo htmlspecialchars($j['email'] ?? ''); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="adm-dossier-actions">
                    <a href="mailto:<?php echo htmlspecialchars($reservation['email']); ?>?subject=Votre expédition au Domaine" class="adm-btn adm-btn-dossier">ENVOYER LE SUIVI</a>
                    <a href="/gestion/supprimer?id=<?php echo (int)$reservation['id']; ?>"
                       onclick="confirmSupprimerResa(event, '/gestion/supprimer?id=<?php echo (int)$reservation['id']; ?>', '<?php echo htmlspecialchars(addslashes($reservation['nom_equipe'])); ?>')"
                       class="adm-btn adm-btn-suppr">SUPPRIMER</a>
                </div>

            </div>
        </div>

        <div class="adm-retour-wrap">
            <a href="/gestion/dashboard" class="adm-retour">RETOUR</a>
        </div>
    </section>

    <div class="adm-band">
        <img src="/view/img/logo.webp" alt="" class="adm-band-logo">
        <div class="adm-band-right">
            <span class="adm-band-name"><?php echo htmlspecialchars($_SESSION['admin_user']); ?></span>
            <a href="/gestion/logout" class="adm-band-logout">
                <img src="/view/img/admindeconnexion.png" alt="" class="adm-band-logout-bg">
                <span>DECONNEXION</span>
            </a>
        </div>
    </div>

</main>
