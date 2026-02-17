@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OrganizationLocations;
?>
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Leave</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Leave</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-theme shadow-none rounded-3 border-0" style="overflow: visible !important;">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Leave Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important; padding-bottom: 300px !important;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Leave Type</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('leave_type'))
                                                                @if(old('leave_type') == 'special') Special @else <?php echo LeaveTypes::where('id', old('leave_type'))->value('leave_type'); ?> @endif
                                                            @else
                                                                Select Leave Type
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="special">Special</li>
                                                        @foreach ($leave_types as $leave_type)
                                                            <li data-value="{{ $leave_type->id }}">
                                                                {{ $leave_type->leave_type }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="leave_type" value="{{ old('leave_type') }}">
                                                </div>
                                                @if ($errors->has('leave_type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('leave_type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Department</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('department'))
                                                                <?php echo OrganizationDepartments::where('id', old('department'))->value('department'); ?>
                                                            @else
                                                                Select Department
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($departments as $department)
                                                            <?php $location_name = OrganizationLocations::where('id', $department->location)->value('location'); ?>
                                                            <li data-value="{{ $department->id }}">
                                                                {{ $department->department . ' (' . $location_name . ')' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="department" value="{{ old('department') }}">
                                                </div>
                                                @if ($errors->has('department'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('department') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Employee</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('employee'))
                                                                <?php 
                                                                    $emp = OtherEmployeeDetails::where('user_id', old('employee'))->first();
                                                                    echo $emp->first_name . ' ' . $emp->last_name;
                                                                ?>
                                                            @else
                                                                Select Employee
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($employees as $employee)
                                                            <li data-value="{{ $employee->user_id }}">
                                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="employee" value="{{ old('employee') }}">
                                                </div>
                                                @if ($errors->has('employee'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('employee') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Leave
                                                    Duration</label>
                                                <div class="custom-select" id="leave_duration_container">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('leave_duration'))
                                                                {{ old('leave_duration') }}
                                                            @else
                                                                Full Day
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Full Day">Full Day</li>
                                                        <li data-value="Half Day">Half Day</li>
                                                    </ul>
                                                    <input type="hidden" name="leave_duration" id="leave_duration" value="{{ old('leave_duration', 'Full Day') }}">
                                                </div>
                                                @if ($errors->has('leave_duration'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('leave_duration') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row" id="full_day_details">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label text-[#556476] font-medium">Start
                                                            Date</label>
                                                        <div class="position-relative">
                                                            <input name="start_date" value="{{ old('start_date') }}"
                                                                type="text" class="form-control flatpickr-input active"
                                                                data-provider="flatpickr" data-date-format="n/j/Y"
                                                                readonly="readonly" id="start_date">
                                                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                style="pointer-events: none;">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </span>
                                                        </div>
                                                        @if ($errors->has('start_date'))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('start_date') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label text-[#556476] font-medium">End
                                                            Date</label>
                                                        <div class="position-relative">
                                                            <input name="end_date" value="{{ old('end_date') }}"
                                                                type="text" class="form-control flatpickr-input active"
                                                                data-provider="flatpickr" data-date-format="n/j/Y"
                                                                readonly="readonly" id="end_date">
                                                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                style="pointer-events: none;">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </span>
                                                        </div>
                                                        @if ($errors->has('end_date'))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('end_date') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="half_day_details" style="display: none;">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label text-[#556476] font-medium">Morning or
                                                            Evening</label>
                                                        <div class="custom-select">
                                                            <button type="button" class="select-button">
                                                                <span class="selected-value">
                                                                    @if (old('morining_or_evening'))
                                                                        {{ old('morining_or_evening') }}
                                                                    @else
                                                                        Morning
                                                                    @endif
                                                                </span>
                                                                <span class="arrow">
                                                                    <i class="ri-arrow-down-s-line"></i>
                                                                </span>
                                                            </button>
                                                            <ul class="select-dropdown hidden">
                                                                <li data-value="Morning">Morning</li>
                                                                <li data-value="Evening">Evening</li>
                                                            </ul>
                                                            <input type="hidden" name="morining_or_evening" value="{{ old('morining_or_evening', 'Morning') }}">
                                                        </div>
                                                        @if ($errors->has('morining_or_evening'))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('morining_or_evening') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label text-[#556476] font-medium">Date</label>
                                                        <div class="position-relative">
                                                            <input name="date" value="{{ old('date') }}"
                                                                type="text" class="form-control flatpickr-input active"
                                                                data-provider="flatpickr" data-date-format="n/j/Y"
                                                                readonly="readonly" id="leave_date">
                                                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                style="pointer-events: none;">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </span>
                                                        </div>
                                                        @if ($errors->has('date'))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('date') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label text-[#556476] font-medium">Description</label>
                                                <textarea class="form-control" name="discription" rows="3">{{ old('discription') }}</textarea>
                                                @if ($errors->has('discription'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('discription') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Remarks</label>
                                                <textarea class="form-control" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                                                @if ($errors->has('remarks'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('remarks') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Status</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('status'))
                                                                {{ old('status') }}
                                                            @else
                                                                Pending
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Pending">Pending</li>
                                                        <li data-value="First Level Approval">First Level Approval</li>
                                                        <li data-value="Approved">Approved</li>
                                                        <li data-value="Rejected">Rejected</li>
                                                    </ul>
                                                    <input type="hidden" name="status" value="{{ old('status', 'Pending') }}">
                                                </div>
                                                @if ($errors->has('status'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('status') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center" style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back" style="color: #556476; border-color: #556476;" onclick="window.location.href='{{ url('manage-leaves') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save Leave</button>
                        </div>

                        <style>
                            .action-btn-back:hover {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                                color: white !important;
                            }
                            @media (max-width: 991.98px) {
                                .fixed-bottom {
                                    margin-left: 0 !important;
                                }
                            }

                            /* Custom Orange Theme for Dropdowns */
                            .select-dropdown {
                                z-index: 1060 !important;
                            }

                            /* Custom Orange Theme for Flatpickr */
                            .flatpickr-day.selected,
                            .flatpickr-day.startRange,
                            .flatpickr-day.endRange,
                            .flatpickr-day.selected.inRange,
                            .flatpickr-day.startRange.inRange,
                            .flatpickr-day.endRange.inRange,
                            .flatpickr-day.selected:focus,
                            .flatpickr-day.startRange:focus,
                            .flatpickr-day.endRange:focus,
                            .flatpickr-day.selected:hover,
                            .flatpickr-day.startRange:hover,
                            .flatpickr-day.endRange:hover,
                            .flatpickr-day.selected.prevMonthDay,
                            .flatpickr-day.startRange.prevMonthDay,
                            .flatpickr-day.endRange.prevMonthDay,
                            .flatpickr-day.selected.nextMonthDay,
                            .flatpickr-day.startRange.nextMonthDay,
                            .flatpickr-day.endRange.nextMonthDay {
                                background: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                            }

                            .flatpickr-calendar {
                                z-index: 9999 !important;
                            }
                        </style>
                    </form>
                </div> <!-- end col -->
            </div>
        </div>
        <!-- container-fluid -->
    </div>

    <!-- End Page-content -->
    @include('layouts.footer')
    <script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to handle duration toggle
            function toggleDurationFields(value) {
                if (value == "Full Day") {
                    $("#full_day_details").show();
                    $("#half_day_details").hide();
                } else {
                    $("#full_day_details").hide();
                    $("#half_day_details").show();
                }
            }

            // Monitor custom dropdown for leave_duration
            $('#leave_duration_container .select-dropdown li').on('click', function() {
                var value = $(this).data('value');
                toggleDurationFields(value);
            });

            // Initial check based on old value or default
            toggleDurationFields($("#leave_duration").val());

            // Initialize Flatpickr
            flatpickr("#start_date", { dateFormat: "n/j/Y" });
            flatpickr("#end_date", { dateFormat: "n/j/Y" });
            flatpickr("#leave_date", { dateFormat: "n/j/Y" });
        });
    </script>
</div>
