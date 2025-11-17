<?php
require_once 'helpers.php';
require_login();

// Ambil data lengkap sesuai role
$user = load_user_detail(current_user());

// Jika tidak punya nama, fallback ke username
$nama_user = $user['nama_admin'] 
    ?? $user['nama_guru'] 
    ?? $user['nama_siswa'] 
    ?? $user['username'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>

<style>
body { font-family: Arial; background: #f4f8ff; margin:0; padding:20px; }
.container {
    width: 400px; margin:auto; background:white;
    padding:20px; border-radius:8px; border:1px solid #e0e0e0;
}
a {
    display:block; padding:10px; margin:8px 0;
    background:#1976d2; color:white; text-decoration:none; border-radius:5px;
}
a:hover { background:#0d47a1; }
</style>
</head>
<body>

<div class="container">
<h2>Halo, <?= htmlspecialchars($nama_user) ?> (<?= htmlspecialchars($user['role']) ?>)</h2>

<a href="view_presensi.php">Lihat Presensi</a>

<?php if (in_array($user['role'], ['guru','admin'])): ?>
<a href="mark_presensi.php">Input Presensi</a>
<?php endif; ?>

<a href="logout.php">Logout</a>
</div>

</body>
</html>
