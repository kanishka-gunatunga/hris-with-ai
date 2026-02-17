@include('layouts.header')
<?php
use App\Models\Designations;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
?>
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />

<div class="main-content">

    <div class="page-content pb-10">
        <div class="container-fluid mb-10">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Add Employee</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Employee</li>
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
                        <div class="card card-theme shadow-none rounded-3 border-0"
                            style="overflow: visible !important;">
                            <div class="card-header border-0 bg-white p-4">
                                <h4 class="card-title mb-0 dashboard-title">Employee Details</h4>
                            </div>

                            <div class="card-body p-4 pt-0" style="overflow: visible !important;">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2 mb-4">{{ Session::get('success') }}</div>
                                @endif

                                <div class="live-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ old('first_name') }}">
                                                @if ($errors->has('first_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('first_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ old('last_name') }}">
                                                @if ($errors->has('last_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('last_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Phone
                                                    Number</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone') }}">
                                                @if ($errors->has('phone'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Date of
                                                    Birth</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly" name="dob" value="{{ old('dob') }}"
                                                        id="dob">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('dob'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('dob') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Select
                                                    Gender</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('gender'))
                                                                {{ old('gender') }}
                                                            @else
                                                                Select Gender
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Male">Male</li>
                                                        <li data-value="Female">Female</li>
                                                    </ul>
                                                    <input type="hidden" name="gender" value="{{ old('gender') }}">
                                                </div>
                                                @if ($errors->has('gender'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('gender') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Branch</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('company'))
                                                                {{ old('company') }}
                                                            @else
                                                                Select Branch
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Kegalle">Kegalle</li>
                                                        <li data-value="Avissawella">Avissawella</li>
                                                        <li data-value="Colombo">Colombo</li>
                                                        <li data-value="Rathnapura">Rathnapura</li>
                                                    </ul>
                                                    <input type="hidden" name="company" value="{{ old('company') }}">
                                                </div>
                                                @if ($errors->has('company'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('company') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Department</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('department'))
                                                                <?php    echo OrganizationDepartments::where('id', old('department'))->value('department'); ?>
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
                                                            <?php    $location_name = OrganizationLocations::where('id', $department->location)->value('location'); ?>
                                                            <li data-value="{{ $department->id }}">
                                                                {{ $department->department . ' (' . $location_name . ')' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="department"
                                                        value="{{ old('department') }}">
                                                </div>
                                                @if ($errors->has('department'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('department') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Designation</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('designation'))
                                                                <?php    echo Designations::where('id', old('designation'))->value('designation'); ?>
                                                            @else
                                                                Select Designation
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($designations as $designation)
                                                            <li data-value="{{ $designation->id }}">
                                                                {{ $designation->designation }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="designation"
                                                        value="{{ old('designation') }}">
                                                </div>
                                                @if ($errors->has('designation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('designation') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Office
                                                    Shift</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('office_shift'))
                                                                {{ old('office_shift') }}
                                                            @else
                                                                Select Office Shift
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="1">1</li>
                                                        <li data-value="2">2</li>
                                                        <li data-value="3">3</li>
                                                        <li data-value="4">4</li>
                                                    </ul>
                                                    <input type="hidden" name="office_shift"
                                                        value="{{ old('office_shift') }}">
                                                </div>
                                                @if ($errors->has('office_shift'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('office_shift') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Employment
                                                    Type</label>
                                                <div class="custom-select" id="employment_type_select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('employment_type'))
                                                                {{ old('employment_type') }}
                                                            @else
                                                                Select Employment Type
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <li data-value="Full Time">Full Time</li>
                                                        <li data-value="Part Time">Part Time</li>
                                                        <li data-value="Intern">Intern</li>
                                                    </ul>
                                                    <input type="hidden" name="employment_type"
                                                        id="employment_type_input" value="{{ old('employment_type') }}">
                                                </div>
                                                @if ($errors->has('employment_type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('employment_type') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Date of
                                                    Joining</label>
                                                <div class="position-relative">
                                                    <input name="join_date" value="{{ old('join_date') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly" id="join_date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('join_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('join_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4" id="intern_field" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Internship End
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="intern_end_date" value="{{ old('intern_end_date') }}"
                                                        type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly" id="intern_end_date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('intern_end_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('intern_end_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">E-Mail</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">User Name</label>
                                                <input type="text" class="form-control" name="user_name"
                                                    value="{{ old('user_name') }}">
                                                @if ($errors->has('user_name'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('user_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    value="{{ old('password') }}">
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Confirm
                                                    Password</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    value="{{ old('password_confirmation') }}">
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Image</label>
                                                <input type="file" class="form-control" name="image">
                                                @if ($errors->has('image'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('image') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">EPF Number</label>
                                                <input type="text" class="form-control" name="epf_no"
                                                    value="{{ old('epf_no') }}">
                                                @if ($errors->has('epf_no'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('epf_no') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Appoinment
                                                    Date</label>
                                                <div class="position-relative">
                                                    <input name="appoinment_date" value="{{ old('appoinment_date') }}"
                                                        type="text" class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly" id="appoinment_date">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('appoinment_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('appoinment_date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Responsible
                                                    Person</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">
                                                            @if (old('responsible_person'))
                                                                {{ old('responsible_person') }}
                                                            @else
                                                                Select Responsible Person
                                                            @endif
                                                        </span>
                                                        <span class="arrow">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        @foreach ($hods as $hod)
                                                            <li data-value="{{ $hod->id }}">
                                                                <?php    echo OtherHODDetails::where('user_id', $hod->id)->value('name') . ' (HOD)'; ?>
                                                            </li>
                                                        @endforeach
                                                        @foreach ($hrms as $hrm)
                                                            <li data-value="{{ $hrm->id }}">
                                                                <?php    echo OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name') . ' (HRM)'; ?>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="responsible_person"
                                                        value="{{ old('responsible_person') }}">
                                                </div>
                                                @if ($errors->has('responsible_person'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('responsible_person') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Latitude</label>
                                                <input type="text" class="form-control" name="latitude"
                                                    value="{{ old('latitude') }}">
                                                @if ($errors->has('latitude'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('latitude') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">Longitude</label>
                                                <input type="text" class="form-control" name="longitude"
                                                    value="{{ old('longitude') }}">
                                                @if ($errors->has('longitude'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('longitude') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label text-[#556476] font-medium">NIC</label>
                                                <input type="text" class="form-control" name="nic"
                                                    value="{{ old('nic') }}">
                                                @if ($errors->has('nic'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('nic') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input orange-checked" type="checkbox"
                                                    id="activeEmp" checked="checked" name="status">
                                                <label class="form-check-label text-[#556476] font-medium"
                                                    for="activeEmp">
                                                    Active Employee
                                                </label>
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                        </div> <!-- end card -->

                        <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                            style="z-index: 1001; margin-left: 250px;">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                style="color: #556476; border-color: #556476;"
                                onclick="window.location.href='{{ url('employees') }}'">Back</button>
                            <button type="submit" class="btn btn-theme-orange px-5 py-2">Save as Employee</button>
                        </div>

                        <style>
                            .action-btn-back:hover {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                                color: white !important;
                            }

                            .orange-checked:checked {
                                background-color: #FF5A1D !important;
                                border-color: #FF5A1D !important;
                            }

                            @media (max-width: 991.98px) {
                                .fixed-bottom {
                                    margin-left: 0 !important;
                                }
                            }

                            /* Custom Orange Theme for Dropdowns */
                            .select-dropdown {
                                z-index: 1050 !important;
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

                            .flatpickr-day.today {
                                border-color: #FF5A1D !important;
                            }

                            .flatpickr-day.today:hover,
                            .flatpickr-day.today:focus {
                                border-color: #FF5A1D !important;
                                background: #FF5A1D !important;
                                color: white !important;
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
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
<script>
    flatpickr("#dob", {
        dateFormat: "n/j/Y",
    });
    flatpickr("#join_date", {
        dateFormat: "n/j/Y",
    });
    flatpickr("#intern_end_date", {
        dateFormat: "n/j/Y",
    });
    flatpickr("#appoinment_date", {
        dateFormat: "n/j/Y",
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Logic for Intern field
        const employmentTypeDropdown = document.querySelectorAll('#employment_type_select .select-dropdown li');
        const internField = document.getElementById('intern_field');
        const hiddenInput = document.getElementById('employment_type_input');

        function checkintern(value) {
            if (value === 'Intern') {
                internField.style.display = 'block';
            } else {
                internField.style.display = 'none';
            }
        }

        // Check initial value
        if (hiddenInput.value) {
            checkintern(hiddenInput.value);
        }

        employmentTypeDropdown.forEach(item => {
            item.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                checkintern(value);
            });
        });
    });
</script>