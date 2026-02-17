@include('layouts.header')
<?php
use App\Models\Designations;
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\PMProjectsEmployees;
use App\Models\OtherClientDetails;
use App\Models\PMTaskUsers;
use App\Models\OrganizationLocations;
use App\Models\LeaveTypes;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
use App\Models\OtherAdminDetails;
foreach ($other_details as $other_detail) {
    $first_name = $other_detail->first_name;
    $last_name = $other_detail->last_name;
    $phone = $other_detail->phone;
    $dob = $other_detail->dob;
    $gender = $other_detail->gender;
    $department = $other_detail->department;
    $employment_type = $other_detail->employment_type;
    $epf_no = $other_detail->epf_no;
    $appoinment_date = $other_detail->appoinment_date;
    $latitude = $other_detail->latitude;
    $longitude = $other_detail->longitude;
    $responsible_person = $other_detail->responsible_person;
    $nic = $other_detail->nic;
    $image = $other_detail->image;
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name = OrganizationLocations::where('id', $department_location)->value('location');
    if ($responsible_person == null) {
        $responsible_person_name = "";
    } else {
        $responsible_person_name = OtherHRManagerDetails::where('user_id', $responsible_person)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $responsible_person)->value('last_name') . ' (HRM)';
    }
}
foreach ($login_details as $login_details) {
    $status = $login_details->status;
    $email = $login_details->email;
    $user_name = $login_details->user_name;
    $id = $login_details->id;
    if ($status == "active") {
        $check = "checked";
    } else {
        $check = "";
    }
}
?>
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .card-theme {
        box-shadow: none !important;
        border: none !important;
    }

    .card-header {
        background-color: #fff !important;
        border-bottom: none !important;
        padding: 1.5rem !important;
    }

    .dashboard-title {
        color: #343a40;
        font-weight: 600;
    }

    .form-label {
        color: #556476 !important;
        font-weight: 500 !important;
    }

    .action-btn-back:hover {
        background-color: #FF5A1D !important;
        border-color: #FF5A1D !important;
        color: white !important;
    }

    .orange-checked:checked {
        background-color: #FF5A1D !important;
        border-color: #FF5A1D !important;
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

    @media (max-width: 991.98px) {
        .fixed-bottom {
            margin-left: 0 !important;
        }
    }

    /* Orange Tab Styling */
    .nav-pills .nav-link.active,
    .nav-customs .nav-link.active {
        background-color: #FF5A1D !important;
        color: #fff !important;
    }

    .nav-customs.nav .nav-link.active,
    .nav-customs.nav .nav-link.active:after,
    .nav-customs.nav .nav-link.active:before {
        background-color: #FF5A1D !important;
        color: #fff;
    }

    .custom-verti-nav-pills .nav-link.active {
        background-color: #FF5A1D !important;
        color: #fff !important;
    }

    @media (min-width: 992px) {
        .custom-verti-nav-pills .nav-link.active::before {
            border-left-color: #FF5A1D !important;
        }
    }

    .custom-verti-nav-pills .nav-link {
        color: #556476;
        /* Default text color */
    }

    /* Adjust page title box to stack title and breadcrumb */
    .page-title-box {
        display: block !important;
        padding-bottom: 20px;
    }

    .page-title-right {
        float: none !important;
        margin-top: 5px;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Edit HR Manager</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit HR Manager</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Edit HR Manager</h5>

                            @if(Session::has('success'))
                            <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                        </div>
                        <div class="card-body">
                            <div class="col-xxl-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tab1"
                                            role="tab">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab3" role="tab">Set Salary</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab4" role="tab">Leave</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab5" role="tab">Payslip</a>
                                    </li>
                                </ul><!-- Tab panes -->
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="tab1" role="tabpanel">

                                        <div class="col-xxl-12">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                                        role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active show" id="custom-v-pills-home-tab"
                                                            data-bs-toggle="pill" href="#subtab1" role="tab"
                                                            aria-controls="custom-v-pills-home" aria-selected="true">
                                                            Basic</a>
                                                        <a class="nav-link" id="custom-v-pills-profile-tab"
                                                            data-bs-toggle="pill" href="#subtab2" role="tab"
                                                            aria-controls="custom-v-pills-profile"
                                                            aria-selected="false">
                                                            Immigration</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#subtab3" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Emergency Contacts</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#subtab4" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Social Profile</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#subtab5" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Document</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#subtab6" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Qualification</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#subtab7" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Work Experience</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#subtab8" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Bank Account</a>
                                                    </div>
                                                </div> <!-- end col-->
                                                <div class="col-lg-10">
                                                    <div class="tab-content text-muted mt-3 mt-lg-0">
                                                        <div class="tab-pane fade active show" id="subtab1"
                                                            role="tabpanel" aria-labelledby="custom-v-pills-home-tab">
                                                            <form method="POST"
                                                                action="{{ url('edit-hrm-basic/' . $id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">

                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">First
                                                                                Name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="first_name"
                                                                                value="{{$first_name }}">
                                                                            @if($errors->has("first_name"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('first_name') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Last
                                                                                Name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="last_name"
                                                                                value="{{ $last_name }}">
                                                                            @if($errors->has("last_name"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('last_name') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Phone
                                                                                Number</label>
                                                                            <input type="text" class="form-control"
                                                                                name="phone" value="{{ $phone }}">
                                                                            @if($errors->has("phone"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('phone') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Date
                                                                                of Birth</label>
                                                                            <div class="position-relative">
                                                                                <input type="text"
                                                                                    class="form-control flatpickr-input active"
                                                                                    data-provider="flatpickr"
                                                                                    data-date-format="n/j/Y"
                                                                                    readonly="readonly" name="dob"
                                                                                    value="{{ $dob }}" id="dob">
                                                                                <span
                                                                                    class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                    style="pointer-events: none;">
                                                                                    <i class="ri-calendar-2-line"></i>
                                                                                </span>
                                                                            </div>
                                                                            @if($errors->has("dob"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('dob') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Select
                                                                                Gender</label>
                                                                            <div class="custom-select">
                                                                                <button type="button"
                                                                                    class="select-button">
                                                                                    <span
                                                                                        class="selected-value">{{ $gender ?: 'Select Gender' }}</span>
                                                                                    <span class="arrow"><i
                                                                                            class="ri-arrow-down-s-line"></i></span>
                                                                                </button>
                                                                                <ul class="select-dropdown hidden">
                                                                                    <li data-value="Male">Male</li>
                                                                                    <li data-value="Female">Female</li>
                                                                                </ul>
                                                                                <input type="hidden" name="gender"
                                                                                    value="{{ $gender }}">
                                                                            </div>
                                                                            @if($errors->has("gender"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('gender') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Department</label>
                                                                            <div class="custom-select">
                                                                                <button type="button"
                                                                                    class="select-button">
                                                                                    <span
                                                                                        class="selected-value">{{ $department_name . ' (' . $selected_location_name . ')' }}</span>
                                                                                    <span class="arrow"><i
                                                                                            class="ri-arrow-down-s-line"></i></span>
                                                                                </button>
                                                                                <ul class="select-dropdown hidden">
                                                                                    @foreach ($departments as $dept)
                                                                                        <?php    $location_name = OrganizationLocations::where('id', $dept->location)->value('location'); ?>
                                                                                        <li data-value="{{ $dept->id }}">
                                                                                            {{ $dept->department . ' (' . $location_name . ')' }}
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                                <input type="hidden" name="department"
                                                                                    value="{{ $department }}">
                                                                            </div>
                                                                            @if($errors->has("department"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('department') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Employment
                                                                                Type</label>
                                                                            <div class="custom-select">
                                                                                <button type="button"
                                                                                    class="select-button">
                                                                                    <span
                                                                                        class="selected-value">{{ $employment_type ?: 'Select Employment Type' }}</span>
                                                                                    <span class="arrow"><i
                                                                                            class="ri-arrow-down-s-line"></i></span>
                                                                                </button>
                                                                                <ul class="select-dropdown hidden">
                                                                                    <li data-value="Full Time">Full Time
                                                                                    </li>
                                                                                    <li data-value="Part Time">Part Time
                                                                                    </li>
                                                                                    <li data-value="Intern">Intern</li>
                                                                                </ul>
                                                                                <input type="hidden"
                                                                                    name="employment_type"
                                                                                    value="{{ $employment_type }}">
                                                                            </div>
                                                                            @if($errors->has("employment_type"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('employment_type') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">EPF
                                                                                Number</label>
                                                                            <input type="text" class="form-control"
                                                                                name="epf_no" value="{{ $epf_no }}">
                                                                            @if($errors->has("epf_no"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('epf_no') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Appoinment
                                                                                Date</label>
                                                                            <div class="position-relative">
                                                                                <input name="appoinment_date"
                                                                                    value="{{ $appoinment_date }}"
                                                                                    type="text"
                                                                                    class="form-control flatpickr-input active"
                                                                                    data-provider="flatpickr"
                                                                                    data-date-format="n/j/Y"
                                                                                    readonly="readonly"
                                                                                    id="appoinment_date">
                                                                                <span
                                                                                    class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                    style="pointer-events: none;">
                                                                                    <i class="ri-calendar-2-line"></i>
                                                                                </span>
                                                                            </div>
                                                                            @if($errors->has("appoinment_date"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('appoinment_date') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Latitude</label>
                                                                            <input type="text" class="form-control"
                                                                                name="latitude" value="{{ $latitude }}">
                                                                            @if($errors->has("latitude"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('latitude') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Longitude</label>
                                                                            <input type="text" class="form-control"
                                                                                name="longitude"
                                                                                value="{{$longitude }}">
                                                                            @if($errors->has("longitude"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('longitude') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->

                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">E-Mail</label>
                                                                            <input type="email" class="form-control"
                                                                                name="email" value="{{ $email }}">
                                                                            @if($errors->has("email"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('email') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Responsible
                                                                                Person</label>
                                                                            <div class="custom-select">
                                                                                <button type="button"
                                                                                    class="select-button">
                                                                                    <span
                                                                                        class="selected-value">{{ $responsible_person_name ?: 'Select Responsible Person' }}</span>
                                                                                    <span class="arrow"><i
                                                                                            class="ri-arrow-down-s-line"></i></span>
                                                                                </button>
                                                                                <ul class="select-dropdown hidden">
                                                                                    @foreach ($hrms as $hrm)
                                                                                        <li data-value="{{ $hrm->id }}">
                                                                                            <?php    echo OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name') . ' (HRM)'; ?>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                                <input type="hidden"
                                                                                    name="responsible_person"
                                                                                    value="{{ $responsible_person }}">
                                                                            </div>
                                                                            @if($errors->has("responsible_person"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('responsible_person') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">NIC</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nic" value="{{ $nic }}">
                                                                            @if($errors->has("nic"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('nic') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">User
                                                                                Name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="user_name"
                                                                                value="{{ $user_name }}">
                                                                            @if($errors->has("user_name"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('user_name') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Current
                                                                                Password</label>
                                                                            <input type="password" class="form-control"
                                                                                name="current_password" value="">
                                                                            @if($errors->has("current_password"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('current_password') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">New
                                                                                Password</label>
                                                                            <input type="password" class="form-control"
                                                                                name="password" value="">
                                                                            @if($errors->has("password"))
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
                                                                            <label
                                                                                class="form-label text-[#556476] font-medium">Confirm
                                                                                Password</label>
                                                                            <input type="password" class="form-control"
                                                                                name="password_confirmation" value="">
                                                                            @if($errors->has("password_confirmation"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('password_confirmation') }}
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>

                                                                    <!--end col-->

                                                                    <div class="col-md-12">
                                                                        <div class="form-check mb-3">
                                                                            <input
                                                                                class="form-check-input orange-checked"
                                                                                type="checkbox" id="activeHRM"
                                                                                {{$check}} name="status">
                                                                            <label
                                                                                class="form-check-label text-[#556476] font-medium"
                                                                                for="activeHRM">
                                                                                Active HR Manager
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <!-- Fixed Footer for Basic Tab -->
                                                                <div class="fixed-bottom bg-white border-top p-3 d-flex justify-content-between align-items-center"
                                                                    style="z-index: 1001; margin-left: 250px;">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary px-4 py-2 action-btn-back"
                                                                        style="color: #556476; border-color: #556476;"
                                                                        onclick="window.location.href='{{ url('hr-managers') }}'">Back</button>
                                                                    <button type="submit"
                                                                        class="btn btn-theme-orange px-5 py-2">Save
                                                                        Changes</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab2" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-profile-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-immigration">Add
                                                                        Immigration</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-immigration"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-immigration/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Immigration</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Document
                                                                                                        Number</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="document_no"
                                                                                                        value="">
                                                                                                    @if($errors->has("document_no"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('document_no') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Document
                                                                                                        Type</label>
                                                                                                    <select
                                                                                                        class="form-control"
                                                                                                        data-choices
                                                                                                        id="choices-single-default"
                                                                                                        name="document_type">

                                                                                                        <option
                                                                                                            value="Driving Licesnse">
                                                                                                            Driving
                                                                                                            Licesnse
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="Passport">
                                                                                                            Passport
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="National Id">
                                                                                                            National Id
                                                                                                        </option>
                                                                                                    </select>
                                                                                                    @if($errors->has("document_type"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('document_type') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Issue
                                                                                                        Date</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="issue_date"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("issue_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('issue_date') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Expire
                                                                                                        Date</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="expire_date"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("expire_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('expire_date') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Eligible
                                                                                                        Review
                                                                                                        Date</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="review_date"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("review_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('review_date') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Country</label>
                                                                                                    <select
                                                                                                        class="form-control"
                                                                                                        data-choices
                                                                                                        id="choices-single-default"
                                                                                                        name="country">

                                                                                                        <option
                                                                                                            value="1">1
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="2">2
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="3">3
                                                                                                        </option>
                                                                                                    </select>
                                                                                                    @if($errors->has("country"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('country') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Document</label>
                                                                                                    <input type="file"
                                                                                                        class="form-control"
                                                                                                        name="document"
                                                                                                        required>
                                                                                                    @if($errors->has("document"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('document') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Document No</th>
                                                                                <th class="">Document Type</th>
                                                                                <th class=""> Issue Date </th>
                                                                                <th class=""> Expire Date </th>
                                                                                <th class=""> Review Date </th>
                                                                                <th class="">Document</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($immigrations as $immigration) {
                                    ?>
                                                                            <tr class="odd gradeX">

                                                                                <td class="">
                                                                                    {{$immigration->document_no}}
                                                                                </td>
                                                                                <td class="">
                                                                                    {{$immigration->document_type}}
                                                                                </td>
                                                                                <td class="">
                                                                                    {{$immigration->issue_date}}
                                                                                </td>
                                                                                <td class="">
                                                                                    {{$immigration->expire_date}}
                                                                                </td>
                                                                                <td class="">
                                                                                    {{$immigration->review_date}}
                                                                                </td>
                                                                                <td class=""><a
                                                                                        href="{{ asset('immigration_documents/' . $immigration->document . '')  }}"
                                                                                        download>Download</a></td>
                                                                                <td class="">
                                                                                    <a
                                                                                        href="{{ url('edit-immigration/' . $immigration->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-immigration/' . $immigration->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab3" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-contact">Add
                                                                        Contact</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-contact" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-contact/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Contact</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Relation</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Relation</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="Self">
                                                                                                                Self
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Parent">
                                                                                                                Parent
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Spouse">
                                                                                                                Spouse
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Child">
                                                                                                                Child
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Sibling">
                                                                                                                Sibling
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="In Laws">
                                                                                                                In Laws
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="relation"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("relation"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('relation') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">E-Mail
                                                                                                        Work</label>
                                                                                                    <input type="email"
                                                                                                        class="form-control"
                                                                                                        name="email_work"
                                                                                                        value="">
                                                                                                    @if($errors->has("email_work"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('email_work') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">E-Mail
                                                                                                        Personal</label>
                                                                                                    <input type="email"
                                                                                                        class="form-control"
                                                                                                        name="email_personal"
                                                                                                        value="">
                                                                                                    @if($errors->has("email_personal"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('email_personal') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Name</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="">
                                                                                                    @if($errors->has("name"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('name') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Address
                                                                                                        Line 1</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="address_line1"
                                                                                                        value="">
                                                                                                    @if($errors->has("address_line1"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('address_line1') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Address
                                                                                                        Line 2</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="address_line2"
                                                                                                        value="">
                                                                                                    @if($errors->has("address_line2"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('address_line2') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Mobile
                                                                                                        Work</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="mobile_work"
                                                                                                        value="">
                                                                                                    @if($errors->has("mobile_work"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('mobile_work') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Mobile
                                                                                                        Ext</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="mobile_ext"
                                                                                                        value="">
                                                                                                    @if($errors->has("mobile_ext"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('mobile_ext') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Mobile
                                                                                                        Personal</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="mobile_personal"
                                                                                                        value="">
                                                                                                    @if($errors->has("mobile_personal"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('mobile_personal') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Mobile
                                                                                                        Home</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="mobile_home"
                                                                                                        value="">
                                                                                                    @if($errors->has("mobile_home"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('mobile_home') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">City</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="city"
                                                                                                        value="">
                                                                                                    @if($errors->has("city"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('city') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">State/Province</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="state_province"
                                                                                                        value="">
                                                                                                    @if($errors->has("state_province"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('state_province') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">ZIP</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="zip"
                                                                                                        value="">
                                                                                                    @if($errors->has("zip"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('zip') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Country</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Country</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="1">
                                                                                                                1</li>
                                                                                                            <li
                                                                                                                data-value="2">
                                                                                                                2</li>
                                                                                                            <li
                                                                                                                data-value="3">
                                                                                                                3</li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="country"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("country"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('country') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <!--end col-->
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="center">Relation</th>
                                                                                <th class="center">Name</th>

                                                                                <th class="center"> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($contacts as $contact) {
                                    ?>
                                                                            <tr class="odd gradeX">

                                                                                <td>{{$contact->relation}}</td>
                                                                                <td>{{$contact->name}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-contact/' . $contact->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-contact/' . $contact->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab4" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <form method="POST"
                                                                action="{{ url('add-social-profile/' . $id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <?php
if ($social_profile == null || $social_profile->isEmpty()) {
    $facebook_profile = "";
    $skype_profile = "";
    $linkedIn_profile = "";
    $twitter_profile = "";
    $whatsapp_profile = "";
} else {
    foreach ($social_profile as $social_pro) {
        $facebook_profile = $social_pro->facebook_profile;
        $skype_profile = $social_pro->skype_profile;
        $linkedIn_profile = $social_pro->linkedIn_profile;
        $twitter_profile = $social_pro->twitter_profile;
        $whatsapp_profile = $social_pro->whatsapp_profile;
    }
}
                ?>
                                                                <div class="row">

                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Facebook
                                                                                Profile</label>
                                                                            <input type="text" class="form-control"
                                                                                name="facebook_profile"
                                                                                value="{{$facebook_profile }}">
                                                                            @if($errors->has("facebook_profile"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('facebook_profile') }}
                                                                                    </li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Skype Profile</label>
                                                                            <input type="text" class="form-control"
                                                                                name="skype_profile"
                                                                                value="{{$skype_profile }}">
                                                                            @if($errors->has("skype_profile"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('skype_profile') }}
                                                                                    </li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">LinkedIn
                                                                                Profile</label>
                                                                            <input type="text" class="form-control"
                                                                                name="linkedIn_profile"
                                                                                value="{{$linkedIn_profile }}">
                                                                            @if($errors->has("linkedIn_profile"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('linkedIn_profile') }}
                                                                                    </li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Twitter
                                                                                Profile</label>
                                                                            <input type="text" class="form-control"
                                                                                name="twitter_profile"
                                                                                value="{{$twitter_profile }}">
                                                                            @if($errors->has("twitter_profile"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('twitter_profile') }}
                                                                                    </li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Whats App
                                                                                Profile</label>
                                                                            <input type="text" class="form-control"
                                                                                name="whatsapp_profile"
                                                                                value="{{$whatsapp_profile }}">
                                                                            @if($errors->has("whatsapp_profile"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('whatsapp_profile') }}
                                                                                    </li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <button type="submit" class="btn btn-theme-orange">Save
                                                                    Changes</button>
                                                            </form>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab5" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-document">Add
                                                                        Document</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-document" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-document/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Document</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">


                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="title"
                                                                                                        value="">
                                                                                                    @if($errors->has("title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Document
                                                                                                        Type</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Document
                                                                                                                Type</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="Driving Licesnse">
                                                                                                                Driving
                                                                                                                Licesnse
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Passport">
                                                                                                                Passport
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="National Id">
                                                                                                                National
                                                                                                                Id</li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="document_type"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("document_type"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('document_type') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Description</label>
                                                                                                    <textarea
                                                                                                        class="form-control"
                                                                                                        name="discription"></textarea>
                                                                                                    @if($errors->has("discription"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('discription') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Document</label>
                                                                                                    <input type="file"
                                                                                                        class="form-control"
                                                                                                        name="document">
                                                                                                    @if($errors->has("document"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('document') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Expire
                                                                                                        Date</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="expire_date"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("expire_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('expire_date') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-12">
                                                                                                <div
                                                                                                    class="form-check mb-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="checkbox"
                                                                                                        id="formCheck6"
                                                                                                        name="send_notification">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="formCheck6">
                                                                                                        Send
                                                                                                        Notification?
                                                                                                        (will get
                                                                                                        notification
                                                                                                        email before 3
                                                                                                        days of expiry
                                                                                                        date)
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Title</th>
                                                                                <th class="">Document Type</th>
                                                                                <th class="">Expire Date</th>
                                                                                <th class="">Send Notification</th>
                                                                                <th class="">Document</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($documents as $document) {
                                    ?>
                                                                            <tr class="odd gradeX">

                                                                                <td class="">{{$document->title}}</td>
                                                                                <td class="">
                                                                                    {{$document->document_type}}
                                                                                </td>
                                                                                <td class="">{{$document->expire_date}}
                                                                                </td>
                                                                                <td class="">
                                                                                    {{$document->send_notification}}
                                                                                </td>

                                                                                <td class=""><a
                                                                                        href="{{ asset('genaral_document_documents/' . $document->document . '')  }}"
                                                                                        download>Download</a></td>
                                                                                <td class="">
                                                                                    <a
                                                                                        href="{{ url('edit-document/' . $document->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-document/' . $document->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab6" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-qualifications">Add
                                                                        Qualifications</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-qualifications"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-qulification/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Qualifications</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">School/University</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="school_university"
                                                                                                        value="">
                                                                                                    @if($errors->has("school_university"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('school_university') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Education
                                                                                                        Level</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Education
                                                                                                                Level</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="BSC">
                                                                                                                BSC</li>
                                                                                                            <li
                                                                                                                data-value="Diploma">
                                                                                                                Diploma
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="BBA">
                                                                                                                BBA</li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="education_level"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("education_level"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('education_level') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">From</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="from"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("meeting_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('from') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">To</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input name="to"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("to"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('to') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Language</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Language</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="English">
                                                                                                                English
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Arabic">
                                                                                                                Arabic
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="language"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("language"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('language') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Professional
                                                                                                        Skills</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Professional
                                                                                                                Skills</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="MS Word">
                                                                                                                MS Word
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Photoshop">
                                                                                                                Photoshop
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="professional_skills"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("professional_skills"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('professional_skills') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Description</label>
                                                                                                    <textarea
                                                                                                        class="form-control"
                                                                                                        name="discription"></textarea>
                                                                                                    @if($errors->has("discription"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('discription') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">School/University</th>
                                                                                <th class="">Education Level</th>
                                                                                <th class="">From</th>
                                                                                <th class="">To</th>
                                                                                <th class="">Language</th>
                                                                                <th class="">Professional Skills</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($qulifications as $qulification) {
                                    ?>
                                                                            <tr class="odd gradeX">

                                                                                <td>{{$qulification->school_university}}
                                                                                </td>
                                                                                <td>{{$qulification->education_level}}
                                                                                </td>
                                                                                <td>{{$qulification->from_date}}</td>
                                                                                <td>{{$qulification->to_date}}</td>
                                                                                <td>{{$qulification->language}}</td>
                                                                                <td>{{$qulification->professional_skills}}
                                                                                </td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-qulification/' . $qulification->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-qulification/' . $qulification->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab7" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-work">Add Work
                                                                        Experience</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-work" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-work/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Work Experience</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Company</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="company"
                                                                                                        value="">
                                                                                                    @if($errors->has("company"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('company') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">From</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="from_date"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("from_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('from_date') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">To</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="to_date"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="n/j/Y"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("to_date"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('to_date') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Post</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="post"
                                                                                                        value="">
                                                                                                    @if($errors->has("post"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('post') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Description</label>
                                                                                                    <textarea
                                                                                                        class="form-control"
                                                                                                        name="discription"></textarea>
                                                                                                    @if($errors->has("discription"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('discription') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Company</th>
                                                                                <th class="">From</th>
                                                                                <th class="">To</th>
                                                                                <th class="">Post</th>
                                                                                <th class="">Description</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($works as $work) {
                                    ?>
                                                                            <tr class="odd gradeX">

                                                                                <td>{{$work->company}}</td>
                                                                                <td>{{$work->from_date}}</td>
                                                                                <td>{{$work->to_date}}</td>
                                                                                <td>{{$work->post}}</td>
                                                                                <td>{{$work->discription}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-work/' . $work->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-work/' . $work->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="subtab8" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-bank">Add Bank
                                                                        Account</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-bank" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-bank-account/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Bank Account</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Account
                                                                                                        Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="account_title"
                                                                                                        value="">
                                                                                                    @if($errors->has("account_title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('account_title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Account
                                                                                                        Number</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="account_number"
                                                                                                        value="">
                                                                                                    @if($errors->has("account_number"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('account_number') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Bank
                                                                                                        Name</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="bank_name"
                                                                                                        value="">
                                                                                                    @if($errors->has("bank_name"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('bank_name') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Bank
                                                                                                        Code</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="bank_code"
                                                                                                        value="">
                                                                                                    @if($errors->has("bank_code"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('bank_code') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Bank
                                                                                                        Branch</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="bank_branch"
                                                                                                        value="">
                                                                                                    @if($errors->has("bank_branch"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('bank_branch') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="center">Account Title</th>
                                                                                <th class="center">Account Number</th>
                                                                                <th class="center">Bank Name</th>
                                                                                <th class="center">Bank Code</th>
                                                                                <th class="center">Bank Branch</th>
                                                                                <th class="center"> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($bank_accounts as $bank_account) {
                                    ?>
                                                                            <tr class="odd gradeX">

                                                                                <td>{{$bank_account->account_title}}
                                                                                </td>
                                                                                <td>{{$bank_account->account_number}}
                                                                                </td>
                                                                                <td>{{$bank_account->bank_name}}</td>
                                                                                <td>{{$bank_account->bank_code}}</td>
                                                                                <td>{{$bank_account->bank_branch}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-bank-account/' . $bank_account->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-bank-account/' . $bank_account->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                    </div>
                                                </div> <!-- end col-->
                                            </div> <!-- end row-->
                                        </div>
                                        <!--end col-->


                                    </div>
                                    <div class="tab-pane" id="tab2" role="tabpanel">
                                        <div class="col-sm-4">
                                            <img src="{{ asset('user_images/' . $image . '') }}" alt=""
                                                style="width:50%;">
                                        </div>

                                        <form method="POST" action="{{ url('change-hrm-image/' . $id) }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mt-4">

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Profile
                                                            Image</label>
                                                        <input type="file" class="form-control" name="image" value="">
                                                        @if($errors->has("image"))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('image') }}</li>
                                                        </div>@endif
                                                    </div>
                                                </div>


                                            </div>
                                            <button type="submit" class="btn btn-theme-orange">Save Changes</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab3" role="tabpanel">
                                        <div class="col-xxl-12">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                                        role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active show" id="custom-v-pills-home-tab"
                                                            data-bs-toggle="pill" href="#stab1" role="tab"
                                                            aria-controls="custom-v-pills-home" aria-selected="true">
                                                            Basic Salary</a>
                                                        <a class="nav-link" id="custom-v-pills-profile-tab"
                                                            data-bs-toggle="pill" href="#stab2" role="tab"
                                                            aria-controls="custom-v-pills-profile"
                                                            aria-selected="false">
                                                            Allowances</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#stab3" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Commissions</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#stab4" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Loans</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#stab5" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Statutory Deductions</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#stab6" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Other Payment</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#stab7" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Overtime</a>
                                                        <a class="nav-link" id="custom-v-pills-messages-tab"
                                                            data-bs-toggle="pill" href="#stab8" role="tab"
                                                            aria-controls="custom-v-pills-messages"
                                                            aria-selected="false">
                                                            Salary Pension</a>
                                                    </div>
                                                </div> <!-- end col-->
                                                <div class="col-lg-10">
                                                    <div class="tab-content text-muted mt-3 mt-lg-0">
                                                        <div class="tab-pane fade active show" id="stab1"
                                                            role="tabpanel" aria-labelledby="custom-v-pills-home-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-bsalary">Add Basic
                                                                        Salary</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-bsalary" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-basic-salary/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Basic Salary</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Payslip
                                                                                                        Type</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Payslip
                                                                                                                Type</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="Monthly Payslip">
                                                                                                                Monthly
                                                                                                                Payslip
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Hourly Payslip">
                                                                                                                Hourly
                                                                                                                Payslip
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="payslip_type"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("payslip_type"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('payslip_type') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Basic
                                                                                                        Salary</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="basic_salary"
                                                                                                        value="">
                                                                                                    @if($errors->has("basic_salary"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('basic_salary') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->



                                                                                            <!--end col-->
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Payslip Type</th>
                                                                                <th class="">Basic Salary</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($basic_salarys as $basic_salary) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$basic_salary->month_year}}</td>
                                                                                <td>{{$basic_salary->payslip_type}}</td>
                                                                                <td>{{$basic_salary->basic_salary}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-basic-salary/' . $basic_salary->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-basic-salary/' . $basic_salary->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab2" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-profile-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-Allowances">Add
                                                                        Allowance</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-Allowances" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-allowances/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Allowance</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Allowance
                                                                                                        Type</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Allowance
                                                                                                                Type</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="Taxable">
                                                                                                                Taxable
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Non-Taxable">
                                                                                                                Non-Taxable
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="allowance_type"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("allowance_type"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('allowance_type') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Allowance
                                                                                                        Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="allowance_title"
                                                                                                        value="">
                                                                                                    @if($errors->has("allowance_title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('allowance_title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->


                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Allowance
                                                                                                        Amount</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="allowance_amount"
                                                                                                        value="">
                                                                                                    @if($errors->has("allowance_amount"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('allowance_amount') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <!--end col-->

                                                                                            <!--end col-->
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Allowance Type</th>
                                                                                <th class="">Allowance Title</th>
                                                                                <th class="">Allowance Amount</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($allowances as $allowance) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$allowance->month_year}}</td>
                                                                                <td>{{$allowance->allowance_type}}</td>
                                                                                <td>{{$allowance->allowance_title}}</td>
                                                                                <td>{{$allowance->allowance_amount}}
                                                                                </td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-allowances/' . $allowance->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-allowances/' . $allowance->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab3" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-Commission">Add
                                                                        Commission</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-Commission" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-commissions/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Commission</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Commission
                                                                                                        Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="commission_title"
                                                                                                        value="">
                                                                                                    @if($errors->has("commission_title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('commission_title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Commission
                                                                                                        Amount</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="commission_amount"
                                                                                                        value="">
                                                                                                    @if($errors->has("commission_amount"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('commission_amount') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->



                                                                                            <!--end col-->
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Commission Title</th>
                                                                                <th class="">Commission Amount</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($commissions as $commission) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$commission->month_year}}</td>
                                                                                <td>{{$commission->commission_title}}
                                                                                </td>
                                                                                <td>{{$commission->commission_amount}}
                                                                                </td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-commissions/' . $commission->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-commissions/' . $commission->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab4" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-Loan">Add Loan</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-Loan" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-loan/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Loan</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Loan
                                                                                                        Option</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Loan
                                                                                                                Option</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="Social Security System Loan">
                                                                                                                Social
                                                                                                                Security
                                                                                                                System
                                                                                                                Loan
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Home Development Mututal Fund Loan">
                                                                                                                Home
                                                                                                                Development
                                                                                                                Mututal
                                                                                                                Fund
                                                                                                                Loan
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Other Loan">
                                                                                                                Other
                                                                                                                Loan
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="loan_option"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("loan_option"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('loan_option') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="title"
                                                                                                        value="">
                                                                                                    @if($errors->has("title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Amount</label>
                                                                                                    <input type="number"
                                                                                                        class="form-control"
                                                                                                        name="amount"
                                                                                                        value="">
                                                                                                    @if($errors->has("amount"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('amount') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Number
                                                                                                        of
                                                                                                        Installments</label>
                                                                                                    <input type="number"
                                                                                                        class="form-control"
                                                                                                        name="number_of_installments"
                                                                                                        value="">
                                                                                                    @if($errors->has("number_of_installments"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('number_of_installments') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Reason</label>
                                                                                                    <textarea
                                                                                                        class="form-control"
                                                                                                        name="reason"></textarea>
                                                                                                    @if($errors->has("reason"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('reason') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Loan Option</th>
                                                                                <th class="">Title</th>
                                                                                <th class="">Amount</th>
                                                                                <th class="">Number of Installments</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($loans as $loan) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$loan->month_year}}</td>
                                                                                <td>{{$loan->loan_option}}</td>
                                                                                <td>{{$loan->title}}</td>
                                                                                <td>{{$loan->amount}}</td>
                                                                                <td>{{$loan->number_of_installments}}
                                                                                </td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-loan/' . $loan->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-loan/' . $loan->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab5" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-Deductions">Add
                                                                        Deduction</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-Deductions" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-deduction/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Deduction</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Deduction
                                                                                                        Option</label>
                                                                                                    <div
                                                                                                        class="custom-select">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="select-button">
                                                                                                            <span
                                                                                                                class="selected-value">Select
                                                                                                                Deduction
                                                                                                                Option</span>
                                                                                                            <span
                                                                                                                class="arrow"><i
                                                                                                                    class="ri-arrow-down-s-line"></i></span>
                                                                                                        </button>
                                                                                                        <ul
                                                                                                            class="select-dropdown hidden">
                                                                                                            <li
                                                                                                                data-value="Social Security System">
                                                                                                                Social
                                                                                                                Security
                                                                                                                System
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Health insurance Coparation">
                                                                                                                Health
                                                                                                                insurance
                                                                                                                Coparation
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Home Develpment Mutual Funds">
                                                                                                                Home
                                                                                                                Develpment
                                                                                                                Mutual
                                                                                                                Funds
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Withdrowing Tax on Wages">
                                                                                                                Withdrowing
                                                                                                                Tax on
                                                                                                                Wages
                                                                                                            </li>
                                                                                                            <li
                                                                                                                data-value="Other Satuary Deductions">
                                                                                                                Other
                                                                                                                Satuary
                                                                                                                Deductions
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="deduction_option"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    @if($errors->has("deduction_option"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('deduction_option') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="title"
                                                                                                        value="">
                                                                                                    @if($errors->has("title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Amount</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="amount"
                                                                                                        value="">
                                                                                                    @if($errors->has("amount"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('amount') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end col-->

                                                                                            <!--end col-->
                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Deduction Option</th>
                                                                                <th class="">Title</th>
                                                                                <th class="">Amount</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($deductions as $deduction) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$deduction->month_year}}</td>
                                                                                <td>{{$deduction->deduction_option}}
                                                                                </td>
                                                                                <td>{{$deduction->title}}</td>
                                                                                <td>{{$deduction->amount}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-deduction/' . $deduction->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-deduction/' . $deduction->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab6" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-Other-Payment">Add Other
                                                                        Payment</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-Other-Payment"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-payment/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Other Payment</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="title"
                                                                                                        value="">
                                                                                                    @if($errors->has("title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Amount</label>
                                                                                                    <input type="number"
                                                                                                        class="form-control"
                                                                                                        name="amount"
                                                                                                        value="">
                                                                                                    @if($errors->has("amount"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('amount') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>



                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Title</th>
                                                                                <th class="">Amount</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($payments as $payment) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$payment->month_year}}</td>
                                                                                <td>{{$payment->title}}</td>
                                                                                <td>{{$payment->amount}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-payment/' . $payment->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-payment/' . $payment->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab7" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="button"
                                                                        class="mt-4 btn btn-theme-orange mb-4"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".add-Overtime">Add
                                                                        Overtime</button>
                                                                    <!--  Large modal example -->
                                                                    <div class="modal fade add-Overtime" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myLargeModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form method="POST"
                                                                                action="{{ url('add-overtime/' . $id) }}"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myLargeModalLabel">Add
                                                                                            Overtime</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Month
                                                                                                        Year</label>
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <input
                                                                                                            name="month_year"
                                                                                                            value=""
                                                                                                            type="text"
                                                                                                            class="form-control flatpickr-input active"
                                                                                                            data-provider="flatpickr"
                                                                                                            data-date-format="Y-m"
                                                                                                            readonly="readonly">
                                                                                                        <span
                                                                                                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                                                                            style="pointer-events: none;">
                                                                                                            <i
                                                                                                                class="ri-calendar-2-line"></i>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    @if($errors->has("month_year"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('month_year') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Title</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="title"
                                                                                                        value="">
                                                                                                    @if($errors->has("title"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('title') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Number
                                                                                                        of Days</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="no_of_days"
                                                                                                        value="">
                                                                                                    @if($errors->has("no_of_days"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('no_of_days') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Total
                                                                                                        Hours</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="total_hours"
                                                                                                        value="">
                                                                                                    @if($errors->has("total_hours"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('total_hours') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="firstNameinput"
                                                                                                        class="form-label">Rate</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="rate"
                                                                                                        value="">
                                                                                                    @if($errors->has("rate"))
                                                                                                        <div
                                                                                                            class="alert alert-danger mt-2">
                                                                                                            {{ $errors->first('rate') }}
                                                                                                            </li>
                                                                                                    </div>@endif
                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium shadow-none"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            Close</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-theme-orange ">Save
                                                                                            changes</button>
                                                                                    </div>

                                                                                </div><!-- /.modal-content -->
                                                                            </form>
                                                                        </div><!-- /.modal-dialog -->
                                                                    </div><!-- /.modal -->
                                                                    <table id="buttons-datatables"
                                                                        class="display table table-bordered"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="">Month/Year</th>
                                                                                <th class="">Title</th>
                                                                                <th class="">No of Days</th>
                                                                                <th class="">Total Hours</th>
                                                                                <th class="">Rate</th>
                                                                                <th class=""> Action </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($overtimes as $overtime) {
                                    ?>
                                                                            <tr class="odd gradeX">
                                                                                <td>{{$overtime->month_year}}</td>
                                                                                <td>{{$overtime->title}}</td>
                                                                                <td>{{$overtime->no_of_days}}</td>
                                                                                <td>{{$overtime->total_hours}}</td>
                                                                                <td>{{$overtime->rate}}</td>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('edit-overtime/' . $overtime->id) }}">
                                                                                        <i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{ url('delete-overtime/' . $overtime->id) }}">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end tab-pane-->
                                                        <div class="tab-pane fade" id="stab8" role="tabpanel"
                                                            aria-labelledby="custom-v-pills-messages-tab">
                                                            <form method="POST" action="{{ url('add-pension/' . $id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <?php
if ($pensions == null || $pensions->isEmpty()) {
    $pansion_type = null;
    $amount = "";
} else {
    foreach ($pensions as $pansion) {
        $pansion_type = $pansion->pansion_type;
        $amount = $pansion->amount;
    }
}

                    ?>
                                                                <div class="row">

                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Pansion Type</label>
                                                                            <div class="custom-select">
                                                                                <button type="button"
                                                                                    class="select-button">
                                                                                    <span
                                                                                        class="selected-value">{{ $pansion_type ?: 'Select Pansion Type' }}</span>
                                                                                    <span class="arrow"><i
                                                                                            class="ri-arrow-down-s-line"></i></span>
                                                                                </button>
                                                                                <ul class="select-dropdown hidden">
                                                                                    <li data-value="Fixed">Fixed</li>
                                                                                    <li data-value="Presentage">
                                                                                        Presentage</li>
                                                                                </ul>
                                                                                <input type="hidden" name="pansion_type"
                                                                                    value="{{ $pansion_type }}">
                                                                            </div>
                                                                            @if($errors->has("pansion_type"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('pansion_type') }}
                                                                                    </li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Amount</label>
                                                                            <input type="text" class="form-control"
                                                                                name="amount" value="{{$amount }}">
                                                                            @if($errors->has("amount"))
                                                                                <div class="alert alert-danger mt-2">
                                                                                    {{ $errors->first('amount') }}</li>
                                                                            </div>@endif
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <button type="submit" class="btn btn-theme-orange">Save
                                                                    Changes</button>
                                                            </form>
                                                        </div>
                                                        <!--end tab-pane-->
                                                    </div>
                                                </div> <!-- end col-->
                                            </div> <!-- end row-->
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <div class="tab-pane" id="tab4" role="tabpanel">
                                        <table id="buttons-datatables" class="display table table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="center">Leave Type</th>
                                                    <th class="center">Department</th>
                                                    <th class="center">Employee</th>
                                                    <th class="center">Leave Duration</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($leaves as $leave) {
    $employee_name = OtherEmployeeDetails::where('user_id', $leave->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $leave->employee)->value('last_name');
    $department_name = OrganizationDepartments::where('id', $leave->department)->value('department');
    if ($leave->leave_type == "special") {
        $leave_type_name = "special";
    } else {
        $leave_type_name = LeaveTypes::where('id', $leave->leave_type)->value('leave_type');
    }
                                   ?>
                                                <tr class="odd gradeX">
                                                    <td class="">{{$leave_type_name}} </td>
                                                    <td class="">{{$department_name}} </td>
                                                    <td class="">{{$employee_name}} </td>
                                                    <td class="">{{$leave->leave_duration}} </td>
                                                    <td class="">{{$leave->status}} </td>
                                                    <td>
                                                        <a href="{{ url('view-leave/' . $leave->id) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab5" role="tabpanel">
                                        <a href="{{ url('download-pay-slip/' . $id) }}">
                                            <button type="button" class="btn btn-theme-orange  ">
                                                Download
                                            </button>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <!--end col-->


                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('layouts.footer')
    <script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize Custom Dropdowns
            // ensure any logic that needs to run after dropdown setup goes here

            // Initialize Flatpickr manually if not working via data-attributes
            flatpickr(".flatpickr-input", {
                dateFormat: "n/j/Y",
                allowInput: true
            });
        });
    </script>