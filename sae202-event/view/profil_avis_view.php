<main class="avis-page">

    <section class="profil-temoignage">
        <div class="profil-temoignage-band">
            <p class="profil-temoignage-text">
                Vous avez <strong>survécu</strong> au Domaine ?<br>
                <strong>Brisez le silence</strong> et partagez votre histoire.
            </p>
        </div>
    </section>

    <div class="avis-inner">

        <?php if (!empty($flash)): ?>
        <div class="contact-flash <?php echo $flash['type'] === 'success' ? 'ok' : 'ko'; ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
        <?php endif; ?>

        <div class="profil-temoignage-form is-open">
            <form action="/profil/commenter" method="POST">
                <label class="profil-temoignage-label">VOTRE EXPÉRIENCE</label>
                <textarea name="message" required placeholder="Partagez votre expérience au sein du Cercle..." rows="5"></textarea>

                <div class="rating-row">
                    <span class="rating-label">VOTRE NOTE :</span>
                    <input type="hidden" name="note" id="noteInput" value="5">
                    <div class="rating-stars" id="ratingStars">
                        <?php for ($s = 1; $s <= 5; $s++): ?>
                        <img src="/view/img/stars.svg" class="rating-star active" data-value="<?php echo $s; ?>" alt="">
                        <?php endfor; ?>
                    </div>
                </div>

                <button type="submit" class="profil-temoignage-submit">Soumettre le témoignage</button>
            </form>

            <?php if (!empty($commentaires)): ?>
            <div class="profil-comments">
                <p class="profil-comments-title">Vos témoignages :</p>
                <?php foreach ($commentaires as $c): ?>
                <?php
                    $statut = $c['statut'];
                    $badge_color = $statut === 'approuve' ? '#2d6a2d' : ($statut === 'rejete' ? '#6a2d2d' : '#5a4a20');
                    $badge_label = $statut === 'approuve' ? '✓ Approuvé' : ($statut === 'rejete' ? '✗ Rejeté' : '⏳ En attente');
                ?>
                <div class="profil-comment">
                    <p><?php echo htmlspecialchars($c['message']); ?></p>
                    <span class="profil-badge" style="background-color: <?php echo $badge_color; ?>;"><?php echo $badge_label; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

    </div>

    <script>
    (function() {
        var stars = document.querySelectorAll('#ratingStars .rating-star');
        var input = document.getElementById('noteInput');
        if (!stars.length || !input) return;
        function paint(n) {
            stars.forEach(function(st) {
                st.classList.toggle('active', parseInt(st.dataset.value, 10) <= n);
            });
        }
        stars.forEach(function(st) {
            st.addEventListener('click', function() {
                input.value = st.dataset.value;
                paint(parseInt(st.dataset.value, 10));
            });
            st.addEventListener('mouseenter', function() {
                paint(parseInt(st.dataset.value, 10));
            });
        });
        document.getElementById('ratingStars').addEventListener('mouseleave', function() {
            paint(parseInt(input.value, 10));
        });
    })();
    </script>

</main>
