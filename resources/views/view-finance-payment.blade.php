@include('layouts.header')
<?php
use App\Models\Departments;
use App\Models\FinancePayment;
use App\Models\OtherEmployeeDetails;
use App\Models\BasicSalary;
use App\Models\Allowances;
use App\Models\Commissions;
use App\Models\Deductions;
use App\Models\OtherPaymnets;
use App\Models\Overtimes;
use App\Models\FinanceAccountList;
use App\Models\Loans;

$basic_sallery = BasicSalary::where('user_id', $id)->value('basic_salary');
if($basic_sallery == null){
$basic_sallery = 0;
}
else{
$basic_sallery = $basic_sallery;
}
$payslip = BasicSalary::where('user_id', $id)->value('payslip_type');
if($payslip == null){
$payslip = "-";
}
else{
$payslip = $payslip;
}
$allowance = Allowances::where('user_id', $id)->value('allowance_amount');
if($allowance == null){
$allowance = 0;
}
else{
$allowance = $allowance;
}
$commissions = Commissions::where('user_id', $id)->value('commission_amount');
if($commissions == null){
$commissions = 0;
}
else{
$commissions = $commissions;
}
$loan = Loans::where('user_id', $id)->value('amount');
 if($loan == null){
$loan = 0;
}
else{
$loan = Loans::where('user_id', $id)->value('amount')/Loans::where('user_id', $id)->value('number_of_installments');
}
$deductions = Deductions::where('user_id', $id)->value('amount');
if($deductions == null){
$deductions = 0;
}
else{
$deductions = $deductions;
}
$other_paymnets = OtherPaymnets::where('user_id', $id)->value('amount');
if($other_paymnets == null){
$other_paymnets = 0;
}
else{
$other_paymnets = $other_paymnets;
}
$overtimes = Overtimes::where('user_id', $id)->value('total_hours');
if($overtimes == null){
$overtimes = 0;
}
else{
$overtimes = Overtimes::where('user_id', $id)->value('total_hours')*Overtimes::where('user_id', $id)->value('rate');
}
$net_sallery = ($basic_sallery+$allowance+$commissions+$other_paymnets+$overtimes)-($deductions+$loan);
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
                    <h4 class="mb-sm-0" style="display: none;">View Resignation</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Resignation</li>
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
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">View Resignation</h5>

                    </div>
                    <div class="card-body">
                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="row view-container">
                        <div class="col-md-4 view-header">
                        <h2>Basic Salary</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$payslip.' : '.$basic_sallery}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Allowances</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{'+'.$allowance}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Commissions</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{'+'.$commissions}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Loan</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{'-'.$loan}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Statutory deductions</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{'-'.$deductions}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Other Payment</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{'+'.$other_paymnets}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Overtime</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{'+'.$overtimes}}</h2>
                        </div>
                        <div class="col-md-4 view-header">
                        <h2>Net Salary</h2>
                        </div>
                        <div class="col-md-8 view-content">
                        <h2>{{$net_sallery}}</h2>
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
