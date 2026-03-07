<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('admin');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Land Allotment';
require_once 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate($_POST['csrf_token']);
    
    $unique_id = $_POST['unique_id'];
    $passbook_no = $_POST['passbook_no'];
    $allotment_no = $_POST['allotment_no'];
    $allotment_date = $_POST['allotment_date'];
    $allotee_name = $_POST['allotee_name'];
    $mobile_no = $_POST['mobile_no'];
    $land_type = $_POST['land_type'];
    $total_area = $_POST['total_area'];
    $plot_location = $_POST['plot_location'];
    $dag_no = $_POST['dag_no'];
    $sheet_no = $_POST['sheet_no'];
    $paid_upto = $_POST['paid_upto'];
    $lease_period = $_POST['lease_period'];

    $errors = [];
    if (empty($unique_id)) {
        $errors[] = "Unique ID is required";
    }
    if (empty($passbook_no)) {
        $errors[] = "Passbook No is required";
    }
    if (empty($allotment_no)) {
        $errors[] = "Allotment No is required";
    }
    if (empty($allotment_date)) {
        $errors[] = "Allotment Date is required";
    }
    if (empty($allotee_name)) {
        $errors[] = "Allotee Name is required";
    }
    if (empty($mobile_no)) {
        $errors[] = "Mobile No is required";
    }
    if (empty($land_type)) {
        $errors[] = "Land Type is required";
    }
    if (empty($total_area)) {
        $errors[] = "Total Area is required";
    }
    if (empty($plot_location)) {
        $errors[] = "Plot Location is required";
    }
    if (empty($dag_no)) {
        $errors[] = "Dag No is required";
    }
    if (empty($sheet_no)) {
        $errors[] = "Sheet No is required";
    }
    if (empty($paid_upto)) {
        $errors[] = "Paid Upto is required";
    }
    if (empty($lease_period)) {
        $errors[] = "Lease Period is required";
    }
    
    if (empty($errors)) {
        $stmt= $pdo->prepare('update land_allotment set passbook_no=?,allotment_no=?,allotment_date=?,allotee_name=?,mobile_no=?,land_type=?,total_area=?,plot_location=?,dag_no=?,sheet_no=?,paid_upto=?,lease_period=? where unique_id=?;');
        $stmt->execute([
            $passbook_no,
            $allotment_no,
            $allotment_date,
            $allotee_name,
            $mobile_no,
            $land_type,
            $total_area,
            $plot_location,
            $dag_no,
            $sheet_no,
            $paid_upto,
            $lease_period,
            $unique_id,
        ]);

        echo "<div class='alert alert-success'>Land Allotment Data Updated Successfully!</div>";
        exit();     
    }else{
        echo "<div class='alert alert-danger'>".implode("<br>", $errors)."</div>";
    }

}

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
                        
                        <form method="POST" >
                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<!-- Basic Parcel Details -->
<fieldset>

    <div class="row">
        <div class="col-sm-4">
            <label>Unique ID</label>
            <input type="text" class="form-control" name="unique_id" value="<?php echo $row['unique_id']; ?>" readonly/>
        </div>
        <div class="col-sm-4">
            <label>Passbook No</label>
            <input type="text" class="form-control" name="passbook_no" value="<?php echo $row['passbook_no']; ?>" />
        </div>
        <div class="col-sm-4">
            <label>Allotment No</label>
            <input type="text" class="form-control" name="allotment_no" value="<?php echo $row['allotment_no']; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Allotment Date</label>
            <input type="date" class="form-control" name="allotment_date" value="<?php echo $row['allotment_date']; ?>">
        </div>
        <div class="col-sm-4">
            <label>Allotee Name</label>
            <input type="text" class="form-control" name="allotee_name" value="<?php echo $row['allotee_name']; ?>">
        </div>
        <div class="col-sm-4">
            <label>Mobile No</label>
            <input type="text" class="form-control" name="mobile_no" value="<?php echo $row['mobile_no']; ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Land Type</label>
            <select name="land_type" id="land_type" class='form-control'>
                <option value="C" <?php $row["land_type"]=="C"? 'selected':''?>>Commercial</option>
                <option value="R" <?php $row["land_type"]=="R"? 'selected':''?>>Residencial</option>
                <option value="M" <?php $row["land_type"]=="M"? 'selected':''?>>Residencial cum Commercial</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Total Area</label>
            <input type="text" class="form-control" name="total_area" value="<?php echo $row['total_area']; ?>">
        </div>
        <div class="col-sm-4">
            <label>Plot Location</label>
            <input type="text" class="form-control" name="plot_location" value="<?php echo $row['plot_location']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Dag No</label>
            <input type="text" class="form-control" name="dag_no" value="<?php echo $row['dag_no']; ?>">
        </div>
        <div class="col-sm-4">
            <label for="">Sheet No</label>
            <input type="text" class="form-control" name="sheet_no" value="<?php echo $row['sheet_no']; ?>">
        </div>
        <div class="col-sm-4">
            <label for="">Paid Upto</label>
            <input type="text" class="form-control" name="paid_upto" value="<?php echo $row['paid_upto']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Lease Period</label>
            <input type="text" class="form-control" name="lease_period" value="<?php echo $row['lease_period']; ?>">
        </div>
    </div>
</fieldset>
<br>
<center>
    <a href="/admin/land_record_details.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Back </a>
    <button type="submit"  class="btn btn-primary">Update</button>
</center>
</form>

                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

<?php require_once 'bottom.php'; ?>