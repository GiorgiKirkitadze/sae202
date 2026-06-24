<main class="auth-main">
    <div class="auth-card">
        <h2 class="auth-title">Accès Staff</h2>
        <p class="auth-subtitle">Zone réservée aux gardiens du Domaine</p>
        <form action="/gestion/login" method="POST">
            <div class="auth-field">
                <label for="username">Nom d'utilisateur</label>
                <input class="auth-input" id="username" type="text" name="username" placeholder="Votre identifiant" required>
            </div>
            <div class="auth-field">
                <label for="password">Mot de passe</label>
                <input class="auth-input" id="password" type="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <button type="submit" class="auth-submit">Connexion</button>
        </form>
        <div class="auth-divider"><span>&#10022;</span></div>
        <p class="auth-footer">Espace privé &middot; personnel autorisé uniquement</p>
    </div>
</main>
