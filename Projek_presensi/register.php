<?php
require_once 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama     = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role']; // siswa atau guru

    if (!$nama || !$username || !$password || !in_array($role, ['siswa','guru'])) {
        $message = "Lengkapi semua form.";
    } else {

        // cek username unik
        $cek = $mysqli->prepare("SELECT id_akun FROM akun WHERE username=?");
        $cek->bind_param("s", $username);
        $cek->execute();
        $exists = $cek->get_result()->fetch_assoc();
        $cek->close();

        if ($exists) {
            $message = "Username sudah digunakan!";
        } else {

            // Ambil role ID
            $q = $mysqli->prepare("SELECT id_role FROM roles WHERE nama_role=?");
            $q->bind_param("s", $role);
            $q->execute();
            $role_row = $q->get_result()->fetch_assoc();
            $q->close();

            $role_id = $role_row['id_role'];
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan ke tabel akun
            $stmt = $mysqli->prepare("INSERT INTO akun (username,password,role_id) VALUES (?,?,?)");
            $stmt->bind_param("ssi", $username,$hash,$role_id);
            $stmt->execute();
            $akun_id = $stmt->insert_id;
            $stmt->close();

            // Jika guru
            if ($role === 'guru') {

                $g = $mysqli->prepare("INSERT INTO guru (nama_guru, akun_id) VALUES (?, ?)");
                $g->bind_param("si", $nama, $akun_id);
                $g->execute();
                $g->close();

                $message = "Pendaftaran guru berhasil!";

            } else {

                // Jika siswa (NIS dibuat otomatis)
                do {
                    $nis = rand(100000,999999);
                    $r = $mysqli->query("SELECT nis FROM siswa WHERE nis=$nis")->fetch_assoc();
                } while ($r);

                $s = $mysqli->prepare("INSERT INTO siswa (nis, nama_siswa, akun_id) VALUES (?, ?, ?)");
                $s->bind_param("isi", $nis, $nama, $akun_id);
                $s->execute();
                $s->close();

                $message = "Pendaftaran siswa berhasil! (NIS otomatis: $nis)";
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registrasi</title>
<style>
body{font-family:Arial;background:#f4f8ff;margin:0;padding:20px}
.card{max-width:560px;margin:30px auto;background:#fff;padding:20px;border-radius:8px;border:1px solid #e6eef9}
input,select,button{width:100%;padding:8px;margin:6px 0;border:1px solid #cfe3ff;border-radius:4px}
button{background:#1976d2;color:#fff;border:none;padding:10px;cursor:pointer}
.note{color:green}
.err{color:red}
</style>
</head>
<body>

<div class="card">
  <h2>Registrasi Akun</h2>

  <?php if ($message): ?>
  <p class="<?=strpos($message,'berhasil')!==false?'note':'err'?>">
    <?= htmlspecialchars($message) ?>
  </p>
  <?php endif; ?>

  <form method="post">
    <label>Nama</label>
    <input name="nama" required>

    <label>Username</label>
    <input name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role">
      <option value="siswa">Siswa</option>
      <option value="guru">Guru</option>
    </select>

    <button type="submit">Daftar</button>
  </form>

  <p><a href="login.php">Kembali ke login</a></p>
</div>

</body>
</html>
