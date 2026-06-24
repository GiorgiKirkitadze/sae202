<main class="equipe-page">
    <div class="equipe-wrap rejoindre-wrap">

        <h1 class="equipe-page-title">REJOINDRE UNE ÉQUIPE</h1>

        <?php if (!empty($flash)): ?>
        <div class="contact-flash <?php echo $flash['type'] === 'success' ? 'ok' : 'ko'; ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
        <?php endif; ?>

        <div class="rejoindre-card">
            <img src="/view/img/hoodies.webp" alt="" class="rejoindre-ico">
            <p class="rejoindre-texte">
                Entrez le code d'invitation transmis par votre chef d'équipe pour rejoindre son expédition.
            </p>
            <form action="/profil/rejoindre" method="POST" class="rejoindre-form">
                <label class="equipe-code-titre" for="codeInvitation">CODE D'INVITATION</label>
                <input type="text" name="code" id="codeInvitation" class="rejoindre-input" placeholder="XJ-456-TY" maxlength="12" required>
                <button type="submit" class="equipe-copier rejoindre-btn">REJOINDRE</button>
            </form>
        </div>

    </div>
</main>
