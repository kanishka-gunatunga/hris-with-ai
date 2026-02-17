@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\User;
?>
<style>
    .card-theme {
        box-shadow: none !important;
        border: none !important;
    }

    .dashboard-title {
        color: #1F2937 !important;
        font-weight: 600 !important;
    }

    .page-title-box {
        display: block !important;
        padding-bottom: 20px;
    }

    .page-title-right {
        float: none !important;
        margin-top: 5px;
    }

    .breadcrumb-item.active {
        color: #FF5A1D !important;
    }

    .btn-theme-orange {
        background-color: #FF5A1D !important;
        border-color: #FF5A1D !important;
        color: white !important;
    }

    .btn-theme-orange:hover {
        background-color: #E64A12 !important;
        border-color: #E64A12 !important;
    }

    #buttons-datatables_wrapper {
        padding: 20px;
    }

    .konnect-table-wrapper {
        overflow-x: auto !important;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Employment Type History</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employment Type History</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Employment Type History List</h5>
                            <a href="{{url('change-employment-type')}}" class="btn btn-theme-orange">Change Employment
                                Type</a>
                        </div>
                        @if(Session::has('success'))
                            <div class="alert alert-success m-3">{{ Session::get('success') }}</div>
                        @endif

                        <div class="card-body p-0">
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Old Employment Type</th>
                                            <th>New Employment Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
foreach ($employeement_types as $employeement_type) {
    $name = OtherEmployeeDetails::where('user_id', $employeement_type->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employeement_type->employee)->value('last_name');
    $email = User::where('id', $employeement_type->employee)->value('email');
    $phone = OtherEmployeeDetails::where('user_id', $employeement_type->employee)->value('phone');
    $gender = OtherEmployeeDetails::where('user_id', $employeement_type->employee)->value('gender');
                                        ?>
                                        <tr>
                                            <td class="ps-4">{{$employeement_type->employee}}</td>
                                            <td>{{$name}}</td>
                                            <td>{{$email}}</td>
                                            <td>{{$phone}}</td>
                                            <td>{{$gender}}</td>
                                            <td>{{$employeement_type->old_employment_type}}</td>
                                            <td>{{$employeement_type->new_employment_type}}</td>
                                        </tr>
                                        <?php } ?>
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