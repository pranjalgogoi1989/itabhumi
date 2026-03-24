<?php
require_once __DIR__ . '/../middleware/auth.php';
requireRole('staff');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../security/csrf.php';
$title='Search Chitha Record';
require_once 'header.php';

?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-top row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-center"> Search Chitha Record</h5>
                        
                        <fieldset>
                            <legend>Search Criteria</legend>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <input type="radio" name="search_criteria" value="chitha_no" checked> Chitha No
                                    <input type="radio" name="search_criteria" value="land_holder" checked> Land Holder

                                    
                                    <br>
                                    <input type="text" class="form-control" name="search_text" placeholder="Search Text" />
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </fieldset>
                        <br>
                        <center>
                            <button type="submit" name="submit" class="btn btn-primary">Search</button>
                        </center>
                        <br>

                        <div id="search_result">


                        </div>
                        
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('button[name="submit"]').click(function() {
            var search_criteria = $('input[name="search_criteria"]:checked').val();
            var search_text = $('input[name="search_text"]').val();
            $.ajax({
                url: 'ajax/search_chitha_record.php',
                type: 'POST',
                data: {
                    search_criteria: search_criteria,
                    search_text: search_text
                },
                success: function(response) {
                    $('#search_result').html(response);
                }
            });
        });
    });
</script>
<?php require_once 'bottom.php'; ?>