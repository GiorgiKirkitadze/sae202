<?php
require_once('conf/conf.inc.php');

function addCommentaire($user_id, $message, $note = 5) {
    try {
        $db = getDB();
        $req = $db->prepare("INSERT INTO commentaires (user_id, message, note, statut, date_post) VALUES (:user_id, :message, :note, 'attente', NOW())");
        return $req->execute(['user_id' => $user_id, 'message' => $message, 'note' => $note]);
    } catch (PDOException $e) {
        return false;
    }
}

function getCommentairesByUser($user_id) {
    try {
        $db = getDB();
        $req = $db->prepare("SELECT * FROM commentaires WHERE user_id = :user_id ORDER BY date_post DESC");
        $req->execute(['user_id' => $user_id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function getCommentairesApprouves() {
    try {
        $db = getDB();
        $req = $db->query("
            SELECT c.message, c.note, c.date_post, u.prenom, u.nom
            FROM commentaires c
            JOIN users u ON c.user_id = u.id
            WHERE c.statut = 'approuve'
            ORDER BY c.date_post DESC
            LIMIT 6
        ");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}
?>
