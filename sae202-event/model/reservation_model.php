<?php
require_once('conf/conf.inc.php');

function genererCodeInvitation($db) {
    $lettres = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    do {
        $code = $lettres[random_int(0, 23)] . $lettres[random_int(0, 23)]
              . '-' . random_int(100, 999) . '-'
              . $lettres[random_int(0, 23)] . $lettres[random_int(0, 23)];
        $req = $db->prepare('SELECT COUNT(*) FROM reservations WHERE code_invitation = :code');
        $req->execute(['code' => $code]);
    } while ($req->fetchColumn() > 0);
    return $code;
}

function createReservation($user_id, $nom_equipe, $nb_joueurs, $date_reservation, $heure_reservation, $costumes = 0, $service_video = 0, $joueurs = null) {
    try {
        $db = getDB();
        $code = genererCodeInvitation($db);
        $req = $db->prepare('INSERT INTO reservations (user_id, nom_equipe, nb_joueurs, date_reservation, heure_reservation, costumes, service_video, joueurs, code_invitation)
                             VALUES (:user_id, :nom_equipe, :nb_joueurs, :date_reservation, :heure_reservation, :costumes, :service_video, :joueurs, :code_invitation)');
        $ok = $req->execute([
            'user_id'           => $user_id,
            'nom_equipe'        => $nom_equipe,
            'nb_joueurs'        => $nb_joueurs,
            'date_reservation'  => $date_reservation,
            'heure_reservation' => $heure_reservation,
            'costumes'          => $costumes,
            'service_video'     => $service_video,
            'joueurs'           => $joueurs,
            'code_invitation'   => $code
        ]);
        return $ok ? $code : false;
    } catch (PDOException $e) {
        return false;
    }
}

function getReservationsByUser($user_id) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT * FROM reservations WHERE user_id = :user_id ORDER BY date_reservation ASC');
        $req->execute(['user_id' => $user_id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function deleteReservation($id, $user_id) {
    try {
        $db = getDB();
        $req = $db->prepare('DELETE FROM reservations WHERE id = :id AND user_id = :user_id');
        $ok = $req->execute([
            'id'      => $id,
            'user_id' => $user_id
        ]);
        if ($ok) {
            $req = $db->prepare('DELETE FROM equipe_membres WHERE reservation_id = :id');
            $req->execute(['id' => $id]);
        }
        return $ok;
    } catch (PDOException $e) {
        return false;
    }
}

function assurerCodeInvitation($reservation_id) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT code_invitation FROM reservations WHERE id = :id');
        $req->execute(['id' => $reservation_id]);
        $code = $req->fetchColumn();
        if (!empty($code)) {
            return $code;
        }
        $code = genererCodeInvitation($db);
        $req = $db->prepare('UPDATE reservations SET code_invitation = :code WHERE id = :id');
        $req->execute(['code' => $code, 'id' => $reservation_id]);
        return $code;
    } catch (PDOException $e) {
        return '';
    }
}

function getReservationByCode($code) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT * FROM reservations WHERE code_invitation = :code');
        $req->execute(['code' => $code]);
        $resa = $req->fetch(PDO::FETCH_ASSOC);
        return $resa ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function getMembresEquipe($reservation_id) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT u.id, u.prenom, u.nom
                             FROM equipe_membres m
                             JOIN users u ON u.id = m.user_id
                             WHERE m.reservation_id = :id');
        $req->execute(['id' => $reservation_id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function estMembreEquipe($reservation_id, $user_id) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT COUNT(*) FROM equipe_membres WHERE reservation_id = :rid AND user_id = :uid');
        $req->execute(['rid' => $reservation_id, 'uid' => $user_id]);
        return $req->fetchColumn() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

function addMembreEquipe($reservation_id, $user_id) {
    try {
        $db = getDB();
        $req = $db->prepare('INSERT INTO equipe_membres (reservation_id, user_id) VALUES (:rid, :uid)');
        return $req->execute(['rid' => $reservation_id, 'uid' => $user_id]);
    } catch (PDOException $e) {
        return false;
    }
}

function assurerTableScores($db) {
    $db->exec("CREATE TABLE IF NOT EXISTS scores (
        reservation_id INT NOT NULL PRIMARY KEY,
        resultat VARCHAR(100) NOT NULL DEFAULT '',
        indices_trouves VARCHAR(100) NOT NULL DEFAULT '',
        temps_etape5 VARCHAR(100) NOT NULL DEFAULT ''
    ) DEFAULT CHARSET=utf8mb4");
}

function getScoreByReservation($reservation_id) {
    try {
        $db = getDB();
        assurerTableScores($db);
        $req = $db->prepare('SELECT * FROM scores WHERE reservation_id = :id');
        $req->execute(['id' => $reservation_id]);
        $score = $req->fetch(PDO::FETCH_ASSOC);
        return $score ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function getAllScoresMap() {
    try {
        $db = getDB();
        assurerTableScores($db);
        $map = [];
        foreach ($db->query('SELECT * FROM scores')->fetchAll(PDO::FETCH_ASSOC) as $s) {
            $map[$s['reservation_id']] = $s;
        }
        return $map;
    } catch (PDOException $e) {
        return [];
    }
}

function saveScore($reservation_id, $resultat, $indices, $temps) {
    try {
        $db = getDB();
        assurerTableScores($db);
        $req = $db->prepare('REPLACE INTO scores (reservation_id, resultat, indices_trouves, temps_etape5)
                             VALUES (:id, :resultat, :indices, :temps)');
        return $req->execute([
            'id'       => $reservation_id,
            'resultat' => $resultat,
            'indices'  => $indices,
            'temps'    => $temps
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

function getEquipesRejointes($user_id) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT r.*, u.prenom, u.nom
                             FROM reservations r
                             JOIN equipe_membres m ON m.reservation_id = r.id
                             JOIN users u ON u.id = r.user_id
                             WHERE m.user_id = :uid
                             ORDER BY r.date_reservation ASC');
        $req->execute(['uid' => $user_id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}
?>
