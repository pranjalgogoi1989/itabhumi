<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='View Land parcel Details';
require_once 'header.php';

if(!isset($_GET['id'])) {
    header('Location: land_parcel.php');
    exit();
}
$row_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM land_parcel WHERE id = ? ");
$stmt->execute([$row_id]);
$row = $stmt->fetch();
if (!$row) {
    header('Location: land_parcel.php');
    //exit();
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
                        <h5 class="card-title text-primary text-center">Land Parcel Details</h5>

<fieldset>
    <legend>Parcel Details</legend>

    <div class="row">
        <div class="col-sm-4">
            <label>Parcel ID</label> : <?php echo $row['parcel_id']; ?>
        </div>
        <div class="col-sm-4">
            <label>District</label> : 
            <?php
            $stmt = $pdo->prepare("SELECT * FROM districts where id = ?");
            $stmt->execute([$row['district']]);
            while ($row1 = $stmt->fetch()) {
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
            <label>Village/Ward</label> : <?php echo $row['village_ward']; ?>
            
        </div>
        <div class="col-sm-4">
            <label>Allotment No</label> : <?php echo $row['allotment_no']; ?>
        </div>
        <div class="col-sm-4">
            <label>Dag/Survey No</label> : <?php echo $row['dag_no']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Map Sheet No</label> : <?php echo $row['map_sheet_no']; ?>
        </div>
        <div class="col-sm-4">
            <label>GIS Polygon/KML Ref</label> : <?php echo $row['gis_polygon']; ?>
        </div>
    </div>
</fieldset>
<br>
<!-- Owner Details -->
<fieldset>
    <legend>Owner Details</legend>
    <div class="row">
        <div class="col-sm-6">
            <label>Pattadar/Allottee Name</label> : <?php echo $row['pattadar_name']; ?>
        </div>
        <div class="col-sm-6">
            <label>Father/Husband Name</label> : <?php echo $row['father_husband']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>Permanent Address</label> :<br> <?php echo $row['permanent_address']; ?>
        </div>
        <div class="col-sm-6">
            <label>Current Address</label> : <br><?php echo $row['current_address']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label>Tribe/Community</label> : <?php echo $row['tribe_community']; ?>
        </div>
        <div class="col-sm-4">
            <label>Ownership Type</label> : <?php echo $row['ownership_type']; ?>
            <?php
            if($row['ownership_type'] == 'G') {
                echo '(Govt. Allottee)';
            }
            if($row['ownership_type'] == 'L') {
                echo '(LPC)';
            }
            if($row['ownership_type'] == 'E') {
                echo '(Encroacher)';
            }
            if($row['ownership_type'] == 'I') {
                echo '(Inherited)';
            }
            if($row['ownership_type'] == 'O') {
                echo '(Other)';
            }
            ?>
        </div>
        <div class="col-sm-4">
            <label>Tenure Type</label> : <?php echo $row['tenure_type']; ?>
            <?php
                if($row['tenure_type'] == 'P') {
                    echo '(Private)';
                }
                if($row['tenure_type'] == 'A') {
                    echo '(Allotment)';
                }
                if($row['tenure_type'] == 'L') {
                    echo '(LPC)';
                }
                if($row['tenure_type'] == 'S') {
                    echo '(State Govt.)';
                }
                if($row['tenure_type'] == 'C') {
                    echo '(Central Govt.)';
                }
            ?>
        </div>
    </div>    
</fieldset>
<br>
<fieldset>
    <legend>Pattadar Family Details</legend>
    <span class="pull-right">
    <div class="row">
        <div class="col-sm-2">
            <label>Sl No</label>
        </div>
        <div class="col-sm-4">
            <label>Name</label>
        </div>
        <div class="col-sm-2">
            <label>Relation</label>
        </div>
        <div class="col-sm-2">
            <label>Age</label>
        </div>
    </div>
    <?php
    $stmt1 = $pdo->prepare("select * from land_parcel_family where land_parcel_id = ?");
    $stmt1->execute([$row['id']]);
    $count = 0;
    while($row1 = $stmt1->fetch()) {
        $count++;
        echo '<div class="row">';
        echo '<div class="col-sm-2">'.$count.'</div>';
        echo '<div class="col-sm-4">'.$row1['person_name'].'</div>';
        echo '<div class="col-sm-2">'.$row1['relationship'].'</div>';
        echo '<div class="col-sm-2">'.$row1['age'].'</div>';
        echo '</div>';
    }
    ?>
</fieldset>
<br><br>
<!-- Land Details -->
<fieldset>
    <legend>Land & Boundary Details</legend>
    <div class="row">
        <div class="col-sm-6">
            <label>Area (Sqm/Ha)</label> : <?php echo $row['area']; ?>
        </div>
        <div class="col-sm 6">
            <label>Land Use</label> : <?php echo $row['land_use']; ?>
            <?php
                if($row['land_use'] == 'R') {
                    echo '(Residential)';
                }
                if($row['land_use'] == 'C') {
                    echo '(Commercial)';
                }
                if($row['land_use'] == 'RC') {
                    echo '(Residential Cum Commercial)';
                }
                if($row['land_use'] == 'A') {
                    echo '(Agriculture)';
                }
                if($row['land_use'] == 'H') {
                    echo '(Horticulture)';
                }
                if($row['land_use'] == 'CM') {
                    echo '(Community)';
                }
                if($row['land_use'] == 'I') {
                    echo '(Institutional)';
                }
                if($row['land_use'] == 'S') {
                    echo '(Society)';
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label>North Boundary</label> : <?php echo $row['north_boundary']; ?></div>
        <div class="col-sm-3"><label>South Boundary</label> : <?php echo $row['south_boundary']; ?></div>
        <div class="col-sm-3"><label>East Boundary</label> : <?php echo $row['east_boundary']; ?></div>
        <div class="col-sm-3"><label>West Boundary</label> : <?php echo $row['west_boundary']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>Latitude of Each Node</label> : <br>
            <?php echo $row['latitude']; ?>
        </div>
        <div class="col-sm-6">
            <label>Longitude of Each Node</label> :<br>
            <?php echo $row['longitude']; ?>
        </div>
    </div>
</fieldset>
<br>
<!-- Revenue & Mutation -->
<fieldset>
    <legend>Mutation & Revenue Details</legend>
    <div class="row">
        <div class="col-sm-4">
            <label>Mutation Order No</label> : <?php echo $row['mutation_order']; ?>
        </div>
        <div class="col-sm-4">
            <label>Mutation Date</label> : <?php echo $row['mutation_date']; ?>
        </div>
        <div class="col-sm-4">
            <label>Revenue Demand (₹)</label> : <?php echo $row['revenue_demand']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label>Revenue Paid (₹)</label> : <?php echo $row['revenue_paid']; ?>
        </div>
        <div class="col-sm-4">
            <label>Receipt No</label> : <?php echo $row['receipt_no']; ?>
        </div>
        <div class="col-sm-4">
            <label>Last Payment Date</label> : <?php echo $row['last_payment_date']; ?>
        </div>
    </div>
</fieldset>
<br>
<!-- Legal & Status -->
<fieldset>
    <legend>Legal & Status</legend>
    <div class="row">
        <div class="col-sm-4">
            <label>Encumbrance/Court Case</label> : <?php echo $row['encumbrance_no']; ?>
        </div>
        <div class="col-sm-4">
            <label>Acquisition Status (LARR)</label> : <?php echo $row['acquisition_status']; ?>
        </div>
        <div class="col-sm-4">
            <label>Encroachment Status</label> : <?php echo $row['encroachment_status']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label>Inspection Date</label> : <?php echo $row['inspection_date']; ?>
        </div>
        <div class="col-sm-4">
            <label>Digitisation Status</label> : <?php echo $row['digitisation_status']; ?>
        </div>
    </div>
    
    <div class="row">
        <legend>Documents Available</legend>
        <div class='row'>
            <div class='col-md-2'>Sl. No.</div>
            <div class='col-md-5'>Document Name</div>
            <div class='col-md-5'>Document Link</div>
        </div>
        <?php
        $stmt2 = $pdo->prepare("select * from documents_uploaded where land_parcel_id = ?");
        $stmt2->execute([$row_id]);
        $count = 0;
        while($row2 = $stmt2->fetch()) {
            $count++;
            echo '<div class="row">';
            echo '<div class="col-md-2">'.$count.'</div>';
            echo '<div class="col-md-5">'.$row2['document_details'].'</div>';
            echo '<div class="col-md-5"><a href="/uploads/document/'.$row2['document_file'].'" target="_blank" class="btn btn-primary">View</a></div>';
            echo '</div>';
        }
        ?>
    </div>    
</fieldset>
<br>
<!-- Admin -->
<fieldset>
    <label>Remarks</label>:<br>
    <?php echo $row['remarks']; ?>
</fieldset>
<br>
<center>
    <a href="edit_land_parcel.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a> &nbsp;
    <a href="land_parcel_all.php" class="btn btn-danger">Back</a>
</center>


                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

<?php require_once 'bottom.php'; ?>