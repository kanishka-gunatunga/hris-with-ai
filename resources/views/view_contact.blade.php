@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\Departments;
foreach ($details as $detail)  {
    $relation =$detail->relation;
    $email_work =$detail->email_work;
    $email_personal =$detail->email_personal;
    $name =$detail->name;
    $address_line1 =$detail->address_line1;
    $address_line2 =$detail->address_line2;
    $mobile_work =$detail->mobile_work;
    $mobile_ext =$detail->mobile_ext;
    $mobile_personal =$detail->mobile_personal;
    $mobile_home =$detail->mobile_home;
    $city =$detail->city;
    $state_province =$detail->state_province;
    $zip =$detail->zip;
    $country =$detail->country;
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
                    <h4 class="mb-sm-0" style="display: none;">View Contact</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Contact</li>
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
                        <h5 class="card-title mb-0">View Contact</h5>

                    </div>
                    <div class="card-body">
                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="row view-container">
                        <div class="col-md-4 view-header">
                        <h2>Relation</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$relation}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>E-Mail Work</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$email_work}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>E-Mail Personal</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$email_personal}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Name</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$name}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Address Line 1</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$address_line1}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Address Line 2</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$address_line2}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Mobile Work</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$mobile_work}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Mobile Ext</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$mobile_ext}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Mobile Personal</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$mobile_personal}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Mobile Home</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$mobile_home}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>City</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$city}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>State/Province</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$state_province}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>ZIP</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$zip}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Country</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$country}}</h2>
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
