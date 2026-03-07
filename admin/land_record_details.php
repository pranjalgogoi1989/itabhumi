<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('admin');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Land Allotment Details';
require_once 'header.php';

$row_id=$_GET["id"];
$stmt=$pdo->prepare('select * from land_allotment where id=?');
$stmt->execute([$row_id]);
$row = $stmt->fetch();
if (!$row) {
    header('Location: land_allot.php');
    //exit();
}
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-top row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-center">Land Allotment</h5>

<!-- Basic Parcel Details -->
<fieldset>

    <div class="row">
        <div class="col-sm-4">
            <label>Unique ID</label> : <?php echo $row['unique_id']; ?>
            
        </div>
        <div class="col-sm-4">
            <label>Passbook No</label> : <?php echo $row['passbook_no']; ?>
        </div>
        <div class="col-sm-4">
            <label>Allotment No</label> : <?php echo $row["allotment_no"];?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Allotment Date</label> : <?php echo $row["allotment_date"];?>
        </div>
        <div class="col-sm-4">
            <label>Allotee Name</label> : <?php echo $row["allotee_name"];?>
        </div>
        <div class="col-sm-4">
            <label>Mobile No</label> : <?php echo $row["mobile_no"];?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Land Type</label> : <?php echo $row["land_type"];?>
            <?php
            if($row["land_type"]=='C'){
                echo '(Commercial)';
            }
            if($row["land_type"]=='R'){
                echo '(Residencial)';
            }
            if($row["land_type"]=='M'){
                echo '(Residencial cum Commercial)';
            }
            ?>
        </div>
        <div class="col-sm-4">
            <label>Total Area</label> : <?php echo $row["total_area"];?>
            
        </div>
        <div class="col-sm-4">
            <label>Plot Location</label> : <?php echo $row["plot_location"];?>
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Dag No</label> : <?php echo $row["dag_no"];?>
        </div>
        <div class="col-sm-4">
            <label for="">Sheet No</label> : <?php echo $row["sheet_no"];?>
        </div>
        <div class="col-sm-4">
            <label for="">Paid Upto</label> : <?php echo $row["paid_upto"];?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Lease Period</label> : <?php echo $row["lease_period"];?>
        </div>
    </div>
</fieldset>
<br>
<center>
    <a href="/admin/edit_land_record.php?id=<?php echo $row_id; ?>" class="btn btn-info">Edit</a>
    <a href="/admin/search_land_allot.php" class="btn btn-primary">Back</a>
</center>

                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

<?php require_once 'bottom.php'; ?>