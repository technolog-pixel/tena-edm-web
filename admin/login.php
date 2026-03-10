<?php
session_start();
$username = "Jednatel";
$password_hash = password_hash("TenaEDM1", PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.html");
    exit;
}

if ($_POST['username'] === $username && password_verify($_POST['password'], $password_hash)) {
    session_regenerate_id(true);
    $_SESSION['admin'] = true;
    header("Location: editor.php");
} else {
    header("Location: index.html?error=1");
}
exit;
