<main class="cnx-page">

    <section class="cnx-block">
        <h2 class="cnx-heading">SE CONNECTER</h2>

        <div class="contact-parchment cnx-parchment-login">
            <img src="/view/img/paper.webp" alt="" class="contact-parchment-bg">
            <div class="contact-parchment-inner">
                <form action="/user/valider_connexion" method="POST" class="contact-form">
                    <div class="cfield-wrap">
                        <label>ADRESSE MAIL :</label>
                        <div class="cfield cfield-adress">
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="cfield-wrap">
                        <label>MOT DE PASSE :</label>
                        <div class="cfield cfield-tel">
                            <input type="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="contact-send"><span>SE CONNECTER</span></button>
                </form>
            </div>
        </div>
    </section>

    <div class="cnx-ou">OU</div>

    <section class="cnx-block">
        <h2 class="cnx-heading">S'INSCRIRE</h2>

        <div class="contact-parchment">
            <img src="/view/img/paper.webp" alt="" class="contact-parchment-bg">
            <div class="contact-parchment-inner">
                <form action="/user/valider_inscription" method="POST" class="contact-form" id="cnx-register-form">
                    <div class="form-row">
                        <div class="cfield-wrap">
                            <label>NOM :</label>
                            <div class="cfield cfield-nom">
                                <input type="text" name="nom" required>
                            </div>
                        </div>
                        <div class="cfield-wrap">
                            <label>PRÉNOM :</label>
                            <div class="cfield cfield-prenom">
                                <input type="text" name="prenom" required>
                            </div>
                        </div>
                        <div class="cfield-wrap">
                            <label>NAISSANCE :</label>
                            <div class="cfield cfield-nom">
                                <input type="text" name="naissance" placeholder="JJ/MM/AAAA">
                            </div>
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>ADRESSE MAIL :</label>
                        <div class="cfield cfield-adress">
                            <input type="email" name="email" required>
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>TÉLÉPHONE :</label>
                        <div class="cfield cfield-tel">
                            <input type="text" name="telephone">
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>MOT DE PASSE :</label>
                        <div class="cfield cfield-adress">
                            <input type="password" name="password" id="cnx-pwd" required minlength="6">
                        </div>
                    </div>

                    <div class="cfield-wrap">
                        <label>CONFIRMATION DE MOT DE PASSE :</label>
                        <div class="cfield cfield-adress">
                            <input type="password" name="confirm_password" id="cnx-pwd2" required>
                        </div>
                    </div>

                    <button type="submit" class="contact-send"><span>S'INSCRIRE</span></button>
                </form>
            </div>
        </div>
    </section>

    <script>
    (function() {
        var form = document.getElementById('cnx-register-form');
        if (!form) return;
        form.addEventListener('submit', function(e) {
            var p1 = document.getElementById('cnx-pwd').value;
            var p2 = document.getElementById('cnx-pwd2').value;
            if (p1 !== p2) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
            }
        });
    })();
    </script>

</main>
