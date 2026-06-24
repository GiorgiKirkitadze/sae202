<main class="equipe-page">
    <div class="equipe-wrap">

        <h1 class="equipe-page-title">Espace Agent : <?php echo htmlspecialchars($_SESSION['user_prenom']); ?></h1>

        <?php if (!empty($flash)): ?>
        <div class="contact-flash <?php echo $flash['type'] === 'success' ? 'ok' : 'ko'; ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
        <?php endif; ?>

        <h3 class="equipe-section-title">Vos Expéditions (Réservations) :</h3>

        <?php if (!empty($reservations)): ?>
            <?php foreach ($reservations as $resa): ?>
                <?php
                $joueurs = !empty($resa['joueurs']) ? json_decode($resa['joueurs'], true) : [];
                if (!is_array($joueurs)) $joueurs = [];
                $slots = [$_SESSION['user_prenom'] . ' (chef)'];
                foreach ($joueurs as $j) {
                    if (!empty($j['nom'])) $slots[] = $j['nom'];
                }
                foreach ($resa['membres'] as $m) {
                    $slots[] = $m['prenom'] . ' ' . $m['nom'];
                }
                $nb_membres = max((int)$resa['nb_joueurs'], count($slots));
                while (count($slots) < (int)$resa['nb_joueurs']) {
                    $slots[] = '';
                }
                ?>
                <div class="equipe-bloc">
                    <div style="background-color: #4d3c29; padding: 25px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                        <div>
                            <strong style="color: #edca69; font-size: 1.3rem; font-family: 'P22 Typewriter', monospace;">Équipe : <?php echo htmlspecialchars($resa['nom_equipe']); ?></strong>
                            <p style="margin: 10px 0 0 0; font-size: 1.1rem; color: #e0cea5; display: flex; align-items: center; gap: 8px;">
                                <img src="/view/img/hoodies.webp" alt="" class="resa-mini-ico"> <?php echo $nb_membres; ?> Membres
                            </p>
                            <p style="margin: 5px 0 0 0; font-size: 1.1rem; color: #c4b583; display: flex; align-items: center; gap: 8px;">
                                <img src="/view/img/horloge 1.webp" alt="" class="resa-mini-ico"> Le <?php echo htmlspecialchars($resa['date_reservation']); ?>
                            </p>
                            <?php if (isset($resa['costumes']) || isset($resa['service_video'])): ?>
                            <p style="margin: 8px 0 0 0; font-size: 0.95rem; color: #c4b583; display: flex; align-items: center; gap: 8px;">
                                <img src="/view/img/repasicon.svg" alt="" class="resa-mini-ico"> Costumes : <?php echo !empty($resa['costumes']) ? 'Oui' : 'Non'; ?>
                                &nbsp;·&nbsp; Vidéo : <?php echo !empty($resa['service_video']) ? 'Oui' : 'Non'; ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <a href="/profil/annuler?id=<?php echo (int)$resa['id']; ?>" onclick="confirmAnnuler(event, '/profil/annuler?id=<?php echo (int)$resa['id']; ?>')" style="background-color: #af6743; color: #e0cea5; padding: 12px 22px; text-decoration: none; border-radius: 5px; font-weight: bold; font-family: 'P22 Typewriter', monospace; font-size: 14px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">Annuler</a>
                        </div>
                    </div>

                    <h2 class="equipe-heading">MON ÉQUIPE</h2>
                    <div class="equipe-cards">
                        <div class="equipe-membres-card">
                            <?php foreach ($slots as $nom): ?>
                            <div class="equipe-membre-row">
                                <img src="/view/img/hoodie.webp" alt="" class="equipe-membre-ico">
                                <span class="equipe-membre-line"><?php echo htmlspecialchars($nom); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="equipe-code-card">
                            <p class="equipe-code-titre">CODE D'INVITATION</p>
                            <div class="equipe-code-box"><?php echo htmlspecialchars($resa['code_invitation']); ?></div>
                            <button type="button" class="equipe-copier" data-code="<?php echo htmlspecialchars($resa['code_invitation']); ?>">COPIER</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="equipe-vide">
                <p>Vous n'avez aucune expédition prévue pour le moment.</p>
                <a href="/reservation" class="equipe-vide-btn">Réserver maintenant</a>
            </div>
        <?php endif; ?>

        <?php if (!empty($rejointes)): ?>
        <h3 class="equipe-section-title">Équipes rejointes :</h3>

        <?php foreach ($rejointes as $resa): ?>
            <?php
            $joueurs = !empty($resa['joueurs']) ? json_decode($resa['joueurs'], true) : [];
            if (!is_array($joueurs)) $joueurs = [];
            $slots = [$resa['prenom'] . ' ' . $resa['nom'] . ' (chef)'];
            foreach ($joueurs as $j) {
                if (!empty($j['nom'])) $slots[] = $j['nom'];
            }
            foreach ($resa['membres'] as $m) {
                $slots[] = $m['prenom'] . ' ' . $m['nom'];
            }
            while (count($slots) < (int)$resa['nb_joueurs']) {
                $slots[] = '';
            }
            ?>
            <div class="equipe-bloc">
                <div style="background-color: #4d3c29; padding: 25px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <strong style="color: #edca69; font-size: 1.3rem; font-family: 'P22 Typewriter', monospace;">Équipe : <?php echo htmlspecialchars($resa['nom_equipe']); ?></strong>
                    <p style="margin: 10px 0 0 0; font-size: 1.1rem; color: #c4b583; display: flex; align-items: center; gap: 8px;">
                        <img src="/view/img/horloge 1.webp" alt="" class="resa-mini-ico"> Le <?php echo htmlspecialchars($resa['date_reservation']); ?>
                    </p>
                </div>

                <h2 class="equipe-heading">MON ÉQUIPE</h2>
                <div class="equipe-cards">
                    <div class="equipe-membres-card">
                        <?php foreach ($slots as $nom): ?>
                        <div class="equipe-membre-row">
                            <img src="/view/img/hoodie.webp" alt="" class="equipe-membre-ico">
                            <span class="equipe-membre-line"><?php echo htmlspecialchars($nom); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="equipe-code-card">
                        <p class="equipe-code-titre">CODE D'INVITATION</p>
                        <div class="equipe-code-box"><?php echo htmlspecialchars($resa['code_invitation']); ?></div>
                        <button type="button" class="equipe-copier" data-code="<?php echo htmlspecialchars($resa['code_invitation']); ?>">COPIER</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <script>
    document.querySelectorAll('.equipe-copier').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var code = btn.dataset.code;
            function ok() {
                var t = btn.textContent;
                btn.textContent = 'COPIÉ !';
                setTimeout(function() { btn.textContent = t; }, 1500);
            }
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(code).then(ok);
            } else {
                var ta = document.createElement('textarea');
                ta.value = code;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                ok();
            }
        });
    });
    </script>

</main>
