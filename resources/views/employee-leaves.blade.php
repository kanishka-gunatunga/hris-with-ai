@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
use App\Models\UserCustomLeaves;
use App\Models\Leaves;
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
                    <div class="card-theme shadow-none rounded-3 border-0">
                        <div
                            class="card-header d-flex align-items-center justify-content-between bg-white border-0 p-4">
                            <h5 class="card-title mb-0 dashboard-title">Leaves</h5>
                            <a href="{{ url('add-employee-leave') }}" class="btn-theme-orange">
                                <i class="ri-add-line align-bottom me-1"></i> Add Leave
                            </a>
                        </div>
                        <div class="card-body p-4 pt-0">
                            @if (Session::has('success'))
                                <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>
                            @endif

                            <div class="mb-5">
                                <h4 class="mb-3 dashboard-title" style="font-size: 18px;">Available Leaves</h4>
                                <div class="konnect-table-wrapper">
                                    <table class="table konnect-table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-4">Leave Type</th>
                                                <th>Total Allowed</th>
                                                <th>Available Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($leave_types as $leave_type) {
    $leave_avilable_count = $leave_type->leave_count;
    $current_leaves = Leaves::where('leave_type', $leave_type->id)
        ->where('employee', $id)
        ->get();
    $used_count = 0;

    if ($leave_type->leave_available == 'monthly') {
        $currentMonth = date("Y-m");
        foreach ($current_leaves as $leave) {
            $leave_date = ($leave->leave_duration == "Full Day") ? $leave->start_date : $leave->date;
            if (date("Y-m", strtotime($leave_date)) == $currentMonth) {
                $used_count++;
            }
        }
    } else {
        $currentYear = date("Y");
        foreach ($current_leaves as $leave) {
            $leave_date = ($leave->leave_duration == "Full Day") ? $leave->start_date : $leave->date;
            if (date("Y", strtotime($leave_date)) == $currentYear) {
                $used_count++;
            }
        }
    }
    $available = $leave_avilable_count - $used_count;
                                            ?>
                                            <tr>
                                                <td class="ps-4">{{ $leave_type->leave_type }}</td>
                                                <td>{{ $leave_avilable_count }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $available > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} fs-12">
                                                        {{ $available >= 0 ? $available : 0 }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div>
                                <h4 class="mb-3 dashboard-title" style="font-size: 18px;">My Leaves</h4>
                                <style>
                                    #buttons-datatables_wrapper {
                                        padding: 0;
                                    }

                                    .konnect-table-wrapper {
                                        overflow-x: auto !important;
                                    }
                                </style>
                                <div class="konnect-table-wrapper">
                                    <table id="buttons-datatables"
                                        class="table konnect-table align-middle table-nowrap mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="ps-4">Leave Type</th>
                                                <th>Department</th>
                                                <th>Employee</th>
                                                <th>Duration</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($leaves as $leave) {
    if (Auth::user()->user_role == 2) {
        $employee_name = OtherHRManagerDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $leave->employee)->value('last_name');
    } elseif (Auth::user()->user_role == 3) {
        $employee_name = OtherEmployeeDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $leave->employee)->value('last_name');
    } elseif (Auth::user()->user_role == 5) {
        $employee_name = OtherHODDetails::where('user_id', $leave->employee)->value('name');
    } else {
        $employee_name = OtherAuthoriserDetails::where('user_id', $leave->employee)->value('name');
    }
    $department_name = OrganizationDepartments::where('id', $leave->department)->value('department');
    if ($leave->leave_type == "special") {
        $leave_type_name = "special";
    } else {
        $leave_type_name = LeaveTypes::where('id', $leave->leave_type)->value('leave_type');
    }
                                            ?>
                                            <tr>
                                                <td class="ps-4">{{ $leave_type_name }}</td>
                                                <td>{{ $department_name }}</td>
                                                <td>{{ $employee_name }}</td>
                                                <td>{{ $leave->leave_duration }}</td>
                                                <td>
                                                    @if($leave->status == 'Approved')
                                                        <span
                                                            class="badge bg-success-subtle text-success text-uppercase">Approved</span>
                                                    @elseif($leave->status == 'Rejected')
                                                        <span
                                                            class="badge bg-danger-subtle text-danger text-uppercase">Rejected</span>
                                                    @else
                                                        <span
                                                            class="badge bg-warning-subtle text-warning text-uppercase">{{ $leave->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ url('view-leave/' . $leave->id) }}"
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
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
</div>