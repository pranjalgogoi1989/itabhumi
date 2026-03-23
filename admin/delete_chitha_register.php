<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('admin');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';

$id= $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM chitha_register WHERE id = ? ");
$stmt->execute([$id]);
header('Location: chitha_register_all.php');
exit();
?>
