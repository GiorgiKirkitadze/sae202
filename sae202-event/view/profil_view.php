<main style="background-color: #2B2816; color: #e0cea5; min-height: 80vh; padding: 50px 20px; font-family: 'EB Garamond', serif;">
    <div style="max-width: 800px; margin: 0 auto;">

        <h1 style="font-family: 'P22 Typewriter', monospace; color: #edca69; margin-bottom: 40px; font-size: 2.5rem;">
            Espace Agent : <?php echo htmlspecialchars($prenom); ?>
        </h1>

        <?php if (!empty($flash)): ?>
        <div style="background-color: <?php echo $flash['type'] === 'success' ? '#2d6a2d' : '#6a2d2d'; ?>; color: #e0cea5; padding: 15px 20px; border-radius: 8px; margin-bottom: 30px; text-align: center; font-size: 1.05rem;">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
        <?php endif; ?>

        <section class="profil-infos">
            <span class="profil-infos-watermark">infos 1</span>
            <h2 class="profil-infos-title">MES INFORMATIONS</h2>

            <div class="contact-parchment profil-parchment">
                <img src="/view/img/paper.webp" alt="" class="contact-parchment-bg">
                <div class="contact-parchment-inner">
                    <form action="/profil/modifier" method="POST" class="profil-form">
                        <div class="profil-grid">
                            <div class="profil-id-col">
                                <img src="/view/img/hoodie.webp" alt="" class="profil-id-icon">
                                <div class="cfield cfield-nomequipe">
                                    <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom'] ?? ''); ?>" placeholder="Prénom" required>
                                </div>
                                <div class="cfield cfield-nomequipe">
                                    <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>" placeholder="Nom" required>
                                </div>
                            </div>

                            <div class="profil-fields-col">
                                <div class="profil-field">
                                    <label>NAISSANCE :</label>
                                    <div class="cfield cfield-naissance">
                                        <input type="text" name="naissance" value="<?php echo htmlspecialchars($user['naissance'] ?? ''); ?>" placeholder="JJ/MM/AAAA">
                                    </div>
                                </div>
                                <div class="profil-field">
                                    <label>ADRESSE MAIL :</label>
                                    <div class="cfield cfield-mailtel">
                                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                                    </div>
                                </div>
                                <div class="profil-field">
                                    <label>TÉLÉPHONE :</label>
                                    <div class="cfield cfield-mailtel">
                                        <input type="text" name="telephone" value="<?php echo htmlspecialchars($user['telephone'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="profil-field">
                                    <label>MOT DE PASSE :</label>
                                    <div class="cfield cfield-mailtel">
                                        <input type="password" name="new_password" placeholder="••••••••">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profil-actions">
                            <button type="submit" class="profil-action-btn profil-btn-modif">
                                <span>MODIFIER LE PROFIL</span>
                            </button>
                            <a href="/user/deconnexion" class="profil-action-btn profil-btn-deco">
                                <span>DÉCONNEXION</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

</main>
