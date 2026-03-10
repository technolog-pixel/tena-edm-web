<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

if (empty($_SESSION['admin'])) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Nepřihlášen']);
    exit;
}

$json_file = __DIR__ . '/data/technologie.json';

// Načtení existujících dat
$data = [];
if (file_exists($json_file)) {
    $data = json_decode(file_get_contents($json_file), true) ?? [];
}

// Uložení textových polí pro všech 5 technologií
for ($i = 1; $i <= 5; $i++) {
    foreach (['title', 'desc'] as $field) {
        $key = "t{$i}_{$field}";
        if (isset($_POST["{$key}_cs"])) $data['cs'][$key] = $_POST["{$key}_cs"];
        if (isset($_POST["{$key}_en"])) $data['en'][$key] = $_POST["{$key}_en"];
    }
}

// Zpracování nahrávaných obrázků
$allowed_mime = ['image/jpeg', 'image/png', 'image/webp'];
$upload_dir   = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Technologie' . DIRECTORY_SEPARATOR;

for ($i = 1; $i <= 5; $i++) {
    $file_key = "img_{$i}";
    if (empty($_FILES[$file_key]['tmp_name'])) continue;

    $file = $_FILES[$file_key];
    if ($file['error'] !== UPLOAD_ERR_OK) continue;

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $allowed_mime, true)) continue;
    if ($file['size'] > 5 * 1024 * 1024) continue;

    $ext = match($mime) {
        'image/jpeg' => '.jpg',
        'image/webp' => '.webp',
        default      => '.png',
    };
    $filename = "t{$i}_" . date('Ymd_His') . $ext;
    $dest = $upload_dir . $filename;

    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    if (move_uploaded_file($file['tmp_name'], $dest)) {
        $data['images']["t{$i}"] = 'Technologie/' . $filename;
    }
}

$data['lastUpdated'] = date('d.m.Y H:i:s');

$json_str = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
if (file_put_contents($json_file, $json_str) !== false) {
    echo json_encode(['status' => 'success', 'lastUpdated' => $data['lastUpdated']]);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Nelze zapsat soubor. Zkontrolujte oprávnění složky admin/data/.']);
}
