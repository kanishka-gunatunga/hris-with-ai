@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\Departments;
foreach ($details as $detail)  {
    $warning_type =$detail->warning_type;
    $subject =$detail->subject;
    $warning_date =$detail->warning_date;
    $discription =$detail->discription;
    $status =$detail->status;
    $employee = OtherEmployeeDetails::where('user_id', $detail->employee)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $detail->complaint_from)->value('last_name');
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
                    <h4 class="mb-sm-0" style="display: none;">View Warning</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Warning</li>
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
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">View Warning</h5>

                    </div>
                    <div class="card-body">
                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="row view-container">
                        <div class="col-md-4 view-header">
                        <h2>Employee</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$employee}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Warning Type</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$warning_type}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Subject</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$subject}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Warning Date</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$warning_date}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Status</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$status}}</h2>
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
