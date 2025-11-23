<?php
$navbar_color = 'primary';
$navbar_title = 'Dashboard';

if ($_SESSION['role'] == 'Admin') {
    $navbar_color = 'primary';
} elseif ($_SESSION['role'] == 'Guru') {
    $navbar_color = 'success';
} else {
    $navbar_color = 'info';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-<?= $navbar_color ?> shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <i class="bi bi-building"></i> Sistem Presensi SD
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                
                <?php if ($_SESSION['role'] == 'Admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="siswa.php">
                            <i class="bi bi-people"></i> Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="guru.php">
                            <i class="bi bi-person-badge"></i> Guru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelas.php">
                            <i class="bi bi-door-open"></i> Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mapel.php">
                            <i class="bi bi-book"></i> Mata Pelajaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan_presensi.php">
                            <i class="bi bi-clipboard-check"></i> Laporan Presensi
                        </a>
                    </li>
                <?php elseif ($_SESSION['role'] == 'Guru'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="input_presensi.php">
                            <i class="bi bi-clipboard-check"></i> Input Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekap_presensi.php">
                            <i class="bi bi-file-earmark-text"></i> Rekap Presensi
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="presensi_saya.php">
                            <i class="bi bi-clipboard-check"></i> Presensi Saya
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?= $_SESSION['username'] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>