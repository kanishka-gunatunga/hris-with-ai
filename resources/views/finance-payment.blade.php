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
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Payments</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Payments</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-theme shadow-none rounded-3 border-0">
                        <div
                            class="card-header d-flex justify-content-between align-items-center p-3 border-0 bg-white">
                            <h5 class="card-title mb-0 dashboard-title">Payments</h5>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success m-3">{{ Session::get('success') }}</div>
                        @endif

                        <div class="card-body p-0">
                            <style>
                                #buttons-datatables_wrapper {
                                    padding: 20px;
                                }

                                .konnect-table-wrapper {
                                    overflow-x: auto !important;
                                }
                            </style>
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Name</th>
                                            <th>Payslip Type</th>
                                            <th>Basic Salary</th>
                                            <th>Net Salary</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($payments as $payment) {
    $employees = OtherEmployeeDetails::where('department', $payment->department)->get();
    foreach ($employees as $employee) {
        $name = $employee->first_name . ' ' . $employee->last_name;
        $basic_sallery = BasicSalary::where('user_id', $employee->user_id)->value('basic_salary');
        if ($basic_sallery == null) {
            $basic_sallery = 0;
        }
        $payslip = BasicSalary::where('user_id', $employee->user_id)->value('payslip_type');
        if ($payslip == null) {
            $payslip = "-";
        }
        $allowance = Allowances::where('user_id', $employee->user_id)->value('allowance_amount');
        if ($allowance == null) {
            $allowance = 0;
        }
        $commissions = Commissions::where('user_id', $employee->user_id)->value('commission_amount');
        if ($commissions == null) {
            $commissions = 0;
        }
        $loan_data = Loans::where('user_id', $employee->user_id)->first();
        if ($loan_data == null) {
            $loan = 0;
        } else {
            $loan = $loan_data->amount / $loan_data->number_of_installments;
        }
        $deductions = Deductions::where('user_id', $employee->user_id)->value('amount');
        if ($deductions == null) {
            $deductions = 0;
        }
        $other_paymnets = OtherPaymnets::where('user_id', $employee->user_id)->value('amount');
        if ($other_paymnets == null) {
            $other_paymnets = 0;
        }
        $overtime_data = Overtimes::where('user_id', $employee->user_id)->first();
        if ($overtime_data == null) {
            $overtimes = 0;
        } else {
            $overtimes = $overtime_data->total_hours * $overtime_data->rate;
        }
        $net_sallery = ($basic_sallery + $allowance + $commissions + $other_paymnets + $overtimes) - ($deductions + $loan);?>
                                        <tr>

                                            <td class="ps-4">{{ $name }} </td>
                                            <td>{{ $payslip }} </td>
                                            <td>{{ $basic_sallery }} </td>
                                            <td>{{ $net_sallery }} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ url('view-finance-payment/' . $employee->user_id) }}"
                                                        class="btn-icon-soft-blue" title="View">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                            </path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php    }
} ?>
                                    </tbody>
                                </table>
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