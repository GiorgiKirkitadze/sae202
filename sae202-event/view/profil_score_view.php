<main class="accueil-main score-page">

    <section class="contact-hero">
        <img src="/view/img/forest.webp" alt="" class="contact-hero-bg">
        <div class="contact-hero-content">
            <h1>L'OMBRE DU DOMAINE</h1>
            <p>Expérience immersive de nuit</p>
        </div>
    </section>

    <section class="score-section">
        <h1 class="score-title">MON SCORE</h1>

        <div class="contact-parchment score-parchment">
            <img src="/view/img/paper.webp" alt="" class="contact-parchment-bg">
            <div class="contact-parchment-inner score-inner">

                <div class="score-team-row">
                    <img src="/view/img/hoodies.webp" alt="" class="score-team-icon">
                    <div class="score-team-field">
                        <span class="score-label">NOM D'ÉQUIPE</span>
                        <div class="score-box score-box-equipe">
                            <img src="/view/img/reservation/equipe.svg" alt="" class="score-box-bg">
                            <span class="score-value"><?php echo $derniere ? htmlspecialchars($derniere['nom_equipe']) : ''; ?></span>
                        </div>
                    </div>
                </div>

                <div class="score-row">
                    <span class="score-label">RÉSULTAT DE LA MISSION :</span>
                    <div class="score-box score-box-small">
                        <img src="/view/img/profile/naissance.svg" alt="" class="score-box-bg">
                        <span class="score-value"><?php echo htmlspecialchars($score['resultat'] ?? ''); ?></span>
                    </div>
                </div>

                <div class="score-row">
                    <span class="score-label">INDICES TROUVÉS :</span>
                    <div class="score-box score-box-small">
                        <img src="/view/img/profile/naissance.svg" alt="" class="score-box-bg">
                        <span class="score-value"><?php echo htmlspecialchars($score['indices_trouves'] ?? ''); ?></span>
                    </div>
                </div>

                <div class="score-row">
                    <span class="score-label">TEMPS PASSÉ ÉTAPE 5 :</span>
                    <div class="score-box score-box-small">
                        <img src="/view/img/profile/naissance.svg" alt="" class="score-box-bg">
                        <span class="score-value"><?php echo htmlspecialchars($score['temps_etape5'] ?? ''); ?></span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="profil-temoignage">
        <div class="profil-temoignage-band">
            <p class="profil-temoignage-text">
                Vous avez <strong>survécu</strong> au Domaine ?<br>
                <strong>Brisez le silence</strong> et partagez votre histoire.
            </p>
            <a href="/profil/avis" class="profil-exp-btn">
                <span>JE PARLE DE MON EXPÉRIENCE</span>
            </a>
        </div>
    </section>

</main>
