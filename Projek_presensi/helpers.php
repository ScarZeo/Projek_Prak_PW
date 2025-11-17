<?php
session_start();
require_once 'db.php';

function is_logged_in() {
    return isset($_SESSION['user']);
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}

function current_user() {
    return $_SESSION['user'] ?? null;
}

/* Ambil data tambahan berdasarkan role */
function load_user_detail($user) {
    global $mysqli;
    $role = strtolower($user['role']);
    $id   = $user['id_akun'];

    if ($role == 'admin') {
        $q = $mysqli->prepare("SELECT nama_admin FROM admin WHERE akun_id=?");
    } else if ($role == 'guru') {
        $q = $mysqli->prepare("SELECT nama_guru FROM guru WHERE akun_id=?");
    } else if ($role == 'siswa') {
        $q = $mysqli->prepare("SELECT nama_siswa FROM siswa WHERE akun_id=?");
    } else return $user;

    $q->bind_param("i", $id);
    $q->execute();
    $extra = $q->get_result()->fetch_assoc() ?? [];
    $q->close();

    return array_merge($user, $extra);
}
?>

