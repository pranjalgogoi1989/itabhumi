<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
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

    $district = $_POST['district'];
    $father_name=$_POST['father_name'];
    $lattitude=$_POST['lattitude'];
    $longitude = $_POST['longitude'];
    $area = $_POST['area'];
    $land_possession = $_POST['land_possession'];
    $date_occupancy = $_POST['date_occupancy'];
    $crop_structure = $_POST['crop_structure'];
    $revenue_assessed = $_POST['revenue_assessed'];

    $doc_count=$_POST["doc_count"];

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

    if(empty($district)){
        $errors[] = "District is required";
    }
    if(empty($plot_location)){
        $errors[] = "Plot Location is required";
    }
    if(empty($father_name)){
        $errors[] = "Fathers Name is required";
    }
    if(empty($lattitude)){
        $errors[] = "Lattitude is required";
    }
    if(empty($longitude)){
        $errors[] = "Longitude is required";
    }
    if(empty($area)){
        $errors[] = "Area is required";
    }
    if(empty($land_possession)){
        $errors[] = "Land Possession Area is required";
    }
    if(empty($date_occupancy)){
        $errors[] = "Date/Year of Occupancy is required";
    }
    if(empty($crop_structure)){
        $errors[] = "Crop Structure is required";
    }
    if(empty($revenue_assessed)){
        $errors[] = "Revenue Assessed is required";
    }
    
    if (empty($errors)) {
        $stmt= $pdo->prepare('INSERT INTO land_allotment(unique_id,passbook_no,allotment_no,allotment_date,allotee_name,mobile_no,land_type,total_area,plot_location,dag_no,sheet_no,paid_upto,lease_period,district,father_name,lattitude,longitude,area,land_possession,date_occupancy,crop_structure,revenue_assessed) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);');
        $stmt->execute([
            $unique_id,
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
            $district,
            $father_name,
            $lattitude,
            $longitude,
            $area,
            $land_possession,
            $date_occupancy,
            $crop_structure,
            $revenue_assessed
        ]);
        $allot_id = $pdo->lastInsertId();
        if($doc_count>0){
            for($i=1;$i<=$doc_count;$i++){
                $doc_name="doc_name".$i;
                $doc_file="doc_file".$i;
                $doc_name = $_POST[$doc_name];
                $doc_file = $_POST[$doc_file];
                if($doc_name!="" && $doc_file!=""){
                    $stmt = $pdo->prepare(
                        "INSERT INTO documents_uploaded(module_name,land_parcel_id,document_details, document_file)VALUES(?,?,?,?);"
                    );
                    $stmt->execute(['land_allot',$allot_id,$doc_name,$doc_file]);
                }
            }
        }   
        echo "<div class='alert alert-success'>Land Allotment Data Added Successfully!</div>";
        exit();     
    }else{
        echo "<div class='alert alert-danger'>".implode("<br>", $errors)."</div>";
    }

}
?>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background: #fff;
        margin: auto;
        padding: 20px;
        width: 400px;
        border-radius: 8px;
    }

    .close {
        float: right;
        cursor: pointer;
        font-size: 22px;
    }

    #response {
        margin-top: 10px;
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
                        <h5 class="card-title text-primary text-center">Land Allotment</h5>
                        
                        <form method="POST" >
                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<!-- Basic Parcel Details -->
<fieldset>
    <legend>Basic Information</legend>
    <div class="row">
        <div class="col-sm-4">
            <label>Unique ID</label>
            <input type="text" class="form-control" name="unique_id" />
        </div>
        <div class="col-sm-4">
            <label>Passbook No</label>
            <input type="text" class="form-control" name="passbook_no" />
        </div>
        <div class="col-sm-4">
            <label>Allotment No</label>
            <input type="text" class="form-control" name="allotment_no" />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <Label>District</Label>
            <select name="district" id="district" class="form-control">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM districts");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['district_name'] . '">' . $row['district_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm-4">
            <Label>Plot Location</Label>
            <select name="plot_location" id="plot_location" class="form-control">
                <option value="" selected>--Select--</option>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM circles");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['circle_name'] . '">' . $row['circle_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm-4">
            <label for="">Fathers' Name</label>
            <input type="text" name="father_name" id="father_name" class="form-control">
        </div>
    </div>
    <legend>Allotment Details</legend>
    <div class="row">
        <div class="col-sm-4">
            <label>Allotment Date</label>
            <input type="date" class="form-control" name="allotment_date">
        </div>
        <div class="col-sm-4">
            <label>Allotee Name</label>
            <input type="text" class="form-control" name="allotee_name">
        </div>
        <div class="col-sm-4">
            <label>Mobile No</label>
            <input type="text" class="form-control" name="mobile_no">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Land Type</label>
            <select name="land_type" id="land_type" class='form-control'>
                <option value="C">Commercial</option>
                <option value="R">Residencial</option>
                <option value="M">Residencial cum Commercial</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Total Area</label>
            <input type="text" class="form-control" name="total_area">
        </div>
        <div class="col-sm-4">
            <label for="">Dag No</label>
            <input type="text" class="form-control" name="dag_no">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Sheet No</label>
            <input type="text" class="form-control" name="sheet_no">
        </div>
        <div class="col-sm-4">
            <label for="">Paid Upto</label>
            <input type="date" class="form-control" name="paid_upto">
        </div>
        <div class="col-sm-4">
            <label for="">Lease Period</label>
            <input type="date" class="form-control" name="lease_period">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="">Lattitude</label>
            <input type="text" class="form-control" name="lattitude">
        </div>
        <div class="col-sm-6">
            <label for="">Longitude</label>
            <input type="text" class="form-control" name="longitude">
        </div>
    </div>
    <legend>Land Details</legend>
    <div class="row">
        <div class="col-sm-2">
            <Label>Area</Label>
            <input type="text" name="area" id="area" class="form-control">
        </div>
        <div class="col-sm-2">
            <Label>Land Under Possession</Label>
            <input type="text" name="land_posession" id="land_possession" class="form-control">
        </div>
        <div class="col-sm-2">
            <Label>Date/Year of Occupancy</Label>
            <input type="text" name="date_occupancy" id="date_occupancy" class="form-control">
        </div>
        <div class="col-sm-3">
            <Label>Details of Crop Structure</Label>
            <input type="text" name="crop_structure" id="crop_structure" class="form-control">
        </div>
        <div class="col-sm-3">
            <Label>Land Revenue Assessed</Label>
            <input type="text" name="revenue_assessed" id="revenue_assessed" class="form-control">
        </div>
    </div>
    <legend>Documents Available</legend>
    <div class="row">
        <div class="col-md-12">
            <span class="btn btn-primary" onclick="openModal()">Upload Document(s)</span>
            <input type="hidden" id="doc_count" value="0" name="doc_count" >
            <div id="doclist">

            </div>
        </div>
    </div>   
</fieldset>
<br>
<center>
    <button type="submit"  class="btn btn-primary">Submit</button>
</center>
</form>

<div id="uploadModal" class="modal" class="modal-dialog">
    <div class="modal-content">
        <div class="row">
            <div class="col-md-11">
                <h3>Upload Document</h3>
            </div>
            <div class="col-md-1">
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
        </div>
        <span>(upload pdf only)</span>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="text" name="document_name" class="form-control" placeholder="Enter a File Description"/>
            <input type="file" name="document" class="form-contorl" accept=".pdf" required><br><br>
            <center>
                <button type="submit" class="btn btn-primary">Upload</button>
            </center>
        </form>
        <div id="response"></div>
    </div>
</div>

                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>
<script>
    function openModal() {
    document.getElementById("uploadModal").style.display = "block";
}

function closeModal() {
    document.getElementById("uploadModal").style.display = "none";
}
let count=0;
document.getElementById("uploadForm").addEventListener("submit", function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    fetch("uploadDocument.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("response").innerHTML = data;
        let datas = data.split("|");
        count++;
        document.getElementById("doc_count").value = count;
        let html = `
            <div class='row'>
                <div class='col-md-1'>`+count+`</div>
                <div class='col-md-3'>`+datas[0]+`
                    <input type='hidden' id='doc_name`+count+`' name='doc_name`+count+`' value='`+datas[0]+`' />
                </div>
                <div class='col-md-3'>
                    <input type='hidden' id='doc_file`+count+`' name='doc_file`+count+`' value='`+datas[1]+`' />
                    <a href='/uploads/document/`+datas[1]+`' target='_blank' class='btn btn-primary'>View Document</a></div>
                <div class='col-md-4'><span onClick='removeRow(this, "`+datas[1]+`")' class='btn btn-danger'>Remove</span></div>
            </div>
        `;
        document.getElementById("doclist").insertAdjacentHTML("beforeend", html);
        closeModal();
    })
    .catch(error => {
        document.getElementById("response").innerHTML = "Upload failed!";
    });
});

function removeRow(button, filename) {
    
    if(confirm("Are you sure you want to delete this document?")) {
        count--;
        document.getElementById("doc_count").value = count;
        fetch("removeDocument.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "file=" + filename
        })
        .then(response => response.text())
        .then(data => {
            alert('Document deleted successfully.');
        });

    }
    button.parentElement.parentElement.remove();
}
</script>
<?php require_once 'bottom.php'; ?>