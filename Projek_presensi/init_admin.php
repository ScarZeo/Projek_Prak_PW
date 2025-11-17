<?php
require_once 'db.php';

$username = 'admin01';
$password_plain = 'admin123';
$nama_admin = 'Administrator';

$role = $mysqli->query("SELECT id_role FROM roles WHERE nama_role='admin'")->fetch_assoc();
$role_id = $role['id_role'];

$hash = password_hash($password_plain, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO akun(username,password,role_id) VALUES(?,?,?)");
$stmt->bind_param("ssi", $username, $hash, $role_id);
$stmt->execute();
$id_akun = $stmt->insert_id;
$stmt->close();

$stmt2 = $mysqli->prepare("INSERT INTO admin(nama_admin,akun_id) VALUES(?,?)");
$stmt2->bind_param("si", $nama_admin, $id_akun);
$stmt2->execute();
$stmt2->close();

echo "Admin berhasil dibuat. Username: $username";
