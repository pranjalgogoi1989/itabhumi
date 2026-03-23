<?php
require_once 'middleware/auth.php';
requireLogin();

$myrole = $_SESSION['role'];

if($myrole == 'admin'){
  header("Location: /admin/");
  exit();
}
if($myrole == 'user'){
  header("Location: /user/");
  exit();
}

?>
