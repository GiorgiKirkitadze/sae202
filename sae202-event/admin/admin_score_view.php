<main class="gestion-page">

    <h1 class="gestion-title">ADMINISTRATEUR</h1>

    <section class="adm-section">

        <?php if (empty($reservations)): ?>
            <p class="gestion-vide">Aucune expédition enregistrée.</p>
        <?php else: ?>
            <?php foreach ($reservations as $r): ?>
            <?php $s = $scores[$r['id']] ?? null; ?>
            <div class="adm-score-entry">
                <p class="adm-score-date"><?php echo date('d/m/Y', strtotime($r['date_reservation'])); ?> :</p>

                <div class="adm-dossier adm-score-card">
                    <div class="adm-dossier-inner">

                        <div class="adm-score-head">
                            <img src="/view/img/hoodies.webp" alt="" class="adm-dossier-team-icon">
                            <span class="adm-score-equipe">Équipe : <?php echo htmlspecialchars($r['nom_equipe']); ?> (<?php echo (int)$r['nb_joueurs']; ?>)</span>
                            <span class="adm-score-chef">Chef d'Équipe : <?php echo htmlspecialchars($r['prenom'] . ' ' . $r['nom']); ?></span>
                        </div>

                        <form action="/gestion/score" method="POST" class="adm-score-form">
                            <input type="hidden" name="reservation_id" value="<?php echo (int)$r['id']; ?>">

                            <div class="adm-score-row">
                                <label>RÉSULTAT DE LA MISSION :</label>
                                <input type="text" name="resultat" value="<?php echo htmlspecialchars($s['resultat'] ?? ''); ?>">
                            </div>
                            <div class="adm-score-row">
                                <label>INDICES TROUVÉS :</label>
                                <input type="text" name="indices_trouves" value="<?php echo htmlspecialchars($s['indices_trouves'] ?? ''); ?>">
                            </div>
                            <div class="adm-score-row">
                                <label>TEMPS PASSÉ ÉTAPE 5 :</label>
                                <input type="text" name="temps_etape5" value="<?php echo htmlspecialchars($s['temps_etape5'] ?? ''); ?>">
                            </div>

                            <button type="submit" class="adm-btn adm-btn-dossier adm-score-save">ENREGISTRER</button>
                        </form>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

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
