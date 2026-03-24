<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Chitha Register';
require_once 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate($_POST['csrf_token']);
    
    $chitha_no=$_POST["chitha_no"];
    $district = $_POST["district"];
    $circle=$_POST["circle"];
    $land_holder=$_POST["occupant_name"];
    $father_husband=$_POST["father_husband_name"];
    $village_ward=$_POST["village_ward"];
    $location_description=$_POST["location_description"];
    $land_classification=$_POST["land_classification"];

    $land_use=$_POST["land_use"];
    $area=$_POST["area"];
    $area_possessed=$_POST["land_under_possession"];
    $occupy_date=$_POST["occupancy_date"];
    $crop_details=$_POST["crop_details"];
    $land_revenue=$_POST["land_revenue"];
    $land_revenue_paid=$_POST["land_revenue_paid"];
    $receipt_details=$_POST["receipt_no_date"];
    $remarks=$_POST["remarks"];
    
    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "INSERT INTO chitha_register(chitha_no,district,circle,land_holder,father_husband,village_ward,location_description,land_classification,land_use,area,area_possessed,occupy_date,crop_details,land_revenue,land_revenue_paid,receipt_details,remarks) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
        );
        $stmt->execute([$chitha_no,$district,$circle,$land_holder,$father_husband,$village_ward,$location_description,$land_classification,$land_use,$area,$area_possessed,$occupy_date,$crop_details,$land_revenue,$land_revenue_paid,$receipt_details,$remarks]);
        echo "<div class='alert alert-success'>Chitha Registered Successfully</div>";  
        exit();           
    }else{
        echo "<div class='alert alert-danger'>".implode("<br>", $errors)."</div>";
    }

}
?>
<script>
    function getCircle(district) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "getCircles.php?id=" + district, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("circle").innerHTML = this.responseText;
            }
        };
    }
</script>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-top row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-center">Chitha Register</h5>
                        
                        <form method="POST" >
                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<!-- Basic Parcel Details -->
<fieldset>
    <legend>Registration Details</legend>

    <div class="row">
        <div class="col-sm-4">
            <label>Chitha No</label>
            <input type="text" class="form-control" name="chitha_no">
        </div>
        <div class="col-sm-4">
            <label>District</label>
            <select class="form-control" name="district" id="district" onChange="getCircle(this.value)">
                <option value="" selected>Select District</option>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM districts");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id'] . '">' . $row['district_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Circle</label>
            <select name="circle" id="circle" class="form-control">
                <option value="Select Circle">Select Circle</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Village/Colony/ Sector</label>
            <input type="text" class="form-control" name="village_ward">
        </div>
        <div class="col-sm-4">
            <label>Land Classification</label>
            <select name="land_classification" id="land_classification" class="form-control">
                <option value="" selected>Select the Land Classification</option>
                <option value="Govt">Govt</option>
                <option value="Village">Village</option>
                <option value="others">Others</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Nature of Land Use</label>
            <select name="land_use" id="land_use" class="form-control">
                <option value="" selected>Select the Nature of Land Use</option>
                <option value="Residential">Residential</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Commercial">Commercial</option>
            </select>
        </div>
    </div>

</fieldset>
<br>
<!-- Owner Details -->
<fieldset>
    <legend>Ocupant Details</legend>
    <div class="row">
        <div class="col-sm-6">
             <label>Occupants Name</label>
            <input type="text" class="form-control" name="occupant_name">
        </div>
        <div class="col-sm-6">
            <label>Father/Husband Name</label>
            <input type="text" class="form-control" name="father_husband_name">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label>Location Description/ Boundaries</label>
            <textarea class="form-control" rows="3" name="location_description"></textarea>
        </div>
    </div>

</fieldset>
<br>
<!-- Land Details -->
<fieldset>
    <legend>Land Details</legend>
    <div class="row">
        <div class="col-sm-3">
            <label>Area (Sqm/Ha)</label>
            <input class="form-control" type="text" name="area">
        </div>
        <div class="col-sm 3">
            <label>Land under Possession</label>
            <input type="text" class="form-control" name="land_under_possession">
        </div>
        <div class="col-sm 3">
            <label>Date/Year of Occupancy</label>
            <input type="text" class="form-control" name="occupancy_date">
        </div>
        <div class="col-sm 3">
            <label>Details of Structure/Crops</label>
            <input type="text" class="form-control" name="crop_details">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label>Land Revenue Assessed (₹)</label>
            <input class="form-control" type="text" name="land_revenue">
        </div>
        <div class="col-sm-3">
            <label>Land Revenue Paid (Year-wise)</label>
            <input class="form-control" type="text" name="land_revenue_paid">
        </div>
        <div class="col-sm-3">
            <label>Receipt / Challan No. & Date</label>
            <input class="form-control" type="text" name="receipt_no_date">
        </div>
    </div>
</fieldset>
<br>

<!-- Admin -->
<fieldset>
    <label>Remarks</label>
    <textarea name="remarks" class="form-control" rows="3"></textarea>
</fieldset>
<button type="submit"  class="btn btn-primary">Submit</button>
</form>

                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>
<script>
<?php require_once 'bottom.php'; ?>