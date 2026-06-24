<main class="auth-main">
    <div class="auth-card">
        <h2 class="auth-title">Inscription</h2>
        <p class="auth-subtitle">Rejoignez le Domaine</p>
        <form action="/user/valider_inscription" method="POST">
            <div class="auth-field">
                <label for="prenom">Prénom</label>
                <input class="auth-input" id="prenom" type="text" name="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="auth-field">
                <label for="nom">Nom</label>
                <input class="auth-input" id="nom" type="text" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="auth-field">
                <label for="email">Email</label>
                <input class="auth-input" id="email" type="email" name="email" placeholder="Votre Email" required>
            </div>
            <div class="auth-field">
                <label for="password">Mot de passe</label>
                <input class="auth-input" id="password" type="password" name="password" placeholder="6 caractères minimum" required>
            </div>
            <button type="submit" class="auth-submit">S'inscrire</button>
        </form>
        <div class="auth-divider"><span>&#10022;</span></div>
        <p class="auth-footer">Déjà initié ? <a href="/user/connexion">Se connecter</a></p>
    </div>
</main>
