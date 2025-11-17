<?php
require_once 'helpers.php';
require_login();
require_once 'db.php';

$rows = $mysqli->query("
    SELECT p.*, s.nama_siswa, k.nama_kelas, m.nama_mapel
    FROM presensi p
    JOIN siswa s ON p.nis = s.nis
    JOIN kelas k ON p.id_kelas = k.id_kelas
    JOIN mata_pelajaran m ON p.id_mapel = m.id_mapel
    ORDER BY p.tanggal DESC
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Presensi</title>
<style>
body { font-family:Arial; background:#f4f8ff; padding:20px; }
.table {
    width:95%; margin:auto; border-collapse:collapse;
}
.table th, .table td {
    border:1px solid #d0d9ff; padding:8px;
}
.table th { background:#1976d2; color:white; }
</style>
</head>
<body>

<h2 style="text-align:center">Data Presensi</h2>

<table class="table">
<tr>
<th>Tanggal</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Mapel</th><th>Status</th><th>Keterangan</th>
</tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?= $r['tanggal'] ?></td>
<td><?= $r['nis'] ?></td>
<td><?= $r['nama_siswa'] ?></td>
<td><?= $r['nama_kelas'] ?></td>
<td><?= $r['nama_mapel'] ?></td>
<td><?= $r['status'] ?></td>
<td><?= $r['keterangan'] ?></td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>
