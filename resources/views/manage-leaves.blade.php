@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OrganizationLocations;
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Leaves</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Leaves</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-lg-12">
                    <div class="card-theme">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Leaves</h5>
                            <a href="{{url('add-leave')}}" class="btn-theme-orange">Add Leave</a>
                        </div>
                        @if(Session::has('success'))
                            <div class="px-4 pt-3">
                                <div class="alert alert-success mb-0">{{ Session::get('success') }}</div>
                        </div>@endif
                        <div class="card-body p-0">
                            <style>
                                #buttons-datatables_wrapper {
                                    padding: 20px;
                                }

                                .konnect-table-wrapper {
                                    overflow-x: auto !important;
                                }
                            </style>
                            <div class="konnect-table-wrapper">
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Leave Type</th>
                                            <th class="">Department</th>
                                            <th class="">Employee</th>
                                            <th class="">Leave Duration</th>
                                            <th class="">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php if (Auth::user()->user_role == 1) { ?>

                                    <tbody>
                                        <?php    foreach ($leaves as $leave) {
        $user_role = User::where('id', $leave->employee)->value('user_role');
        $final_location_data = "";
        if ($user_role == 2) {
            $employee_name = OtherHRManagerDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('last_name');
            $final_location_data = "";

        }
        if ($user_role == 3) {
            $employee_name = OtherEmployeeDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $leave->employee)->value('last_name');
            $department_name = OrganizationDepartments::where('id', $leave->department)->value('department');
            $department_location = OrganizationDepartments::where('id', $leave->department)->value('location');
            $selected_location_name = OrganizationLocations::where('id', $department_location)->value('location');
            $final_location_data = $department_name . ' (' . $selected_location_name . ')';
        }
        if ($user_role == 5) {
            $employee_name = OtherHODDetails::where('user_id', $leave->employee)->value('name');
            $final_location_data = "";

        }
        if ($user_role == 6) {
            $employee_name = OtherAuthoriserDetails::where('user_id', $leave->employee)->value('name');
            $final_location_data = "";

        }

        if ($leave->leave_type == "special") {
            $leave_type_name = "special";
        } else {
            $leave_type_name = LeaveTypes::where('id', $leave->leave_type)->value('leave_type');
        }
                                   ?>
                                        <tr>
                                            <td class="">{{ $leave_type_name}} </td>
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name ?? '-'}} </td>
                                            <td class="">{{$leave->leave_duration}} </td>
                                            <td class="">{{$leave->status}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-leaves/' . $leave->id) }}"
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
                                                    <a href="{{ url('delete-leaves/' . $leave->id) }}"
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
                                        <?php    } ?>
                                    </tbody>
                                    <?php } else {?>

                                    <tbody>
                                        <?php    foreach ($leaves as $leave) {
        if ($leave->leave_type == "special") {
            $leave_type_name = "special";
        } else {
            $leave_type_name = LeaveTypes::where('id', $leave->leave_type)->value('leave_type');
        }

        $user_role = User::where('id', $leave->employee)->value('user_role');
        if ($user_role == 2) {
            $employee_name = OtherHRManagerDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $attendence->user_id)->value('last_name');
            $final_location_data = "";
            $responsible_person = OtherHRManagerDetails::where('user_id', $leave->employee)->value('responsible_person');
            if ($responsible_person == Auth::user()->id) { ?>
                                        <tr>
                                            <td class="">{{ $leave_type_name}} </td>
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$leave->leave_duration}} </td>
                                            <td class="">{{$leave->status}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-leaves/' . $leave->id) }}"
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
                                                    <a href="{{ url('delete-leaves/' . $leave->id) }}"
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
                                        <?php            }
        }
        if ($user_role == 3) {
            $employee_name = OtherEmployeeDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $leave->employee)->value('last_name');
            $department_name = OrganizationDepartments::where('id', $leave->department)->value('department');
            $department_location = OrganizationDepartments::where('id', $leave->department)->value('location');
            $selected_location_name = OrganizationLocations::where('id', $department_location)->value('location');
            $final_location_data = $department_name . ' (' . $selected_location_name . ')';
            $responsible_person = OtherEmployeeDetails::where('user_id', $leave->employee)->value('responsible_person');
            if ($responsible_person == Auth::user()->id) { ?>
                                        <tr>
                                            <td class="">{{ $leave_type_name}} </td>
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$leave->leave_duration}} </td>
                                            <td class="">{{$leave->status}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-leaves/' . $leave->id) }}"
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
                                                    <a href="{{ url('delete-leaves/' . $leave->id) }}"
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
                                        <?php            }
        }
        if ($user_role == 5) {
            $employee_name = OtherHODDetails::where('user_id', $leave->employee)->value('name');
            $final_location_data = "";
            $responsible_person = OtherHODDetails::where('user_id', $leave->employee)->value('responsible_person');
            if ($responsible_person == Auth::user()->id) { ?>
                                        <tr>
                                            <td class="">{{ $leave_type_name}} </td>
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$leave->leave_duration}} </td>
                                            <td class="">{{$leave->status}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-leaves/' . $leave->id) }}"
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
                                                    <a href="{{ url('delete-leaves/' . $leave->id) }}"
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
                                        <?php            }
        }
        if ($user_role == 6) {
            $employee_name = OtherAuthoriserDetails::where('user_id', $leave->employee)->value('name');
            $final_location_data = "";
            $responsible_person = OtherAuthoriserDetails::where('user_id', $leave->employee)->value('responsible_person');
            if ($responsible_person == Auth::user()->id) { ?>
                                        <tr>
                                            <td class="">{{ $leave_type_name}} </td>
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$leave->leave_duration}} </td>
                                            <td class="">{{$leave->status}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-leaves/' . $leave->id) }}"
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
                                                    <a href="{{ url('delete-leaves/' . $leave->id) }}"
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
                                        <?php            }
        }

                                   ?>

                                        <?php    } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')