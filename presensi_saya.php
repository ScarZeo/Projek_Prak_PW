<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Siswa') {
    header("Location: login.php");
    exit();
}

$nis = $_SESSION['username'];

$siswa_query = mysqli_query($conn, "SELECT s.*, k.Nama_Kelas, k.ID_Kelas 
                                     FROM siswa s
                                     JOIN kelas_siswa ks ON s.NIS = ks.nis
                                     JOIN kelas k ON ks.id_kelas = k.ID_Kelas
                                     WHERE s.NIS = '$nis'");
$siswa_data = mysqli_fetch_assoc($siswa_query);

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m');
$mapel = isset($_GET['mapel']) ? $_GET['mapel'] : '';

$where = "WHERE p.nis = '$nis' AND DATE_FORMAT(p.tanggal, '%Y-%m') = '$bulan'";
if ($mapel) {
    $where .= " AND p.id_mapel = $mapel";
}

$presensi_query = mysqli_query($conn, "SELECT p.*, mp.Nama_MaPel, k.Nama_Kelas
                                       FROM presensi p
                                       JOIN mata_pelajaran mp ON p.id_mapel = mp.ID_MaPel
                                       JOIN kelas k ON p.id_kelas = k.ID_Kelas
                                       $where
                                       ORDER BY p.tanggal DESC, mp.Nama_MaPel");

$mapel_list = mysqli_query($conn, "SELECT DISTINCT mp.ID_MaPel, mp.Nama_MaPel
                                   FROM mata_pelajaran mp
                                   JOIN kelas_mapel km ON mp.ID_MaPel = km.id_mapel
                                   WHERE km.id_kelas = {$siswa_data['ID_Kelas']}
                                   ORDER BY mp.Nama_MaPel");

$stats = mysqli_query($conn, "SELECT 
                              COUNT(*) as total,
                              SUM(CASE WHEN status = 'Hadir' THEN 1 ELSE 0 END) as hadir,
                              SUM(CASE WHEN status = 'Sakit' THEN 1 ELSE 0 END) as sakit,
                              SUM(CASE WHEN status = 'Izin' THEN 1 ELSE 0 END) as izin,
                              SUM(CASE WHEN status = 'Alpha' THEN 1 ELSE 0 END) as alpha
                              FROM presensi 
                              WHERE nis = '$nis' 
                              AND DATE_FORMAT(tanggal, '%Y-%m') = '$bulan'");
$stat_data = mysqli_fetch_assoc($stats);

$persentase = 0;
if ($stat_data['total'] > 0) {
    $persentase = round(($stat_data['hadir'] / $stat_data['total']) * 100, 1);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Saya - Sistem Presensi SD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .progress-custom {
            height: 30px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <h2 class="mb-4"><i class="bi bi-clipboard-check"></i> Presensi Saya</h2>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Filter Presensi</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">Bulan</label>
                            <input type="month" class="form-control" name="bulan" value="<?= $bulan ?>" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="form-select" name="mapel">
                                <option value="">-- Semua Mata Pelajaran --</option>
                                <?php while ($mp = mysqli_fetch_assoc($mapel_list)): ?>
                                    <option value="<?= $mp['ID_MaPel'] ?>" <?= ($mapel == $mp['ID_MaPel']) ? 'selected' : '' ?>>
                                        <?= $mp['Nama_MaPel'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-info w-100 text-white">
                                <i class="bi bi-search"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-graph-up"></i> Statistik Presensi - 
                            <?php 
                            $bulan_nama = array(
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                                '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            );
                            list($tahun, $bln) = explode('-', $bulan);
                            echo $bulan_nama[$bln] . ' ' . $tahun;
                            ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h6>Persentase Kehadiran</h6>
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: <?= $persentase ?>%">
                                        <?= $persentase ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="border rounded p-3 bg-success bg-opacity-10">
                                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                    <h3 class="mt-2 mb-0"><?= $stat_data['hadir'] ?></h3>
                                    <p class="text-muted mb-0">Hadir</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border rounded p-3 bg-warning bg-opacity-10">
                                    <i class="bi bi-thermometer-half text-warning fs-1"></i>
                                    <h3 class="mt-2 mb-0"><?= $stat_data['sakit'] ?></h3>
                                    <p class="text-muted mb-0">Sakit</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border rounded p-3 bg-info bg-opacity-10">
                                    <i class="bi bi-envelope-paper text-info fs-1"></i>
                                    <h3 class="mt-2 mb-0"><?= $stat_data['izin'] ?></h3>
                                    <p class="text-muted mb-0">Izin</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border rounded p-3 bg-danger bg-opacity-10">
                                    <i class="bi bi-x-circle-fill text-danger fs-1"></i>
                                    <h3 class="mt-2 mb-0"><?= $stat_data['alpha'] ?></h3>
                                    <p class="text-muted mb-0">Alpha</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-table"></i> Detail Presensi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">Tanggal</th>
                                <th width="10%">Hari</th>
                                <th width="25%">Mata Pelajaran</th>
                                <th width="13%">Status</th>
                                <th width="35%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($presensi_query) > 0):
                                $no = 1;
                                while ($presensi = mysqli_fetch_assoc($presensi_query)): 
                                    $status_class = '';
                                    $status_icon = '';
                                    switch($presensi['status']) {
                                        case 'Hadir': $status_class = 'success'; $status_icon = 'check-circle-fill'; break;
                                        case 'Sakit': $status_class = 'warning'; $status_icon = 'thermometer-half'; break;
                                        case 'Izin': $status_class = 'info'; $status_icon = 'envelope-paper'; break;
                                        case 'Alpha': $status_class = 'danger'; $status_icon = 'x-circle-fill'; break;
                                    }
                                    
                                    $hari = array(
                                        'Sunday' => 'Minggu', 'Monday' => 'Senin', 
                                        'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
                                        'Thursday' => 'Kamis', 'Friday' => 'Jumat', 
                                        'Saturday' => 'Sabtu'
                                    );
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
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-0">Tidak ada data presensi untuk periode yang dipilih</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if (mysqli_num_rows($presensi_query) > 0): ?>
                <div class="text-center mt-3">
                    <button onclick="window.print()" class="btn btn-secondary">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>