@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationDepartments;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
foreach ($details as $detail) {
    $leave_type = $detail->leave_type;
    $department = $detail->department;
    $employee = $detail->employee;
    $leave_duration = $detail->leave_duration;
    $start_date = $detail->start_date;
    $end_date = $detail->end_date;
    $morining_or_evening = $detail->morining_or_evening;
    $date = $detail->date;
    $discription = $detail->discription;
    $remarks = $detail->remarks;
    $status = $detail->status;
    $user_role = User::where('id', $employee)->value('user_role');
    if ($user_role == 2) {
        $employee_name = OtherHRManagerDetails::where('user_id', $employee)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $employee)->value('last_name');
    } elseif ($user_role == 3) {
        $employee_name = OtherEmployeeDetails::where('user_id', $employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee)->value('last_name');
    } elseif ($user_role == 5) {
        $employee_name = OtherHODDetails::where('user_id', $employee)->value('name');
    } else {
        $employee_name = OtherAuthoriserDetails::where('user_id', $employee)->value('name');
    }
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
}

?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">View Leave</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Leave</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-theme shadow-none rounded-3 border-0">
                        <div class="card-header border-0 bg-white p-4">
                            <h4 class="card-title mb-0 dashboard-title">Leave Details</h4>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label text-muted fs-13 text-uppercase fw-semibold">Leave
                                            Type</label>
                                        <p class="fs-15 fw-medium mb-0">{{ $leave_type }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted fs-13 text-uppercase fw-semibold">Department</label>
                                        <p class="fs-15 fw-medium mb-0">{{ $department_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted fs-13 text-uppercase fw-semibold">Employee</label>
                                        <p class="fs-15 fw-medium mb-0">{{ $employee_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted fs-13 text-uppercase fw-semibold">Duration</label>
                                        <p class="fs-15 fw-medium mb-0">{{ $leave_duration }}</p>
                                    </div>
                                </div>

                                @if($leave_duration == 'Full Day')
                                    <div class="col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label text-muted fs-13 text-uppercase fw-semibold">Start
                                                Date</label>
                                            <p class="fs-15 fw-medium mb-0">{{ $start_date }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label text-muted fs-13 text-uppercase fw-semibold">End
                                                Date</label>
                                            <p class="fs-15 fw-medium mb-0">{{ $end_date }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label text-muted fs-13 text-uppercase fw-semibold">Morning or
                                                Evening</label>
                                            <p class="fs-15 fw-medium mb-0">{{ $morining_or_evening }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label
                                                class="form-label text-muted fs-13 text-uppercase fw-semibold">Date</label>
                                            <p class="fs-15 fw-medium mb-0">{{ $date }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted fs-13 text-uppercase fw-semibold">Status</label>
                                        <div>
                                            @if($status == 'Approved')
                                                <span
                                                    class="badge bg-success-subtle text-success text-uppercase">Approved</span>
                                            @elseif($status == 'Rejected')
                                                <span
                                                    class="badge bg-danger-subtle text-danger text-uppercase">Rejected</span>
                                            @else
                                                <span
                                                    class="badge bg-warning-subtle text-warning text-uppercase">{{ $status }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted fs-13 text-uppercase fw-semibold">Description</label>
                                        <p class="fs-15 mb-0">{{ $discription ?: 'No description provided.' }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label
                                            class="form-label text-muted fs-13 text-uppercase fw-semibold">Remarks</label>
                                        <p class="fs-15 mb-0">{{ $remarks ?: 'No remarks provided.' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-2">
                                <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                    style="color: #556476; border-color: #556476;"
                                    onclick="window.history.back()">Back</button>
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

    <style>
        .action-btn-back:hover {
            background-color: #FF5A1D !important;
            border-color: #FF5A1D !important;
            color: white !important;
        }
    </style>
</div>