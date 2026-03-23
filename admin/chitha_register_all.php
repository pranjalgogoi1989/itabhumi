<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('admin');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='All Chitha Register Records';
require_once 'header.php';
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center"><?=$title?></h5>
                    
                    <table class="table table-responsive table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">Chitha No</th>
                                <th scope="col">Land Holder Name</th>
                                <th scope="col">Father/Husband Name</th>
                                <th scope="col">Village/Sector</th>
                                <th scope="col">Land Use</th>
                                <th scope="col">Area</th>
                                <th scope="col">Occupancy Date/Year</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $pdo->prepare("SELECT * FROM chitha_register ");
                                $stmt->execute();

                                if ($stmt->rowCount() > 0) {
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);                        
                                    foreach ($result as $row) {
                                        echo '<tr>';
                                        echo '<td>' . $row['chitha_no'] . '</td>';
                                        echo '<td>' . $row['land_holder'] . '</td>';
                                        echo '<td>' . $row['father_husband'] . '</td>';
                                        echo '<td>' . $row['village_ward'] . '</td>';
                                        echo '<td>' . $row['land_use'] . '</td>';
                                        echo '<td>' . $row['area'] . '</td>';
                                        echo '<td>' . $row['occupy_date'] . '</td>';
                                        echo '<td>' . $row['updated_at'] . '</td>';
                                        echo '<td width="20%">';
                                        echo '<a href="chitha_record_details.php?id=' . $row['id'] . '" class="btn btn-primary">View</a>';
                                        echo '<a href="edit_chitha.php?id=' . $row['id'] . '" class="btn btn-info">Edit</a>';
                                        echo '<a href="delete_chitha_register.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No matching records found.</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        new DataTable('#dataTable');
    });
</script>

<?php require_once 'bottom.php'; ?>