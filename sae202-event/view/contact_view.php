<main class="accueil-main contact-page">

    <section class="contact-hero">
        <img src="/view/img/forest.webp" alt="" class="contact-hero-bg">
        <div class="contact-hero-content">
            <h1>L'OMBRE DU DOMAINE</h1>
            <p>Expérience immersive de nuit</p>
        </div>
    </section>

    <section class="infos-pratiques">
        <h2 class="infos-pratiques-title">INFOS PRATIQUES</h2>
        <div class="infos-pratiques-inner">
            <ul class="infos-coord">
                <li><img src="/view/img/repasicon.svg" alt="" class="coord-icon"> 03 16 81 90 67</li>
                <li><img src="/view/img/repasicon.svg" alt="" class="coord-icon"> ombre.domaine@gmail.com</li>
                <li><img src="/view/img/repasicon.svg" alt="" class="coord-icon"> 12 Chemin du Gaty, Piney 10220</li>
                <li><img src="/view/img/repasicon.svg" alt="" class="coord-icon"> Ouvert 6j/7</li>
            </ul>
            <div class="infos-map">
                <img src="/view/img/contact/map.png" alt="Carte du Domaine">
            </div>
        </div>
    </section>

    <section class="contact-form-section">

        <?php if (!empty($success)): ?>
        <div class="contact-flash ok"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
        <div class="contact-flash ko"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="contact-parchment">
            <img src="/view/img/paper.webp" alt="" class="contact-parchment-bg">
            <div class="contact-parchment-inner">
                <div class="contact-form-heading">
                    <img src="/view/img/contact/repasicondark.svg" alt="" class="contact-form-icon">
                    <h2>NOUS CONTACTER</h2>
                </div>

                <form action="/contact/envoyer" method="POST" class="contact-form">
                    <div class="form-row">
                        <div class="cfield-wrap">
                            <label>NOM</label>
                            <div class="cfield cfield-nom">
                                <input type="text" name="nom" required value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="cfield-wrap">
                            <label>PRENOM</label>
                            <div class="cfield cfield-prenom">
                                <input type="text" name="prenom" value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>ADRESSE MAIL</label>
                        <div class="cfield cfield-adress">
                            <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>TÉLÉPHONE</label>
                        <div class="cfield cfield-tel">
                            <input type="text" name="telephone" value="<?php echo htmlspecialchars($_POST['telephone'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>MESSAGE</label>
                        <div class="cfield cfield-msg">
                            <textarea name="message" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="contact-send"><span>ENVOYER</span></button>
                </form>
            </div>
        </div>
    </section>

    <section class="contact-cta">
        <a href="/reservation" class="infos-reserver">
            <img src="/view/img/smallpaper.webp" alt="" class="infos-reserver-bg">
            <span>RESERVER</span>
        </a>
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
        </div>
    </section>

</main>
