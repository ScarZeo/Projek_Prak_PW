<?php
require_once 'db.php';
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Ambil akun berdasarkan username
    $stmt = $mysqli->prepare("
        SELECT a.id_akun, a.username, a.password, r.nama_role
        FROM akun a
        JOIN roles r ON a.role_id = r.id_role
        WHERE a.username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $akun = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($akun && password_verify($password, $akun['password'])) {

        $_SESSION['user'] = [
            'id_akun' => $akun['id_akun'],
            'username'=> $akun['username'],
            'role'    => $akun['nama_role']
        ];

        header("Location: dashboard.php");
        exit;

    } else {
        $message = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<style>
body { background:#eef4ff; font-family:Arial; margin:0; padding:0; }
.card {
    width:350px; margin:80px auto; background:white;
    padding:20px; border-radius:8px; border:1px solid #d0d9ff;
}
input, button {
    width:100%; padding:10px; margin:7px 0;
    border:1px solid #b7c7ff; border-radius:5px;
}
button { background:#1976d2; color:white; cursor:pointer; }
button:hover { background:#0d47a1; }
.err { color:red; }
</style>
</head>

<body>
<div class="card">
    <h2>Login</h2>

    <?php if ($message): ?>
        <p class="err"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
