<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];

// DASHBOARD ADMIN
if ($role == 'Admin') {
    $total_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
    $total_guru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM guru"))['total'];
    $total_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas"))['total'];
    $total_mapel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mata_pelajaran"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Presensi SD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .stat-card {
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card.blue { border-left-color: #0d6efd; }
        .stat-card.green { border-left-color: #198754; }
        .stat-card.purple { border-left-color: #6f42c1; }
        .stat-card.orange { border-left-color: #fd7e14; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Admin</h2>
            <span class="text-muted">Selamat datang, <?= $username ?></span>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card stat-card blue shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Siswa</h6>
                                <h2 class="mb-0"><?= $total_siswa ?></h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people-fill text-primary fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card green shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Guru</h6>
                                <h2 class="mb-0"><?= $total_guru ?></h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-person-badge-fill text-success fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card purple shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Kelas</h6>
                                <h2 class="mb-0"><?= $total_kelas ?></h2>
                            </div>
                            <div class="bg-purple bg-opacity-10 p-3 rounded" style="background-color: rgba(111, 66, 193, 0.1) !important;">
                                <i class="bi bi-door-open-fill fs-2" style="color: #6f42c1;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card orange shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Mata Pelajaran</h6>
                                <h2 class="mb-0"><?= $total_mapel ?></h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-book-fill text-warning fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Menu Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="siswa.php" class="btn btn-outline-primary w-100 py-3">
                                    <i class="bi bi-people fs-3 d-block mb-2"></i>
                                    Kelola Siswa
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="guru.php" class="btn btn-outline-success w-100 py-3">
                                    <i class="bi bi-person-badge fs-3 d-block mb-2"></i>
                                    Kelola Guru
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="kelas.php" class="btn btn-outline-purple w-100 py-3" style="color: #6f42c1; border-color: #6f42c1;">
                                    <i class="bi bi-door-open fs-3 d-block mb-2"></i>
                                    Kelola Kelas
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="mapel.php" class="btn btn-outline-warning w-100 py-3">
                                    <i class="bi bi-book fs-3 d-block mb-2"></i>
                                    Mata Pelajaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// DASHBOARD GURU
} elseif ($role == 'Guru') {
    $guru_query = mysqli_query($conn, "SELECT g.* FROM guru g 
                                        JOIN akun a ON g.ID_Guru = SUBSTRING(a.Username, 5)
                                        WHERE a.Username = '$username'");
    $guru_data = mysqli_fetch_assoc($guru_query);
    $id_guru = $guru_data['ID_Guru'];
    
    $total_mapel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mata_pelajaran WHERE id_guru = $id_guru"))['total'];
    
    $total_siswa_query = mysqli_query($conn, "SELECT COUNT(DISTINCT ks.nis) as total 
                                               FROM kelas_siswa ks
                                               JOIN mata_pelajaran mp ON ks.id_kelas = mp.Kelas
                                               WHERE mp.id_guru = $id_guru");
    $total_siswa = mysqli_fetch_assoc($total_siswa_query)['total'];
    
    $mapel_query = mysqli_query($conn, "SELECT mp.*, k.Nama_Kelas 
                                         FROM mata_pelajaran mp
                                         JOIN kelas k ON mp.Kelas = k.ID_Kelas
                                         WHERE mp.id_guru = $id_guru
                                         ORDER BY k.ID_Kelas, mp.Nama_MaPel");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - Sistem Presensi SD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Guru</h2>
            <span class="text-muted">Selamat datang, <?= $guru_data['nama_guru'] ?></span>
        </div>
        
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Mata Pelajaran Diampu</h6>
                                <h2 class="mb-0"><?= $total_mapel ?></h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-book-fill text-primary fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card shadow-sm border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Siswa</h6>
                                <h2 class="mb-0"><?= $total_siswa ?></h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people-fill text-success fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-book"></i> Mata Pelajaran Yang Diampu</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($mapel = mysqli_fetch_assoc($mapel_query)): 
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $mapel['Nama_MaPel'] ?></td>
                                <td><span class="badge bg-info"><?= $mapel['Nama_Kelas'] ?></span></td>
                                <td>
                                    <a href="input_presensi.php?id_mapel=<?= $mapel['ID_MaPel'] ?>&id_kelas=<?= $mapel['Kelas'] ?>" 
                                       class="btn btn-sm btn-success">
                                        <i class="bi bi-clipboard-check"></i> Input Presensi
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// DASHBOARD SISWA
} else {
    $nis = $username;
    
    $siswa_query = mysqli_query($conn, "SELECT s.*, k.Nama_Kelas, k.ID_Kelas 
                                         FROM siswa s
                                         JOIN kelas_siswa ks ON s.NIS = ks.nis
                                         JOIN kelas k ON ks.id_kelas = k.ID_Kelas
                                         WHERE s.NIS = '$nis'");
    $siswa_data = mysqli_fetch_assoc($siswa_query);
    
    $bulan_ini = date('Y-m');
    $stats = mysqli_query($conn, "SELECT 
                                  COUNT(*) as total,
                                  SUM(CASE WHEN status = 'Hadir' THEN 1 ELSE 0 END) as hadir,
                                  SUM(CASE WHEN status = 'Sakit' THEN 1 ELSE 0 END) as sakit,
                                  SUM(CASE WHEN status = 'Izin' THEN 1 ELSE 0 END) as izin,
                                  SUM(CASE WHEN status = 'Alpha' THEN 1 ELSE 0 END) as alpha
                                  FROM presensi 
                                  WHERE nis = '$nis' 
                                  AND DATE_FORMAT(tanggal, '%Y-%m') = '$bulan_ini'");
    $stat_data = mysqli_fetch_assoc($stats);
    
    $presensi_terbaru = mysqli_query($conn, "SELECT p.*, mp.Nama_MaPel, k.Nama_Kelas
                                             FROM presensi p
                                             JOIN mata_pelajaran mp ON p.id_mapel = mp.ID_MaPel
                                             JOIN kelas k ON p.id_kelas = k.ID_Kelas
                                             WHERE p.nis = '$nis'
                                             ORDER BY p.tanggal DESC
                                             LIMIT 10");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Sistem Presensi SD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .stat-card {
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2>Dashboard Siswa</h2>
                <p class="text-muted mb-0">Selamat datang, <?= $siswa_data['nama_siswa'] ?></p>
                <p class="text-muted"><i class="bi bi-card-text"></i> NIS: <?= $siswa_data['NIS'] ?> | <i class="bi bi-door-open"></i> <?= $siswa_data['Nama_Kelas'] ?></p>
            </div>
            <div class="col-md-4 text-end">
                <div class="card bg-info text-white">
                    <div class="card-body py-2">
                        <h6 class="mb-0">Bulan Ini</h6>
                        <h4 class="mb-0"><?= date('F Y') ?></h4>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card stat-card shadow-sm" style="border-left-color: #198754;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Hadir</h6>
                                <h2 class="mb-0 text-success"><?= $stat_data['hadir'] ?></h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-check-circle-fill text-success fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card shadow-sm" style="border-left-color: #ffc107;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Sakit</h6>
                                <h2 class="mb-0 text-warning"><?= $stat_data['sakit'] ?></h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-thermometer-half text-warning fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card shadow-sm" style="border-left-color: #0dcaf0;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Izin</h6>
                                <h2 class="mb-0 text-info"><?= $stat_data['izin'] ?></h2>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-envelope-paper text-info fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card shadow-sm" style="border-left-color: #dc3545;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Alpha</h6>
                                <h2 class="mb-0 text-danger"><?= $stat_data['alpha'] ?></h2>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded">
                                <i class="bi bi-x-circle-fill text-danger fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Riwayat Presensi Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($presensi_terbaru) > 0):
                                        $no = 1;
                                        $hari = array('Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 
                                                     'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 
                                                     'Saturday' => 'Sabtu');
                                        while ($presensi = mysqli_fetch_assoc($presensi_terbaru)): 
                                            $status_class = '';
                                            $status_icon = '';
                                            switch($presensi['status']) {
                                                case 'Hadir': $status_class = 'success'; $status_icon = 'check-circle-fill'; break;
                                                case 'Sakit': $status_class = 'warning'; $status_icon = 'thermometer-half'; break;
                                                case 'Izin': $status_class = 'info'; $status_icon = 'envelope-paper'; break;
                                                case 'Alpha': $status_class = 'danger'; $status_icon = 'x-circle-fill'; break;
                                            }
                                            $nama_hari = $hari[date('l', strtotime($presensi['tanggal']))];
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= date('d/m/Y', strtotime($presensi['tanggal'])) ?></td>
                                        <td><?= $nama_hari ?></td>
                                        <td><?= $presensi['Nama_MaPel'] ?></td>
                                        <td>
                                            <span class="badge bg-<?= $status_class ?>">
                                                <i class="bi bi-<?= $status_icon ?>"></i> <?= $presensi['status'] ?>
                                            </span>
                                        </td>
                                        <td><?= $presensi['keterangan'] ?: '-' ?></td>
                                    </tr>
                                    <?php endwhile; else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Belum ada data presensi
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="presensi_saya.php" class="btn btn-info text-white">
                                <i class="bi bi-file-earmark-text"></i> Lihat Semua Presensi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>