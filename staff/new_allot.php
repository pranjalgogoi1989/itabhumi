<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Land Parcel Allotment';
require_once 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate($_POST['csrf_token']);
    
    $parcel_id = $_POST["parcel_id"];
    $district = $_POST["district"];
    $circle = $_POST["circle"];
    $village_ward = $_POST["village"];
    $allotment_no = $_POST["allotment_no"];
    $dag_no = $_POST["dag_no"];
    $map_sheet_no = $_POST["map_sheet_no"];
    $gis_polygon = $_POST["gis_ref"];
    
    $pattadar_name = $_POST["owner_name"];
    $father_husband = $_POST["guardian_name"];
    $permanent_address = $_POST["permanent_address"];
    $current_address = $_POST["current_address"];
    $tribe_community = $_POST["tribe"];
    $ownership_type = $_POST["ownership_type"];
    $tenure_type = $_POST["tenure_type"];

    $area = $_POST["area"];
    $land_use = $_POST["land_use"];
    $north_boundary = $_POST["north_boundary"];
    $south_boundary = $_POST["south_boundary"];
    $east_boundary = $_POST["east_boundary"];
    $west_boundary = $_POST["west_boundary"];
    $latitude_nodes = $_POST["latitude_nodes"];
    $longitude_nodes = $_POST["longitude_nodes"];

    $mutation_order = $_POST["mutation_order"];
    $mutation_date = $_POST["mutation_date"];
    $revenue_demand = $_POST["revenue_demand"];
    $revenue_paid = $_POST["revenue_paid"];
    $receipt_no = $_POST["receipt_no"];
    $last_payment_date = $_POST["last_payment_date"];

    $encumbrance = $_POST["encumbrance"];
    $acquisition_status = $_POST["acquisition_status"];
    $encroachment_status = $_POST["encroachment_status"];
    $inspection_date = $_POST["inspection_date"];
    $digitisation_status = $_POST["digitisation_status"];
    $family_details="Y";
    $documents_available="Y";
    $entered_by = $_SESSION["username"];
    $verified_by = "";
    $last_updated_date = "";
    $remarks = $_POST["remarks"];
    $doc_count=$_POST["doc_count"];
    $fam_count=$_POST["family_count"];
    
    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "INSERT INTO land_parcel(parcel_id,district,circle,village_ward,allotment_no,dag_no,map_sheet_no,pattadar_name,father_husband,tribe_community,permanent_address,current_address,family_details,ownership_type,tenure_type,area,land_use,north_boundary,south_boundary,east_boundary,west_boundary,latitude,longitude,gis_polygon,mutation_order,mutation_date,revenue_demand,revenue_paid,receipt_no,last_payment_date,encumbrance_no,acquisition_status,encroachment_status,inspection_date,documents_available,digitisation_status,entered_by,verified_by,last_updated_date,remarks)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);"
        );
        $stmt->execute([$parcel_id,$district,$circle,$village_ward,$allotment_no,$dag_no,$map_sheet_no,$pattadar_name,$father_husband,$tribe_community,$permanent_address,$current_address,$family_details,$ownership_type,$tenure_type,$area,$land_use,$north_boundary,$south_boundary,$east_boundary,$west_boundary,$latitude_nodes,$longitude_nodes,$gis_polygon,$mutation_order,$mutation_date,$revenue_demand,$revenue_paid,$receipt_no,$last_payment_date,$encumbrance,$acquisition_status,$encroachment_status,$inspection_date,$documents_available,$digitisation_status,$entered_by,$verified_by,$last_updated_date,$remarks]);
        $parcel_id = $pdo->lastInsertId();

        if($fam_count>0){
            for($i=1;$i<=$fam_count;$i++){
                $fam_name="fam_name".$i;
                $fam_relation="fam_relation".$i;
                $fam_age="fam_age".$i;
                $fam_name = $_POST[$fam_name];
                $fam_relation = $_POST[$fam_relation];
                $fam_age = $_POST[$fam_age];
                if($fam_name!="" && $fam_relation!="" && $fam_age!=""){
                    $stmt = $pdo->prepare(
                        "INSERT INTO land_parcel_family(land_parcel_id,person_name,relationship, age)VALUES(?,?,?,?);"
                    );
                    $stmt->execute([$parcel_id,$fam_name,$fam_relation, $fam_age]);
                }
            }
        }

        if($doc_count>0){
            for($i=1;$i<=$doc_count;$i++){
                $doc_name="doc_name".$i;
                $doc_file="doc_file".$i;
                $doc_name = $_POST[$doc_name];
                $doc_file = $_POST[$doc_file];
                if($doc_name!="" && $doc_file!=""){
                    $stmt = $pdo->prepare(
                        "INSERT INTO documents_uploaded(mmodule_name,land_parcel_id,document_details, document_file)VALUES(?,?,?,?);"
                    );
                    $stmt->execute(['land_parcel',$parcel_id,$doc_name,$doc_file]);
                }
            }
        }   

        echo "<div class='alert alert-success'>Land Parcel Added Successfully!</div>";
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
                        <h5 class="card-title text-primary text-center">Land Parcel New Allotment</h5>
                        
                        <form method="POST" >
                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<!-- Basic Parcel Details -->
<fieldset>
    <legend>Parcel Details</legend>

    <div class="row">
        <div class="col-sm-4">
            <label>Parcel ID</label>
            <input type="text" class="form-control" name="parcel_id">
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
            <label>Village/Ward</label>
            <input type="text" class="form-control" name="village">
        </div>
        <div class="col-sm-4">
            <label>Allotment No</label>
            <input type="text" class="form-control" name="allotment_no">
        </div>
        <div class="col-sm-4">
            <label>Dag/Survey No</label>
            <input type="text" class="form-control" name="dag_no">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <label>Map Sheet No</label>
            <input type="text" class="form-control" name="map_sheet_no">
        </div>
        <div class="col-sm-4">
            <label>GIS Polygon/KML Ref</label>
            <input type="text" class="form-control" name="gis_ref">
        </div>
    </div>
</fieldset>
<br>
<!-- Owner Details -->
<fieldset>
    <legend>Owner Details</legend>
    <div class="row">
        <div class="col-sm-6">
             <label>Pattadar/Allottee Name</label>
            <input type="text" class="form-control" name="owner_name">
        </div>
        <div class="col-sm-6">
            <label>Father/Husband Name</label>
            <input type="text" class="form-control" name="guardian_name">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>Permanent Address</label>
            <textarea class="form-control" rows="3" name="permanent_address"></textarea>
        </div>
        <div class="col-sm-6">
            <label>Current Address</label>
            <textarea class="form-control" rows="3" name="current_address"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label>Tribe/Community</label>
            <input type="text" class="form-control" name="tribe">
        </div>
        <div class="col-sm-4">
            <label>Ownership Type</label>
            <select class="form-control" name="ownership_type">
                <option value="G">Govt. Allottee</option>
                <option value="L">LPC</option>
                <option value="E">Encroacher</option>
                <option value="I">Inherited</option>
                <option value="O">Other</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Tenure Type</label>
            <select class="form-control" name="tenure_type">
                <option value="P">PRIVATE</option>
                <option value="A">Allotment</option>
                <option value="L">LPC</option>
                <option value="S">STATE Govt.</option>
                <option value="C">CENTRAL GOVT.</option>
            </select>
        </div>
    </div>    
</fieldset>
<br>
<fieldset>
    <legend>Pattadar Family Details</legend>
    <span class="pull-right"><span class="btn btn-primary" onclick="addFamilyRow()"><i class="fa fa-plus"></i> Add family details</span> </span>
    <input type="hidden" value="0" id="family_count" name="family_count"/>
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
        <div class="col-sm-2">
            <label><i class="fa fa-trash"></i></label>
        </div>
    </div>
    <div id="familylist">

    </div>
</fieldset>
<br><br>
<!-- Land Details -->
<fieldset>
    <legend>Land & Boundary Details</legend>
    <div class="row">
        <div class="col-sm-6">
            <label>Area (Sqm/Ha)</label>
            <input class="form-control" type="text" name="area">
        </div>
        <div class="col-sm 6">
            <label>Land Use</label>
            <select class="form-control" name="land_use">
                <option value="R">Residential</option>
                <option value="C">Commercial</option>
                <option value="RC">Res Cum Commercial</option>
                <option value="A">Agriculture</option>
                <option value="H">Horticulture</option>
                <option value="CM">Community</option>
                <option value="I">Institutional</option>
                <option value="S">Society</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label>North Boundary</label><input type="text" class="form-control" name="north_boundary"></div>
        <div class="col-sm-3"><label>South Boundary</label><input type="text" class="form-control" name="south_boundary"></div>
        <div class="col-sm-3"><label>East Boundary</label><input type="text" class="form-control" name="east_boundary"></div>
        <div class="col-sm-3"><label>West Boundary</label><input type="text" class="form-control" name="west_boundary"></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>Latitude of Each Node</label>
            <textarea name="latitude_nodes" class="form-control" placeholder="Comma separated values"></textarea>
        </div>
        <div class="col-sm-6">
            <label>Longitude of Each Node</label>
            <textarea name="longitude_nodes" class="form-control" placeholder="Comma separated values"></textarea>
        </div>
    </div>
</fieldset>
<br>
<!-- Revenue & Mutation -->
<fieldset>
    <legend>Mutation & Revenue Details</legend>
    <div class="row">
        <div class="col-sm-2">
            <label>Mutation Order No</label>
            <input type="text" class="form-control" name="mutation_order">
        </div>
        <div class="col-sm-2">
            <label>Mutation Date</label>
            <input type="date" class="form-control" name="mutation_date">
        </div>
        <div class="col-sm-2">
            <label>Revenue Demand (₹)</label>
            <input type="number" class="form-control" name="revenue_demand" value="0" placeholder="0">
        </div>
        <div class="col-sm-2">
            <label>Revenue Paid (₹)</label>
            <input type="number" class="form-control" name="revenue_paid" value="0" placeholder="0">
        </div>
        <div class="col-sm-2">
            <label>Receipt No</label>
            <input type="text" class="form-control" name="receipt_no">
        </div>
        <div class="col-sm-2">
            <label>Last Payment Date</label>
            <input type="date" class="form-control" name="last_payment_date">
        </div>
    </div>
</fieldset>
<br>
<!-- Legal & Status -->
<fieldset>
    <legend>Legal & Status</legend>
    <div class="row">
        <div class="col-sm-2">
            <label>Encumbrance/Court Case</label>
            <select name="encumbrance" class="form-control">
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
        </div>
        <div class="col-sm-3">
            <label>Acquisition Status (LARR)</label>
            <input type="text" name="acquisition_status" class="form-control">
        </div>
        <div class="col-sm-3">
            <label>Encroachment Status</label>
            <input type="text" name="encroachment_status" class="form-control">
        </div>
        <div class="col-sm-2">
            <label>Inspection Date</label>
            <input type="date" name="inspection_date" class="form-control">
        </div>
        <div class="col-sm-2">
            <label>Digitisation Status</label>
            <select name="digitisation_status" class="form-control">
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
    </div>
    
    <div class="row">
        <legend>Documents Available</legend>
        <div class="col-md-12">
            <span class="btn btn-primary" onclick="openModal()">Upload Document</span>
            <input type="hidden" id="doc_count" value="0" name="doc_count" >
            <div id="doclist">

            </div>
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
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="text" name="document_name" class="form-control" placeholder="Enter a File Description"/>
            <input type="file" name="document" class="form-contorl" required><br><br>
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

let famCounter=0;
function addFamilyRow() {
    famCounter++;
    document.getElementById("family_count").value = famCounter;
    let html = `
        <div class='row'>
            <div class='col-md-2'>`+famCounter+`</div>
            <div class='col-md-4'><input type='text' class='form-control' id='fam_name`+famCounter+`' name='fam_name`+famCounter+`' placeholder='Name'></div>
            <div class='col-md-2'><input type='text' class='form-control' id='fam_relation`+famCounter+`' name='fam_relation`+famCounter+`' placeholder='Relation'></div>
            <div class='col-md-2'><input type='text' class='form-control' id='fam_age`+famCounter+`' name='fam_age`+famCounter+`' placeholder='Age'></div>
            <div class='col-md-2'><span onClick='removeFamRow(this)' class='btn btn-danger'>Remove</span></div>
        </div>
    `;
    document.getElementById("familylist").insertAdjacentHTML("beforeend", html);
}
function removeFamRow(button) {
    famCounter--;
    document.getElementById("family_count").value = famCounter;
    button.parentElement.parentElement.remove();
}
</script>
<?php require_once 'bottom.php'; ?>