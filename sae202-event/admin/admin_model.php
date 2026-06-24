<?php
require_once('conf/conf.inc.php');

function getAdmin($username) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT * FROM admins WHERE username = :username');
        $req->execute(['username' => $username]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

function getStats() {
    try {
        $db = getDB();
        return [
            'users'                => $db->query('SELECT COUNT(*) FROM users')->fetchColumn(),
            'reservations'         => $db->query('SELECT COUNT(*) FROM reservations')->fetchColumn(),
            'commentaires_attente' => $db->query("SELECT COUNT(*) FROM commentaires WHERE statut = 'attente'")->fetchColumn(),
            'total_joueurs'        => $db->query('SELECT COALESCE(SUM(nb_joueurs), 0) FROM reservations')->fetchColumn(),
        ];
    } catch (PDOException $e) {
        return ['users' => 0, 'reservations' => 0, 'commentaires_attente' => 0, 'total_joueurs' => 0];
    }
}

function getAllReservations() {
    try {
        $db = getDB();
        $req = $db->query('
            SELECT r.*, u.prenom, u.nom, u.email
            FROM reservations r
            JOIN users u ON r.user_id = u.id
            ORDER BY r.date_reservation ASC, r.heure_reservation ASC
        ');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function getCommentairesEnAttente() {
    try {
        $db = getDB();
        $req = $db->query("
            SELECT c.*, u.prenom, u.nom
            FROM commentaires c
            JOIN users u ON c.user_id = u.id
            WHERE c.statut = 'attente'
            ORDER BY c.date_post ASC
        ");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function getReservationAdmin($id) {
    try {
        $db = getDB();
        $req = $db->prepare('
            SELECT r.*, u.prenom, u.nom, u.email
            FROM reservations r
            JOIN users u ON r.user_id = u.id
            WHERE r.id = :id
        ');
        $req->execute(['id' => $id]);
        $resa = $req->fetch(PDO::FETCH_ASSOC);
        return $resa ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function deleteReservationAdmin($id) {
    try {
        $db = getDB();
        $req = $db->prepare('DELETE FROM reservations WHERE id = :id');
        return $req->execute(['id' => $id]);
    } catch (PDOException $e) {
        return false;
    }
}

function approuverCommentaire($id) {
    try {
        $db = getDB();
        $req = $db->prepare("UPDATE commentaires SET statut = 'approuve' WHERE id = :id");
        return $req->execute(['id' => $id]);
    } catch (PDOException $e) {
        return false;
    }
}

function rejeterCommentaire($id) {
    try {
        $db = getDB();
        $req = $db->prepare("UPDATE commentaires SET statut = 'rejete' WHERE id = :id");
        return $req->execute(['id' => $id]);
    } catch (PDOException $e) {
        return false;
    }
}
?>
