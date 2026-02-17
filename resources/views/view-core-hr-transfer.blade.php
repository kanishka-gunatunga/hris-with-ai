@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationDepartments;
foreach ($transfer_details as $transfer_detail)  {
    $employee =$transfer_detail->employee;
    $from_department =$transfer_detail->from_department;
    $to_department =$transfer_detail->to_department;
    $transfer_date =$transfer_detail->transfer_date;
    $discription =$transfer_detail->discription;
    $employee_name = OtherEmployeeDetails::where('user_id', $employee)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $employee)->value('last_name');
    $from_department_name = OrganizationDepartments::where('id', $from_department)->value('department');
    $to_department_name = OrganizationDepartments::where('id', $to_department)->value('department');
}

?>
<style>
    .view-container{
        border:1px solid #000;
    }
    .view-header{
        padding:10px;
        background:#3a71c7;
        color:#fff;
        border-bottom:1px solid #000;

    }
    .view-content{
        padding:10px;
        color:#000;
        border-bottom:1px solid #3a71c7;

    }
    .view-header h2{
        font-size: 18px !important;
        color:#fff;
    }
    .view-content h2{
        font-size: 15px !important;
    }
    .card .body .col-xs-4, .card .body .col-sm-4, .card .body .col-md-4, .card .body .col-lg-4 {
    margin-bottom: 0px !important;
}
.card .body .col-xs-8, .card .body .col-sm-8, .card .body .col-md-8, .card .body .col-lg-8 {
    margin-bottom: 0px !important;
}
</style>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">View Transfer</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Transfer</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">View Transfer</h5>

                    </div>
                    <div class="card-body">
                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="row view-container">
                        <div class="col-md-4 view-header">
                        <h2>Employee</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$employee_name}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Department From</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$from_department_name}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Department To</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$to_department_name}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Transfer Date</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$transfer_date}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Description</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$discription}}</h2>
                        </div>


                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('layouts.footer')
<script>
$("#company").select2( {
	placeholder: "Select Company",
	allowClear: true
	} );
    $("#employee").select2( {
	placeholder: "Select Employee",
	allowClear: true
	} );
    $("#department").select2( {
	placeholder: "Select Department",
	allowClear: true
	} );
    $("#award_type").select2( {
	placeholder: "Select Award Type",
	allowClear: true
	} );
</script>
