<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('admin');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='View Land parcel Details';
require_once 'header.php';

if(!isset($_GET['id'])) {
    header('Location: search_chitha_details.php');
    exit();
}
$row_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM chitha_register WHERE id = ? ");
$stmt->execute([$row_id]);
$row = $stmt->fetch();
if (!$row) {
    header('Location: search_chitha_details.php');
    exit();
}

?>
<style>
    label {
        font-weight: bold;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-top row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-center">Chitha Record Details</h5>
<fieldset>
    <legend>Registration Details</legend>

    <div class="row">
        <div class="col-sm-4">
            <label>Chitha No</label> : <?php echo $row['chitha_no']; ?>
        </div>
        <div class="col-sm-4">
            <label>District</label> :
                <?php
                $stmt1 = $pdo->prepare("SELECT * FROM districts where id = ?");
                $stmt1->execute([$row['district']]);
                while ($row1 = $stmt1->fetch()) {
                    echo $row1['district_name'];
                }
                ?>
        </div>
        <div class="col-sm-4">
            <label>Circle</label> : <?php echo $row['circle']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Village/Colony/ Sector</label> : <?php echo $row['village_ward']; ?>
        </div>
        <div class="col-sm-4">
            <label>Land Classification</label> : <?php echo $row['land_classification']; ?>
        </div>
        <div class="col-sm-4">
            <label>Nature of Land Use</label> : <?php echo $row['land_use']; ?>
        </div>
    </div>

</fieldset>
<br>
<!-- Owner Details -->
<fieldset>
    <legend>Ocupant Details</legend>
    <div class="row">
        <div class="col-sm-6">
             <label>Occupants Name</label> : <?php echo $row['land_holder']; ?>
        </div>
        <div class="col-sm-6">
            <label>Father/Husband Name</label> : <?php echo $row['father_husband']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label>Location Description/ Boundaries</label> : <?php echo $row['location_description']; ?>
        </div>
    </div>

</fieldset>
<br>
<!-- Land Details -->
<fieldset>
    <legend>Land Details</legend>
    <div class="row">
        <div class="col-sm-3">
            <label>Area (Sqm/Ha)</label> : <?php echo $row['area']; ?>
        </div>
        <div class="col-sm 3">
            <label>Land under Possession</label> : <?php echo $row['area_possessed']; ?>
        </div>
        <div class="col-sm 3">
            <label>Date/Year of Occupancy</label> : <?php echo $row['occupy_date']; ?>
        </div>
        <div class="col-sm 3">
            <label>Details of Structure/Crops</label> : <?php echo $row['crop_details']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label>Land Revenue Assessed (₹)</label> : <?php echo $row['land_revenue']; ?>
        </div>
        <div class="col-sm-3">
            <label>Land Revenue Paid (Year-wise)</label> : <?php echo $row['land_revenue_paid']; ?>
        </div>
        <div class="col-sm-3">
            <label>Receipt / Challan No. & Date</label> : <?php echo $row['receipt_details']; ?>
        </div>
    </div>
</fieldset>
<br>

<!-- Admin -->
<fieldset>
    <label>Remarks</label> : <br>
    <?php echo $row['remarks']; ?>
</fieldset>
<br>
<center>
    <a href="search_chitha_details.php" class="btn btn-danger">Back</a>
</center>

                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>



                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

<?php require_once 'bottom.php'; ?>