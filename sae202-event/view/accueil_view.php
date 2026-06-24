<main class="accueil-main">

    <div class="fade-in-overlay"></div>

    <section class="hero-fullscreen">
        <video class="hero-video" autoplay loop muted playsinline>
            <source src="/view/img/test.mp4" type="video/mp4">
        </video>
        <div class="hero-gradient"></div>
        <div class="hero-content">
            <p class="hero-eyebrow">Expérience immersive de nuit</p>
            <h1 class="hero-title">L'OMBRE DU DOMAINE</h1>
            <a href="/reservation" class="btn-primary">RÉSERVER L'EXPÉRIENCE</a>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <section class="section-story reverse">
        <div class="story-block">
            <div class="story-divider"></div>
            <h2 class="story-heading">Oseriez-vous franchir la lisière ?</h2>
            <div class="story-inner">
                <div class="story-text">
                    <p class="story-para"><img src="/view/img/repasicon.svg" alt="" class="story-orn">Le Domaine ne figure sur aucune carte officielle. C'est un refuge secret pour les esprits curieux et les archivistes de l'étrange. En franchissant la lisière, vous laissez le monde moderne derrière vous pour vous enfoncer dans une quête mystique où chaque ombre abrite un secret oublié. Suivez les fréquences du talkie-walkie, et devenez l'initié de votre propre histoire.</p>
                    <a href="/reservation" class="btn-secondary">Rejoindre le Domaine →</a>
                </div>
                <div class="story-image">
                    <img src="/view/img/image1.webp" alt="Rituel nocturne">
                </div>
            </div>
        </div>
    </section>

    <section class="section-features">
        <div class="features-inner">
            <div class="features-band">
                <h2>L'ombre du domaine en quelques mots</h2>
                <div class="features-grid">
                <div class="feature-item">
                    <img src="/view/img/noconnection.webp" alt="Déconnectée">
                    <h4>DÉCONNECTÉE</h4>
                    <p>Téléphones confisqués à l'entrée</p>
                </div>
                <div class="feature-item">
                    <img src="/view/img/hoodie.webp" alt="Clandestine">
                    <h4>CLANDESTINE</h4>
                    <p>Un lieu secret hors des cartes</p>
                </div>
                <div class="feature-item">
                    <img src="/view/img/time.webp" alt="Sous tension">
                    <h4>SOUS TENSION</h4>
                    <p>Chaque choix a des conséquences</p>
                </div>
                <div class="feature-item">
                    <img src="/view/img/hoodies.webp" alt="Collective">
                    <h4>COLLECTIVE</h4>
                    <p>Une aventure à vivre en équipe</p>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-story">
        <div class="story-inner">
            <div class="story-text">
                <h2>Un thriller<br>grandeur nature</h2>
                <p class="story-para"><img src="/view/img/repasicon.svg" alt="" class="story-orn">Un thriller immersif grandeur nature qui vous plonge au cœur d'un camp forestier isolé. Vos téléphones portables sont confisqués dès votre arrivée pour vous garantir une déconnexion et une immersion absolues. Entre jeu de rôle, infiltration et escape game, vous devenez l'acteur principal d'une enquête sous haute tension où chaque choix et chaque indice comptent pour réussir à vous échapper.</p>
            </div>
            <div class="story-image">
                <img src="/view/img/image2.webp" alt="Autel du domaine">
            </div>
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
                <a href="/reservation" class="btn-primary">RÉSERVER MAINTENANT</a>
            </div>
        </div>
    </section>

    <section class="section-temoignages">
        <h2 class="temoignages-title">ILS ONT ESSAYÉS&nbsp;&nbsp;&nbsp;ILS ONT AIMÉS</h2>

        <?php
        $mois_fr = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        $papiers = ['/view/img/1stpaper.webp', '/view/img/2ndpaper.webp'];
        ?>

        <?php if (!empty($commentaires)): ?>
            <div class="temoignages-carousel">
                <button type="button" class="temo-nav" id="temoPrev" aria-label="Précédent">&#8249;</button>
                <div class="temoignages-grid" id="temoTrack">
                <?php foreach ($commentaires as $i => $c):
                    $ts = strtotime($c['date_post']);
                    $sous_titre = $mois_fr[(int)date('n', $ts)] . ' ' . date('Y', $ts);
                ?>
                    <article class="temoignage-card">
                        <img src="<?php echo $papiers[$i % 2]; ?>" alt="" class="temoignage-card-bg">
                        <div class="temoignage-card-inner">
                            <div class="temoignage-head">
                                <img src="/view/img/hoodie.webp" alt="" class="temoignage-avatar">
                                <div class="temoignage-id">
                                    <span class="temoignage-nom"><?php echo htmlspecialchars($c['prenom'] . ' ' . $c['nom']); ?></span>
                                    <span class="temoignage-sous"><?php echo htmlspecialchars($sous_titre); ?></span>
                                </div>
                            </div>
                            <p class="temoignage-message"><?php echo nl2br(htmlspecialchars($c['message'])); ?></p>
                            <div class="temoignage-stars">
                                <?php $note = isset($c['note']) ? (int)$c['note'] : 5; ?>
                                <?php for ($s = 0; $s < $note; $s++): ?>
                                    <img src="/view/img/stars.svg" alt="">
                                <?php endfor; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
                </div>
                <button type="button" class="temo-nav" id="temoNext" aria-label="Suivant">&#8250;</button>
            </div>
        <?php else: ?>
            <p class="temoignages-vide">Aucun témoignage pour l'instant. Soyez la première âme à partager votre passage dans le Domaine.</p>
        <?php endif; ?>

        <div class="temoignages-cta">
            <a href="/profil" class="temoignage-banner">
                <img src="/view/img/halfpaper.webp" alt="" class="temoignage-banner-bg">
                <span>JE PARLE DE MON EXPÉRIENCE</span>
            </a>
        </div>
    </section>

    <script>
    (function() {
        var track = document.getElementById('temoTrack');
        var prev = document.getElementById('temoPrev');
        var next = document.getElementById('temoNext');
        if (!track || !prev || !next) return;
        function page(dir) {
            track.scrollBy({ left: dir * track.clientWidth, behavior: 'smooth' });
        }
        prev.addEventListener('click', function() { page(-1); });
        next.addEventListener('click', function() { page(1); });
    })();
    </script>

</main>
