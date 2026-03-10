<?php
// Veřejný endpoint — vrátí obsah technologie.json pro použití na hlavním webu.
// Přímý přístup k .json souborům je zablokován v admin/.htaccess,
// tento PHP soubor proto slouží jako průchod.
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

$file = __DIR__ . '/technologie.json';
if (file_exists($file)) {
    echo file_get_contents($file);
} else {
    echo '{}';
}
