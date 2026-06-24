<main class="accueil-main resa-page">

    <section class="resa-intro">
        <h1>RESERVER</h1>
        <p class="resa-intro-sub">Inscription des joueurs</p>
        <p class="resa-intro-brand">Le cercle des égarés</p>
        <p class="resa-intro-text">
            Réservez votre aventure <strong>en ligne</strong>, par <strong>téléphone</strong> ou directement <strong>sur place</strong>.
        </p>
        <p class="resa-intro-text">
            Un contretemps ? Merci de nous appeler directement pour toute modification de votre réservation.
        </p>
    </section>

    <section class="resa-form-section" id="resa-form-top">
        <div class="resa-parchment">
            <img src="/view/img/paper.webp" alt="" class="resa-parchment-bg">
            <div class="resa-parchment-inner">

                <span class="resa-watermark">RÉSERVATION 1</span>

                <div class="resa-heading-row">
                    <img src="/view/img/contact/repasicondark.svg" alt="" class="resa-heading-orn">
                    <h2 class="resa-heading">RÉSERVER EN LIGNE</h2>
                </div>

                <form action="/reservation/reserver" method="POST" class="resa-form">

                    <div class="resa-top">
                        <div class="resa-top-col">
                            <label class="resa-label">NOM D'ÉQUIPE</label>
                            <div class="resa-field resa-field-equipe">
                                <img src="/view/img/reservation/equipe.svg" alt="" class="resa-field-bg">
                                <input type="text" name="nom_equipe" required>
                            </div>
                        </div>
                        <div class="resa-top-col resa-top-date">
                            <label class="resa-label">VOTRE DATE</label>
                            <div class="resa-date-row">
                                <div class="resa-field resa-field-day">
                                    <img src="/view/img/reservation/day.svg" alt="" class="resa-field-bg">
                                    <input type="number" name="jour" min="1" max="31" placeholder="JJ" required>
                                </div>
                                <div class="resa-field resa-field-month">
                                    <img src="/view/img/reservation/month.svg" alt="" class="resa-field-bg">
                                    <input type="number" name="mois" min="1" max="12" placeholder="MM" required>
                                </div>
                                <div class="resa-field resa-field-year">
                                    <img src="/view/img/reservation/year.svg" alt="" class="resa-field-bg">
                                    <input type="number" name="annee" min="2026" max="2030" placeholder="AAAA" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="resa-nb-row">
                        <label class="resa-label">NOMBRE DE PARTICIPANTS (+16)</label>
                        <div class="resa-field resa-field-nb">
                            <img src="/view/img/reservation/participant.svg" alt="" class="resa-field-bg">
                            <input type="number" name="nb_joueurs" min="2" max="6" placeholder="0" required>
                        </div>
                    </div>

                    <div class="resa-players" id="resa-players">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="resa-player-row" data-player="<?php echo $i; ?>">
                            <div class="resa-player-id">
                                <img src="/view/img/hoodie.webp" alt="" class="resa-player-icon">
                                <span class="resa-player-num">J<?php echo $i; ?></span>
                            </div>
                            <div class="resa-field-group resa-group-name">
                                <span class="resa-field-label">NOM PRÉNOM</span>
                                <div class="resa-field resa-field-nomprenom">
                                    <img src="/view/img/reservation/nomprenom.svg" alt="" class="resa-field-bg">
                                    <input type="text" name="joueur_nom[]" autocomplete="off">
                                </div>
                            </div>
                            <div class="resa-field-group resa-group-email">
                                <span class="resa-field-label">ADRESSE MAIL</span>
                                <div class="resa-field resa-field-email">
                                    <img src="/view/img/reservation/adresseemail.svg" alt="" class="resa-field-bg">
                                    <input type="email" name="joueur_email[]" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <div class="resa-option">
                        <p class="resa-option-q">SOUHAITEZ-VOUS LOUER DES COSTUMES ?</p>
                        <div class="resa-choices">
                            <label class="resa-choice">
                                <span class="resa-choice-label">OUI</span>
                                <input type="radio" name="costumes" value="1">
                                <span class="resa-box"></span>
                            </label>
                            <label class="resa-choice">
                                <span class="resa-choice-label">NON</span>
                                <input type="radio" name="costumes" value="0" checked>
                                <span class="resa-box"></span>
                            </label>
                        </div>
                    </div>

                    <div class="resa-option">
                        <p class="resa-option-q">SOUHAITEZ-VOUS LE SERVICE VIDÉO ?</p>
                        <div class="resa-choices">
                            <label class="resa-choice">
                                <span class="resa-choice-label">OUI</span>
                                <input type="radio" name="service_video" value="1">
                                <span class="resa-box"></span>
                            </label>
                            <label class="resa-choice">
                                <span class="resa-choice-label">NON</span>
                                <input type="radio" name="service_video" value="0" checked>
                                <span class="resa-box"></span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="resa-submit">
                        <img src="/view/img/reservation/reserver.svg" alt="" class="resa-submit-bg">
                        <span>RESERVER</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="resa-alt">
            <div class="resa-ou">OU</div>
            <h3 class="resa-alt-title">RÉSERVATION TÉLÉPHONIQUE</h3>
            <p class="resa-alt-info">03 16 81 90 67</p>

            <div class="resa-ou">OU</div>
            <h3 class="resa-alt-title">RÉSERVATION SUR PLACE</h3>
            <p class="resa-alt-info">12 Chemin du Gaty, Piney 10220</p>
        </div>
    </section>

    <section class="resa-horaires">
        <div class="resa-horaires-band">
            <div class="resa-horaires-titlerow">
                <img src="/view/img/horloge 1.webp" alt="" class="resa-horaires-clock">
                <h2 class="resa-horaires-title">NOS HORAIRES</h2>
            </div>
            <div class="resa-horaires-grid">
                <div class="resa-horaires-col">
                    <span class="resa-horaires-day">LUNDI - MERCREDI</span>
                    <span class="resa-horaires-hours">9H<br>-<br>18H30</span>
                </div>
                <div class="resa-horaires-col">
                    <span class="resa-horaires-day">JEUDI</span>
                    <span class="resa-horaires-hours">9H<br>-<br>19H</span>
                </div>
                <div class="resa-horaires-col">
                    <span class="resa-horaires-day">VENDREDI - SAMEDI</span>
                    <span class="resa-horaires-hours">9H<br>-<br>20H</span>
                </div>
                <div class="resa-horaires-col">
                    <span class="resa-horaires-day">DIMANCHE</span>
                    <span class="resa-horaires-hours">Fermé</span>
                </div>
            </div>

            <div style="text-align:center; margin-top: 30px;">
                <a href="#resa-form-top" class="btn-primary">RÉSERVER MAINTENANT</a>
            </div>
        </div>
    </section>

    <script>
    (function() {
        var nb   = document.querySelector('.resa-form input[name="nb_joueurs"]');
        var rows = document.querySelectorAll('#resa-players .resa-player-row');
        if (!nb || !rows.length) return;

        function sync() {
            var n = parseInt(nb.value, 10);
            if (isNaN(n) || n < 0) n = 0;
            rows.forEach(function(row, i) {
                var show = i < n;
                row.style.display = show ? '' : 'none';
                row.querySelectorAll('input').forEach(function(inp) { inp.disabled = !show; });
            });
        }

        nb.addEventListener('input', sync);
        sync();
    })();
    </script>

</main>
