<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('user');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Land Allotment Details';
require_once 'header.php';

//$row_id=$_GET["id"];
$row_id=2332;
$stmt=$pdo->prepare('select * from land_allotment where id=?');
$stmt->execute([$row_id]);
$row = $stmt->fetch();
if (!$row) {
    //header('Location: land_allot.php');
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
                        <h5 class="card-title text-primary text-center">Land Allotment Details</h5>

<!-- Basic Parcel Details -->
<fieldset>
    <legend>Basic Information</legend>
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
            <label>District</label> : <?php echo $row["district"];?>
        </div>
        <div class="col-sm-4">
            <label>Plot Location</label> : <?php echo $row["plot_location"];?>
        </div>
        <div class="col-sm-4">
            <label>Fathers' Name</label> : <?php echo $row["father_name"];?>
        </div>
    </div>
    <legend>Allotment Details</legend>
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
            <label for="">Dag No</label> : <?php echo $row["dag_no"];?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label for="">Sheet No</label> : <?php echo $row["sheet_no"];?>
        </div>
        <div class="col-sm-4">
            <label for="">Paid Upto</label> : <?php echo $row["paid_upto"];?>
        </div>
        <div class="col-sm-4">
            <label for="">Lease Period</label> : <?php echo $row["lease_period"];?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="">Lattitude</label> : <?php echo $row["lattitude"];?>
        </div>
        <div class="col-sm-6">
            <label for="">Longitude</label> : <?php echo $row["longitude"];?>
        </div>
    </div>
    <legend>Land Details</legend>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Area</label> : <?php echo $row["area"];?>
        </div>
        <div class="col-sm-4">
            <label for="">Land Under Possession</label> : <?php echo $row["land_possession"];?>
        </div>
        <div class="col-sm-4">
            <label for="">Date/Year of Occupancy</label> : <?php echo $row["date_occupancy"];?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="">Details of Crop Structure</label> : <?php echo $row["crop_structure"];?>
        </div>
        <div class="col-sm-6">
            <label for="">Land Revenue Assessed</label> : <?php echo $row["revenue_assessed"];?>
        </div>
    </div>
    <legend>Uploaded Documents</legend>
     <div class='row'>
            <div class='col-md-2'>Sl. No.</div>
            <div class='col-md-5'>Document Name</div>
            <div class='col-md-5'>Document Link</div>
        </div>
        <?php
        $stmt2 = $pdo->prepare("select * from documents_uploaded where land_parcel_id = ? and module_name='land_allot'");
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
</fieldset>
<br>
<center>
    <a href="/user/index.php" class="btn btn-primary">Back</a>
</center>

                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

<?php require_once 'bottom.php'; ?>