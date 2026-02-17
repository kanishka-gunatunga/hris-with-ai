@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Transfers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transfers</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Transfers List</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                            <a href="{{url('add-transfer')}}" class="btn btn-theme-orange">Add Transfer</a>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success m-3">{{ Session::get('success') }}</div>@endif

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
                                            <th class="ps-4">Employee</th>
                                            <th>From Department</th>
                                            <th>To Department</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transfers as $transfer) {
    $emp_name = OtherEmployeeDetails::where('user_id', $transfer->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $transfer->employee)->value('last_name');
    $from_department_name = OrganizationDepartments::where('id', $transfer->from_department)->value('department');
    $from_department_location = OrganizationDepartments::where('id', $transfer->from_department)->value('location');
    $from_selected_location_name = OrganizationLocations::where('id', $from_department_location)->value('location');
    $to_department_name = OrganizationDepartments::where('id', $transfer->to_department)->value('department');
    $to_department_location = OrganizationDepartments::where('id', $transfer->to_department)->value('location');
    $to_selected_location_name = OrganizationLocations::where('id', $to_department_location)->value('location');

                                    ?>
                                        <tr>
                                            <td class="ps-4">{{$emp_name}} </td>
                                            <td>{{$from_department_name . ' (' . $from_selected_location_name . ')'}}</td>
                                            <td>{{$to_department_name . ' (' . $to_selected_location_name . ')'}}</td>
                                            <td>{{$transfer->transfer_date}} </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-core-hr-transfer/' . $transfer->id) }}"
                                                        class="btn-icon-soft-blue" title="Edit">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                            </path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('delete-core-hr-transfer/' . $transfer->id) }}"
                                                        class="btn-icon-soft-red" title="Delete">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
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
    <script>
        $("#company").select2({
            placeholder: "Select Company",
            allowClear: true
        });
        $("#from_department").select2({
            placeholder: "Select From Department",
            allowClear: true
        });
        $("#employee").select2({
            placeholder: "Select Employee",
            allowClear: true
        });
        $("#to_department").select2({
            placeholder: "Select To Department",
            allowClear: true
        });

    </script>