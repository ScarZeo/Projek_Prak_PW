<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Guru') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$guru_query = mysqli_query($conn, "SELECT g.* FROM guru g 
                                    JOIN akun a ON g.ID_Guru = SUBSTRING(a.Username, 5)
                                    WHERE a.Username = '$username'");
$guru_data = mysqli_fetch_assoc($guru_query);
$id_guru = $guru_data['ID_Guru'];

// Proses simpan presensi
if (isset($_POST['simpan_presensi'])) {
    $tanggal = $_POST['tanggal'];
    $id_kelas = $_POST['id_kelas'];
    $id_mapel = $_POST['id_mapel'];
    
    foreach ($_POST['status'] as $nis => $status) {
        $keterangan = isset($_POST['keterangan'][$nis]) ? $_POST['keterangan'][$nis] : '';
        
        $cek = mysqli_query($conn, "SELECT * FROM presensi 
                                    WHERE tanggal = '$tanggal' 
                                    AND nis = $nis 
                                    AND id_kelas = $id_kelas 
                                    AND id_mapel = $id_mapel");
        
        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE presensi SET 
                                status = '$status',
                                keterangan = '$keterangan'
                                WHERE tanggal = '$tanggal' 
                                AND nis = $nis 
                                AND id_kelas = $id_kelas 
                                AND id_mapel = $id_mapel");
        } else {
            mysqli_query($conn, "INSERT INTO presensi (tanggal, nis, id_kelas, id_mapel, status, keterangan)
                                VALUES ('$tanggal', $nis, $id_kelas, $id_mapel, '$status', '$keterangan')");
        }
    }
    
    $success = "Presensi berhasil disimpan!";
}

$mapel_list = mysqli_query($conn, "SELECT mp.*, k.Nama_Kelas 
                                    FROM mata_pelajaran mp
                                    JOIN kelas k ON mp.Kelas = k.ID_Kelas
                                    WHERE mp.id_guru = $id_guru
                                    ORDER BY k.ID_Kelas");

$id_mapel = isset($_GET['id_mapel']) ? $_GET['id_mapel'] : '';
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : '';
$tanggal = date('Y-m-d');

$siswa_list = [];
if ($id_mapel && $id_kelas) {
    $siswa_query = mysqli_query($conn, "SELECT s.*, 
                                        (SELECT status FROM presensi 
                                         WHERE nis = s.NIS 
                                         AND id_kelas = $id_kelas 
                                         AND id_mapel = $id_mapel 
                                         AND tanggal = '$tanggal') as status_presensi,
                                        (SELECT keterangan FROM presensi 
                                         WHERE nis = s.NIS 
                                         AND id_kelas = $id_kelas 
                                         AND id_mapel = $id_mapel 
                                         AND tanggal = '$tanggal') as ket_presensi
                                        FROM siswa s
                                        JOIN kelas_siswa ks ON s.NIS = ks.nis
                                        WHERE ks.id_kelas = $id_kelas
                                        ORDER BY s.nama_siswa");
    while ($row = mysqli_fetch_assoc($siswa_query)) {
        $siswa_list[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Presensi - Sistem Presensi SD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <h2 class="mb-4"><i class="bi bi-clipboard-check"></i> Input Presensi</h2>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> <?= $success ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Pilih Mata Pelajaran dan Kelas</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $tanggal ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mata Pelajaran & Kelas</label>
                            <select class="form-select" name="mapel_kelas" required onchange="this.form.submit()">
                                <option value="">-- Pilih --</option>
                                <?php while ($mapel = mysqli_fetch_assoc($mapel_list)): ?>
                                    <option value="<?= $mapel['ID_MaPel'] ?>|<?= $mapel['Kelas'] ?>"
                                            <?= ($id_mapel == $mapel['ID_MaPel'] && $id_kelas == $mapel['Kelas']) ? 'selected' : '' ?>>
                                        <?= $mapel['Nama_MaPel'] ?> - <?= $mapel['Nama_Kelas'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success w-100">Tampilkan</button>
                        </div>
                    </div>
                </form>
                
                <?php
                if (isset($_GET['mapel_kelas']) && !empty($_GET['mapel_kelas'])) {
                    list($id_mapel, $id_kelas) = explode('|', $_GET['mapel_kelas']);
                    echo "<script>window.location.href='input_presensi.php?id_mapel=$id_mapel&id_kelas=$id_kelas&tanggal=" . (isset($_GET['tanggal']) ? $_GET['tanggal'] : $tanggal) . "';</script>";
                }
                
                if (isset($_GET['tanggal'])) {
                    $tanggal = $_GET['tanggal'];
                }
                ?>
            </div>
        </div>
        
        <?php if (!empty($siswa_list)): ?>
        <form method="POST" action="">
            <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
            <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
            <input type="hidden" name="id_mapel" value="<?= $id_mapel ?>">
            
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Siswa</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">NIS</th>
                                    <th width="30%">Nama Siswa</th>
                                    <th width="20%">Status</th>
                                    <th width="30%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($siswa_list as $siswa): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $siswa['NIS'] ?></td>
                                    <td><?= $siswa['nama_siswa'] ?></td>
                                    <td>
                                        <select class="form-select form-select-sm" name="status[<?= $siswa['NIS'] ?>]" required>
                                            <option value="Hadir" <?= ($siswa['status_presensi'] == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
                                            <option value="Sakit" <?= ($siswa['status_presensi'] == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
                                            <option value="Izin" <?= ($siswa['status_presensi'] == 'Izin') ? 'selected' : '' ?>>Izin</option>
                                            <option value="Alpha" <?= ($siswa['status_presensi'] == 'Alpha') ? 'selected' : '' ?>>Alpha</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" 
                                               name="keterangan[<?= $siswa['NIS'] ?>]" 
                                               value="<?= $siswa['ket_presensi'] ?>"
                                               placeholder="Keterangan (opsional)">
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-end mt-3">
                        <button type="submit" name="simpan_presensi" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Simpan Presensi
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>