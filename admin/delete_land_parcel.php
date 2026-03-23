<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('admin');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';

$id= $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM land_parcel WHERE id = ? ");
$stmt->execute([$id]);
header('Location: land_allot_all.php');
exit();
?>
