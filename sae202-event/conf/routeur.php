<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$items = explode('/', $path);

if (empty($items[1])) {
   $controller = 'accueil';
} else {
   $controller = $items[1];
}

if (empty($items[2])) {
 $action = 'index';
} else {
 $action = $items[2];
}

$controller_file = 'controller/' . $controller . '_controller.php';

if (!file_exists($controller_file)) {
    $controller_file = 'admin/' . $controller . '_controller.php';
}

if (file_exists($controller_file)) {
    require_once($controller_file);
    if (function_exists($action)) {
        $action();
    } else {
        echo "404 - Action introuvable";
    }
} else {
    echo "404 - Page introuvable";
}
?>

