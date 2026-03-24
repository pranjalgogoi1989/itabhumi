<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='All Land Allotment Records';
require_once 'header.php';
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-center"><?=$title?></h5>
                        
                        
                        <table class='table table-responsive table-hover' id="dataTable">
                            <thead>
                                <tr>
                                    <th>Unique ID</th>
                                    <th>Allotment No</th>
                                    <th>Allotee Name</th>
                                    <th>Mobile No</th>
                                    <th>Land Type</th>
                                    <th>Dag No</th>
                                    <th>Sheet No</th>
                                    <th>Paid upto</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $stmt = $pdo->prepare("SELECT * FROM land_allotment ");
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);                        
                                        foreach ($result as $row) {
                                            echo '<tr>';
                                            echo '<td>' . $row['unique_id'] . '</td>';
                                            echo '<td>' . $row['allotment_no'] . '</td>';
                                            echo '<td>' . $row['allotee_name'] . '</td>';
                                            echo '<td>' . $row['mobile_no'] . '</td>';
                                            echo '<td>' . $row['land_type'] . '</td>';
                                            echo '<td>' . $row['dag_no'] . '</td>';
                                            echo '<td>' . $row['sheet_no'] . '</td>';
                                            echo '<td>' . $row['paid_upto'] . '</td>';
                                            echo '<td width="20%">';
                                            echo '<a href="land_record_details.php?id=' . $row['id'] . '" class="btn btn-primary">View</a> ';
                                            echo '<a href="edit_land_record.php?id=' . $row['id'] . '" class="btn btn-info">Edit</a> ';
                                            
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
</div>
<script>
    $(document).ready(function() {
        new DataTable('#dataTable');
    });
</script>

<?php require_once 'bottom.php'; ?>