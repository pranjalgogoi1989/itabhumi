<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';

$file=$_POST['file'];
if(isset($_POST['file'])) {
    $file = $_SERVER['DOCUMENT_ROOT'] ."/uploads/document/". $file;
    if(file_exists($file)) {
        if(unlink($file)) {
            echo "File deleted successfully.".$file;
            $stmt = $pdo->prepare("delete from documents_uploaded where document_file=?");
            $stmt->execute([$_POST['file']]);
        } else {
            echo "Unable to delete file.";
        }
    } else {
        echo "File not found.";
    }

} else {
    echo "Invalid request.";
}
?>