<?php

$host_courant = $_SERVER['HTTP_HOST'] ?? 'localhost';

if (strpos($host_courant, 'localhost') !== false || strpos($host_courant, '127.0.0.1') !== false) {
    define("HOST",     "localhost");
    define("DBNAME",   "sae202_event");
    define("USER",     "event_user");
    define("PASSWORD", "EventPass2026");
} elseif (strpos($host_courant, 'site.je') !== false) {
    define("HOST",     "sql307.infinityfree.com");
    define("DBNAME",   "if0_42136541_event");
    define("USER",     "if0_42136541");
    define("PASSWORD", "9DBK2dAaUx");
} else {
    define("HOST",     "localhost");
    define("DBNAME",   "sae202_event");
    define("USER",     "event_user");
    define("PASSWORD", "EventPass2026!");
}

function getDB() {
    static $db = null;
    if ($db === null) {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $db;
}
?>
