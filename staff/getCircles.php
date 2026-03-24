<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';

$dist_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM circles WHERE district_id = ? ");
$stmt->execute([$dist_id]);
echo '<option value="Select Circle" selected>Select Circle</option>';
while ($row = $stmt->fetch()) {
    echo '<option value="' . $row['circle_name'] . '">' . $row['circle_name'] . '</option>';
}
exit();
?>