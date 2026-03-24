<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Land Allotment';
require_once 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate($_POST['csrf_token']);
    $insertId=$_POST['row_id'];
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
        $stmt= $pdo->prepare('update land_allotment set passbook_no=?,allotment_no=?,allotment_date=?,allotee_name=?,mobile_no=?,land_type=?,total_area=?,plot_location=?,dag_no=?,sheet_no=?,paid_upto=?,lease_period=?,district=?,father_name=?,lattitude=?,longitude=?,area=?,land_possession=?,date_occupancy=?,crop_structure=?,revenue_assessed=? where unique_id=?;');
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
            $district,
            $father_name,
            $lattitude,
            $longitude,
            $area,
            $land_possession,
            $date_occupancy,
            $crop_structure,
            $revenue_assessed,
            $unique_id,
        ]);

        if($doc_count>0){
            $stmt= $pdo->prepare("delete from documents_uploaded where land_parcel_id=? and module_name=?");
            $stmt->execute([$insertId,'land_allot']);
            for($i=1;$i<=$doc_count;$i++){
                $doc_name="doc_name".$i;
                $doc_file="doc_file".$i;
                $doc_name = $_POST[$doc_name];
                $doc_file = $_POST[$doc_file];
                if($doc_name!="" && $doc_file!=""){
                    $stmt = $pdo->prepare(
                        "INSERT INTO documents_uploaded(module_name,land_parcel_id,document_details, document_file)VALUES(?,?,?,?);"
                    );
                    $stmt->execute(['land_allot',$insertId,$doc_name,$doc_file]);
                }
            }
        }   
        echo "<div class='alert alert-success'>Land Allotment Data Updated Successfully!</div>";
        //exit();     
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
    <input type="hidden" name="row_id" value="<?php echo $row_id; ?>">
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
            <Label>District</Label>
            <select name="district" id="district" class="form-control">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM districts");
                $stmt->execute();
                while ($row1 = $stmt->fetch()) {
                    if($row1['district_name'] == $row['district']) {
                        echo '<option value="' . $row1['district_name'] . '" selected>' . $row1['district_name'] . '</option>';
                    }else{
                        echo '<option value="' . $row1['district_name'] . '">' . $row1['district_name'] . '</option>';
                    }
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
                while ($row2 = $stmt->fetch()) {
                    if($row2['circle_name'] == $row['plot_location']) {
                        echo '<option value="' . $row2['circle_name'] . '" selected>' . $row2['circle_name'] . '</option>';
                    }else{
                        echo '<option value="' . $row2['circle_name'] . '">' . $row2['circle_name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-sm-4">
            <label for="">Fathers' Name</label>
            <input type="text" name="father_name" id="father_name" class="form-control" value="<?php echo $row['father_name']; ?>">
        </div>
    </div>
    <legend>Allotment Details</legend>
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
            <label for="">Dag No</label>
            <input type="text" class="form-control" name="dag_no" value="<?php echo $row['dag_no']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label for="">Sheet No</label>
            <input type="text" class="form-control" name="sheet_no" value="<?php echo $row['sheet_no']; ?>">
        </div>
        <div class="col-sm-4">
            <label for="">Paid Upto</label>
            <input type="text" class="form-control" name="paid_upto" value="<?php echo $row['paid_upto']; ?>">
        </div>
        <div class="col-sm-4">
            <label for="">Lease Period</label>
            <input type="text" class="form-control" name="lease_period" value="<?php echo $row['lease_period']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="">Lattitude</label>
            <input type="text" class="form-control" name="lattitude" value="<?php echo $row['lattitude']; ?>">
        </div>
        <div class="col-sm-6">
            <label for="">Longitude</label>
            <input type="text" class="form-control" name="longitude" value="<?php echo $row['longitude']; ?>">
        </div>
    </div>
    <legend>Land Details</legend>
    <div class="row">
        <div class="col-sm-2">
            <Label>Area</Label>
            <input type="text" name="area" id="area" class="form-control" value="<?php echo $row['area']; ?>">
        </div>
        <div class="col-sm-2">
            <Label>Land Under Possession</Label>
            <input type="text" name="land_possession" id="land_possession" class="form-control" value="<?php echo $row['land_possession']; ?>">
        </div>
        <div class="col-sm-2">
            <Label>Date/Year of Occupancy</Label>
            <input type="text" name="date_occupancy" id="date_occupancy" class="form-control" value="<?php echo $row['date_occupancy']; ?>">
        </div>
        <div class="col-sm-3">
            <Label>Details of Crop Structure</Label>
            <input type="text" name="crop_structure" id="crop_structure" class="form-control" value="<?php echo $row['crop_structure']; ?>">
        </div>
        <div class="col-sm-3">
            <Label>Land Revenue Assessed</Label>
            <input type="text" name="revenue_assessed" id="revenue_assessed" class="form-control" value="<?php echo $row['revenue_assessed']; ?>">
        </div>
    </div>
    <div class="row">
        <legend>Uploaded Documents</legend>
        <div class="col-md-12">
            <span class="btn btn-primary" onclick="openModal()">Upload Document</span>
            <?php
            $stmt= $pdo->prepare("select * from documents_uploaded where land_parcel_id=? and module_name='land_allot'");
            $stmt->execute([$row_id]);
            ?>
            <input type="hidden" id="doc_count" value="<?php echo $stmt->rowCount(); ?>" name="doc_count" >
            <div id="doclist">
            <?php
                $count=0;
                while($row3=$stmt->fetch()){
                    $count++;
                    echo "<div class='row'>";
                    echo "<div class='col-md-1'>".$count."</div>";
                    echo "<div class='col-md-3'>".$row3["document_details"]."";
                    echo "<input type='hidden' id='doc_name".$count."' name='doc_name".$count."' value='".$row3["document_details"]."' />";
                    echo "</div>";
                    echo "<div class='col-md-3'>";
                    echo "<input type='hidden' id='doc_file".$count."' name='doc_file".$count."' value='".$row3["document_file"]."' />";
                    echo "<a href='/uploads/document/".$row3["document_file"]."' target='_blank' class='btn btn-primary'>View Document</a></div>";
                    echo "<div class='col-md-4'><span onClick='removeRow(this, '".$row3["document_file"].")' class='btn btn-danger'>Remove</span></div>";
                    echo "</div>";
                }
            ?>
            </div>
        </div>
    </div>  
</fieldset>
<br>
<center>
    <a href="/admin/land_record_details.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Back </a>
    <button type="submit"  class="btn btn-primary">Update</button>
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
            <div class="mb-3">
                <label for="document_name">Enter a File Description/Caption</label>
                <input type="text" name="document_name" id="document_name" class="form-control" placeholder="Enter a File Description"/>
            </div>
            <div class="mb-3">
                <input type="file" name="document" id="document" class="form-contorl" required><br>
            </div>
            <br>
            <div class="progress" id="progress" style="display:none">
                <div id="progressBar" class="progress-bar" style="width:0%">0%</div>
            </div>
            <br>
            <center>
                <button type="submit" class="btn btn-primary">Upload</button>
            </center>
        </form>
        <div id="response" style="text-align:center"></div>
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
     document.getElementById("response").innerHTML = "";
    document.getElementById("document_name").value = "";
    document.getElementById("document").value = "";
    document.getElementById("progressBar").style.width = "0%";
    document.getElementById("progress").style.display = "none";
    document.getElementById("uploadModal").style.display = "block";
}

function closeModal() {
    document.getElementById("uploadModal").style.display = "none";
}
let count=0;
document.getElementById("uploadForm").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById("response").innerHTML = "";
    document.getElementById("progress").style.display = "block";
    document.getElementById("progressBar").style.width = "0%";
    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "uploadDocument.php", true);
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            let percent = Math.round((e.loaded / e.total) * 100);

            let progressBar = document.getElementById("progressBar");
            progressBar.style.width = percent + "%";
            progressBar.innerHTML = percent + "%";
        }
    };
    xhr.onload = function() {
        let data = xhr.responseText;
        document.getElementById("response").innerHTML = data;
        if(data.includes("|")) {
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
            document.getElementById("response").innerHTML = "Upload Successful";
            closeModal(); 
        }
        document.getElementById("response").innerHTML = data;
    };
    xhr.send(formData);
});

function removeRow(button, filename) {
    
    if(confirm("Are you sure you want to delete this document?")) {
        count=document.getElementById("doc_count").value;
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