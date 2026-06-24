<?php
$dateFr = $resa['date'];
$ts = strtotime($resa['date']);
if ($ts) {
    $dateFr = date('d/m/Y', $ts);
}
?>
<main class="accueil-main resa-page resa-confirm-page">

    <section class="resa-confirm-section">
        <div class="resa-parchment">
            <img src="/view/img/paper.webp" alt="" class="resa-parchment-bg">
            <div class="resa-parchment-inner resa-confirm-inner">

                <span class="resa-watermark">DOSSIER SCELLÉ</span>

                <div class="resa-confirm-seal">
                    <img src="/view/img/contact/repasicondark.svg" alt="">
                </div>

                <h1 class="resa-confirm-title">VOTRE PLACE EST RÉSERVÉE</h1>
                <p class="resa-confirm-sub">
                    Le Cercle des Égarés vous attend, agent
                    <strong><?php echo htmlspecialchars($_SESSION['user_prenom']); ?></strong>.
                </p>

                <div class="resa-confirm-recap">
                    <div class="resa-confirm-row">
                        <span class="resa-confirm-key">Équipe</span>
                        <span class="resa-confirm-val"><?php echo htmlspecialchars($resa['nom_equipe']); ?></span>
                    </div>
                    <div class="resa-confirm-row">
                        <span class="resa-confirm-key">Date de l'expédition</span>
                        <span class="resa-confirm-val"><?php echo htmlspecialchars($dateFr); ?></span>
                    </div>
                    <div class="resa-confirm-row">
                        <span class="resa-confirm-key">Participants</span>
                        <span class="resa-confirm-val"><?php echo (int)$resa['nb_joueurs']; ?></span>
                    </div>
                    <div class="resa-confirm-row">
                        <span class="resa-confirm-key">Costumes</span>
                        <span class="resa-confirm-val"><?php echo !empty($resa['costumes']) ? 'Oui' : 'Non'; ?></span>
                    </div>
                    <div class="resa-confirm-row">
                        <span class="resa-confirm-key">Service vidéo</span>
                        <span class="resa-confirm-val"><?php echo !empty($resa['service_video']) ? 'Oui' : 'Non'; ?></span>
                    </div>
                </div>

                <div class="resa-confirm-code">
                    <p class="resa-confirm-code-label">CODE D'INVITATION DE VOTRE ÉQUIPE</p>
                    <div class="resa-confirm-code-box"><?php echo htmlspecialchars($resa['code']); ?></div>
                    <button type="button" class="equipe-copier resa-confirm-copier" data-code="<?php echo htmlspecialchars($resa['code']); ?>">COPIER LE CODE</button>
                    <p class="resa-confirm-code-hint">Partagez ce code pour que vos coéquipiers rejoignent l'expédition (6 participants maximum).</p>
                </div>

                <div class="resa-confirm-actions">
                    <a href="/profil/equipe" class="btn-primary">VOIR MON ÉQUIPE</a>
                    <a href="/" class="resa-confirm-home">Retour à l'accueil</a>
                </div>

            </div>
        </div>
    </section>

    <script>
    document.querySelectorAll('.resa-confirm-copier').forEach(function(btn) {
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
