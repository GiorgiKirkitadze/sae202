    <?php if (empty($masquer_footer)): ?>
    <footer class="site-footer">
        <div class="footer-left">
            <img src="/view/img/logo.webp" alt="L'ombre du domaine" class="footer-logo">
            <p class="footer-contact"><img src="/view/img/repasicon.svg" alt="" class="footer-orn"> 03 16 81 90 67</p>
            <p class="footer-contact"><img src="/view/img/repasicon.svg" alt="" class="footer-orn"> ombre.domaine@gmail.com</p>
        </div>

        <img src="/view/img/linevertical.svg" alt="" class="footer-divider">

        <div class="footer-right">
            <div class="footer-links">
                <ul class="footer-col">
                    <li><a href="/evenement">Événement</a></li>
                    <li><a href="/tarifs">Tarifs</a></li>
                    <li><a href="/contact">Nous contacter</a></li>
                </ul>
                <ul class="footer-col">
                    <li><a href="/mentions">Mentions légales</a></li>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-socials">
                <a href="#" class="footer-social" aria-label="Facebook"><img src="/view/img/facebook.svg" alt="Facebook"></a>
                <a href="#" class="footer-social" aria-label="Instagram"><img src="/view/img/instagram.svg" alt="Instagram"></a>
                <a href="#" class="footer-social" aria-label="TikTok"><img src="/view/img/tiktok.svg" alt="TikTok"></a>
                <a href="#" class="footer-social" aria-label="YouTube"><img src="/view/img/youtube.svg" alt="YouTube"></a>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <div id="globalCustomModal" class="custom-modal-overlay">
        <div class="custom-modal">
            <h3 id="customModalTitle">Confirmation</h3>
            <p id="customModalText">Voulez-vous vraiment effectuer cette action ?</p>
            <div class="custom-modal-buttons">
                <button id="customModalCancelBtn" class="custom-modal-btn custom-modal-btn-cancel">Annuler</button>
                <button id="customModalConfirmBtn" class="custom-modal-btn custom-modal-btn-confirm">Confirmer</button>
            </div>
        </div>
    </div>

    <script>
    function showCustomConfirm(title, message) {
        return new Promise((resolve) => {
            const overlay = document.getElementById('globalCustomModal');
            const titleEl = document.getElementById('customModalTitle');
            const textEl = document.getElementById('customModalText');
            const confirmBtn = document.getElementById('customModalConfirmBtn');
            const cancelBtn = document.getElementById('customModalCancelBtn');

            titleEl.textContent = title;
            textEl.textContent = message;
            overlay.classList.add('active');

            confirmBtn.onclick = () => {
                overlay.classList.remove('active');
                resolve(true);
            };

            cancelBtn.onclick = () => {
                overlay.classList.remove('active');
                resolve(false);
            };
        });
    }

    async function confirmAnnuler(event, url) {
        event.preventDefault();
        const confirmation = await showCustomConfirm('ANNULATION', 'Êtes-vous sûr de vouloir annuler cette expédition ?');
        if (confirmation) {
            window.location.href = url;
        }
    }

    async function confirmSupprimerResa(event, url, nomEquipe) {
        event.preventDefault();
        const confirmation = await showCustomConfirm('SUPPRIMER L\'EXPÉDITION', 'Supprimer définitivement l\'expédition "' + nomEquipe + '" ? Cette action est irréversible.');
        if (confirmation) {
            window.location.href = url;
        }
    }

    (function() {
        var header = document.querySelector('header');
        if (!header) return;
        var lastY = window.pageYOffset || 0;
        var ticking = false;
        window.addEventListener('scroll', function() {
            if (ticking) return;
            ticking = true;
            window.requestAnimationFrame(function() {
                var y = window.pageYOffset || 0;
                if (y > lastY && y > 100) {
                    header.classList.add('header-hidden');
                } else {
                    header.classList.remove('header-hidden');
                }
                lastY = y;
                ticking = false;
            });
        }, { passive: true });
    })();
    </script>
</body>
</html>
