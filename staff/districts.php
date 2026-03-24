<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Districts';
require_once 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate($_POST['csrf_token']);
    $district_name = trim($_POST['district_name']);
    // Validation
    if (strlen($district_name) < 3) {
      $errors[] = "District Name must be at least 3 characters.";
    }
    // Check duplicates
    $stmt = $pdo->prepare("SELECT id FROM districts WHERE district_name = ? ");
    $stmt->execute([$district_name]);
    if ($stmt->fetch()) {
        $errors[] = "District already exists.";
    }
    // If no errors → insert
    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "INSERT INTO districts (district_name) VALUES (?)"
        );
        $stmt->execute([$district_name]);
        echo "<div class='alert alert-success'>District Added Successfully</div>";
        exit();
    }
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-top row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Districts</h5>
                        <table id="example" class="table table-hover table-display" style="width:100%">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>District Name</td>
                                    <td>Created At</td>
                                    <td>Updated At</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->prepare("SELECT * FROM districts order by district_name asc");
                                $stmt->execute();
                                $districts = $stmt->fetchAll();
                                foreach ($districts as $dist) {
                                    echo '<tr>';
                                    echo '<td>' . $dist['id'] . '</td>';
                                    echo '<td>' . $dist['district_name'] . '</td>';
                                    echo '<td>' . $dist['created_at'] . '</td>';
                                    echo '<td>' . $dist['updated_at'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <h5>Enter New District</h5>

                        <form action="" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>"/>
                            <div class="mb-3">
                                <label for="district_name" class="form-label">District Name</label>
                                <input type="text" class="form-control" id="district_name" name="district_name" placeholder="Enter District Name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            layout: {
                bottomEnd: {
                    paging: {
                        firstLast: false
                    }
                }
            }
        });
    });
</script>

<?php require_once 'bottom.php'; ?>