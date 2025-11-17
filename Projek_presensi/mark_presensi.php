<?php
require_once 'helpers.php';
require_login();
$user = current_user();
require_once 'db.php';

$classes = $mysqli->query("SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas")->fetch_all(MYSQLI_ASSOC);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_kelas = intval($_POST['id_kelas']);

    $mapels = $mysqli->query("
        SELECT mp.id_mapel, mp.nama_mapel 
        FROM kelas_mapel km
        JOIN mata_pelajaran mp ON km.id_mapel = mp.id_mapel
        WHERE km.id_kelas = $id_kelas
        ORDER BY mp.nama_mapel
    ")->fetch_all(MYSQLI_ASSOC);

    $students = $mysqli->query("
        SELECT s.nis, s.nama_siswa
        FROM kelas_siswa ks
        JOIN siswa s ON ks.nis = s.nis
        WHERE ks.id_kelas = $id_kelas
        ORDER BY s.nama_siswa
    ")->fetch_all(MYSQLI_ASSOC);

    $tanggal = $_POST['tanggal'];
    $nis = intval($_POST['nis']);
    $id_mapel = intval($_POST['id_mapel']);
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];

    $stmt = $mysqli->prepare("INSERT INTO presensi (tanggal, nis, id_kelas, id_mapel, status, keterangan)
                              VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiss", $tanggal, $nis, $id_kelas, $id_mapel, $status, $keterangan);
    $stmt->execute();
    $stmt->close();

    $message = "Presensi berhasil disimpan!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Input Presensi</title>
<style>
body { background:#eef4ff; font-family:Arial; padding:20px; }
.card {
    max-width:600px; margin:auto; background:white;
    padding:20px; border-radius:8px; border:1px solid #c5d6ff;
}
input, select, textarea, button {
    width:100%; padding:10px; margin:7px 0;
    border:1px solid #b7c7ff; border-radius:5px;
}
button { background:#1976d2; color:white; cursor:pointer; }
button:hover { background:#0d47a1; }
.note { color:green; }
</style>
</head>
<body>

<div class="card">
<h2>Input Presensi</h2>

<?php if ($message): ?><p class="note"><?= $message ?></p><?php endif; ?>

<form method="post">

<label>Kelas</label>
<select name="id_kelas" required>
    <?php foreach($classes as $c): ?>
        <option value="<?= $c['id_kelas'] ?>"><?= $c['nama_kelas'] ?></option>
    <?php endforeach; ?>
</select>

<label>Tanggal</label>
<input type="date" name="tanggal" required>

<label>Siswa</label>
<select name="nis" required>
    <?php foreach($students ?? [] as $s): ?>
        <option value="<?= $s['nis'] ?>"><?= $s['nama_siswa'] ?></option>
    <?php endforeach; ?>
</select>

<label>Mapel</label>
<select name="id_mapel" required>
    <?php foreach($mapels ?? [] as $m): ?>
        <option value="<?= $m['id_mapel'] ?>"><?= $m['nama_mapel'] ?></option>
    <?php endforeach; ?>
</select>

<label>Status</label>
<select name="status">
    <option>Hadir</option>
    <option>Izin</option>
    <option>Sakit</option>
    <option>Alpha</option>
</select>

<label>Keterangan</label>
<textarea name="keterangan"></textarea>

<button type="submit">Simpan</button>
</form>

</div>

</body>
</html>
