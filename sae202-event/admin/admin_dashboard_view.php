<main class="gestion-page">

    <h1 class="gestion-title">ADMINISTRATEUR</h1>

    <section class="adm-section">
        <h2 class="adm-section-title">BRIEFING MISSION</h2>
        <p class="adm-section-sub">Agent <?php echo htmlspecialchars($_SESSION['admin_user']); ?> &mdash; Tableau de bord</p>

        <div class="adm-stats">
            <div class="adm-stat">
                <span class="adm-stat-num"><?php echo (int)$stats['users']; ?></span>
                <span class="adm-stat-label">AGENTS<br>INSCRITS</span>
            </div>
            <div class="adm-stat">
                <span class="adm-stat-num"><?php echo (int)$stats['reservations']; ?></span>
                <span class="adm-stat-label">EXPÉDITIONS</span>
            </div>
            <div class="adm-stat">
                <span class="adm-stat-num"><?php echo (int)$stats['total_joueurs']; ?></span>
                <span class="adm-stat-label">JOUEURS<br>DÉPLOYÉS</span>
            </div>
            <div class="adm-stat">
                <span class="adm-stat-num"><?php echo (int)$stats['commentaires_attente']; ?></span>
                <span class="adm-stat-label">TÉMOIGNAGES<br>EN ATTENTE</span>
            </div>
        </div>
    </section>

    <section class="adm-section">
        <h2 class="adm-section-title">LISTE DES EXPÉDITIONS</h2>

        <?php if (empty($reservations)): ?>
            <p class="gestion-vide">Aucune expédition enregistrée.</p>
        <?php else: ?>
            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>ÉQUIPE</th>
                            <th>CHEF D'ÉQUIPE</th>
                            <th>EMAIL</th>
                            <th>JOUEURS</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $r): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['nom_equipe']); ?></td>
                            <td><?php echo htmlspecialchars($r['prenom'] . ' ' . $r['nom']); ?></td>
                            <td><?php echo htmlspecialchars($r['email']); ?></td>
                            <td><?php echo (int)$r['nb_joueurs']; ?></td>
                            <td><?php echo date('d/m/y', strtotime($r['date_reservation'])); ?></td>
                            <td class="adm-actions">
                                <a href="/gestion/dossier?id=<?php echo (int)$r['id']; ?>" class="adm-btn adm-btn-dossier">DOSSIER</a>
                                <a href="/gestion/supprimer?id=<?php echo (int)$r['id']; ?>"
                                   onclick="confirmSupprimerResa(event, '/gestion/supprimer?id=<?php echo (int)$r['id']; ?>', '<?php echo htmlspecialchars(addslashes($r['nom_equipe'])); ?>')"
                                   class="adm-btn adm-btn-suppr">SUPPRIMER</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

    <section class="adm-section">
        <h2 class="adm-section-title">MESSAGES EN ATTENTE DE MODÉRATION</h2>

        <?php if (empty($commentaires)): ?>
            <p class="gestion-vide">Aucun témoignage en attente de modération.</p>
        <?php else: ?>
            <div class="adm-messages">
                <?php foreach ($commentaires as $c): ?>
                <article class="adm-message">
                    <div class="adm-message-info">
                        <p class="adm-message-head">
                            Agent <?php echo htmlspecialchars($c['prenom'] . ' ' . $c['nom']); ?>
                            <span class="adm-message-date"><?php echo date('d/m/Y - H:i', strtotime($c['date_post'])); ?></span>
                        </p>
                        <p class="adm-message-text">"<?php echo htmlspecialchars($c['message']); ?>"</p>
                    </div>
                    <div class="adm-message-actions">
                        <form action="/gestion/moderer" method="POST">
                            <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
                            <input type="hidden" name="action" value="approuver">
                            <button type="submit" class="adm-btn adm-btn-dossier">APPROUVER</button>
                        </form>
                        <form action="/gestion/moderer" method="POST">
                            <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
                            <input type="hidden" name="action" value="rejeter">
                            <button type="submit" class="adm-btn adm-btn-suppr">REJETER</button>
                        </form>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <div class="adm-band">
        <img src="/view/img/logo.webp" alt="" class="adm-band-logo">
        <div class="adm-band-right">
            <span class="adm-band-name"><?php echo htmlspecialchars($_SESSION['admin_user']); ?></span>
            <a href="/gestion/logout" class="adm-band-logout">
                <img src="/view/img/admindeconnexion.png" alt="" class="adm-band-logout-bg">
                <span>DECONNEXION</span>
            </a>
        </div>
    </div>

</main>
