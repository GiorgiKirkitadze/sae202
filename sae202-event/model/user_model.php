<?php
require_once('conf/conf.inc.php');

function getUserByEmail($email) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');
        $req->execute(['email' => $email]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

function getUserById($id) {
    try {
        $db = getDB();
        $req = $db->prepare('SELECT id, prenom, nom, email, telephone, naissance FROM users WHERE id = :id');
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}

function createUser($prenom, $nom, $email, $password, $telephone = null, $naissance = null) {
    try {
        $db = getDB();
        $req = $db->prepare('INSERT INTO users (prenom, nom, email, password, telephone, naissance) VALUES (:prenom, :nom, :email, :password, :telephone, :naissance)');
        $req->execute([
            'prenom'    => $prenom,
            'nom'       => $nom,
            'email'     => $email,
            'password'  => $password,
            'telephone' => $telephone,
            'naissance' => $naissance
        ]);
        return $db->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}

function updateUser($id, $prenom, $nom, $email, $hashed_password = null, $telephone = null, $naissance = null) {
    try {
        $db = getDB();
        if ($hashed_password) {
            $req = $db->prepare('UPDATE users SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, naissance = :naissance, password = :password WHERE id = :id');
            return $req->execute(['id' => $id, 'prenom' => $prenom, 'nom' => $nom, 'email' => $email, 'telephone' => $telephone, 'naissance' => $naissance, 'password' => $hashed_password]);
        } else {
            $req = $db->prepare('UPDATE users SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, naissance = :naissance WHERE id = :id');
            return $req->execute(['id' => $id, 'prenom' => $prenom, 'nom' => $nom, 'email' => $email, 'telephone' => $telephone, 'naissance' => $naissance]);
        }
    } catch (PDOException $e) {
        return false;
    }
}
?>
