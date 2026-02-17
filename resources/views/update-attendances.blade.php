<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OrganizationLocations;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
?>
@include('layouts.header')
<!-- Custom Styles -->
<link href="{{ asset('assets/css/custom-dropdown.css') }}" rel="stylesheet" type="text/css" />
<style>
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
                        <h4 class="mb-sm-0 dashboard-title">Update Attendance</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Update Attendance</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xxl-12 px-0">
                    <div class="card card-theme shadow-none rounded-3 border-0" style="overflow: visible !important;">
                        <div class="card-header border-0 bg-white p-4">
                            <h4 class="card-title mb-0 dashboard-title">Update Attendance</h4>
                        </div><!-- end card header -->

                        <div class="card-body p-4 pt-0" style="overflow: visible !important;">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    <button type="button" class="btn btn-theme-orange" onclick="GetDetails()">Get
                                        Details</button>
                                </div>
                                @if(Session::has('success'))
                                <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                <div class="live-preview">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="date"
                                                    class="form-label text-[#556476] font-medium">Date</label>
                                                <div class="position-relative">
                                                    <input name="date" id="date" value="{{ date('n/j/Y') }}" type="text"
                                                        class="form-control flatpickr-input active"
                                                        data-provider="flatpickr" data-date-format="n/j/Y"
                                                        readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;"><i
                                                            class="ri-calendar-2-line"></i></span>
                                                </div>
                                                @if($errors->has("date"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="user"
                                                    class="form-label text-[#556476] font-medium">User</label>
                                                <div class="custom-select">
                                                    <button type="button" class="select-button">
                                                        <span class="selected-value">Select User</span>
                                                        <span class="arrow"><i class="ri-arrow-down-s-line"></i></span>
                                                    </button>
                                                    <ul class="select-dropdown hidden">
                                                        <?php if (Auth::user()->user_role == 1) { ?>
                                                        <?php    foreach ($employees as $employee) { ?>
                                                        <li data-value="{{$employee->id}}">
                                                            <?php        echo OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name') . ' (Employee)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($hods as $hod) { ?>
                                                        <li data-value="{{$hod->id}}">
                                                            <?php        echo OtherHODDetails::where('user_id', $hod->id)->value('name') . ' (HOD)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($hrms as $hrm) { ?>
                                                        <li data-value="{{$hrm->id}}">
                                                            <?php        echo OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name') . ' (HRM)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($authorisers as $authoriser) { ?>
                                                        <li data-value="{{$authoriser->id}}">
                                                            <?php        echo OtherAuthoriserDetails::where('user_id', $authoriser->id)->value('name') . ' (Authoriser)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php } ?>

                                                        <?php if (Auth::user()->user_role == 2) { ?>
                                                        <?php    foreach ($employees as $employee) { ?>
                                                        <li data-value="{{$employee->id}}">
                                                            <?php        echo OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name') . ' (Employee)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($hods as $hod) { ?>
                                                        <li data-value="{{$hod->id}}">
                                                            <?php        echo OtherHODDetails::where('user_id', $hod->id)->value('name') . ' (HOD)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($hrms as $hrm) { ?>
                                                        <li data-value="{{$hrm->id}}">
                                                            <?php        echo OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name') . ' (HRM)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($authorisers as $authoriser) { ?>
                                                        <li data-value="{{$authoriser->id}}">
                                                            <?php        echo OtherAuthoriserDetails::where('user_id', $authoriser->id)->value('name') . ' (Authoriser)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php } ?>

                                                        <?php if (Auth::user()->user_role == 5) { ?>
                                                        <?php    foreach ($employees as $employee) { ?>
                                                        <li data-value="{{$employee->id}}">
                                                            <?php        echo OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name') . ' (Employee)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php    foreach ($authorisers as $authoriser) { ?>
                                                        <li data-value="{{$authoriser->id}}">
                                                            <?php        echo OtherAuthoriserDetails::where('user_id', $authoriser->id)->value('name') . ' (Authoriser)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php } ?>

                                                        <?php if (Auth::user()->user_role == 6) { ?>
                                                        <?php    foreach ($employees as $employee) { ?>
                                                        <li data-value="{{$employee->id}}">
                                                            <?php        echo OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name') . ' (Employee)' ?>
                                                        </li>
                                                        <?php    } ?>
                                                        <?php } ?>
                                                    </ul>
                                                    <input type="hidden" name="user" id="user">
                                                </div>
                                                @if($errors->has("user"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('user') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                            </form>

                            <div class="col-sm-12" id="add_attendence_section" style="display:none">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="attendance_date"
                                                class="form-label text-[#556476] font-medium">Attendance Date</label>
                                            <div class="position-relative">
                                                <input name="attendance_date" value="" type="text"
                                                    class="form-control flatpickr-input active"
                                                    data-provider="flatpickr" data-date-format="n/j/Y"
                                                    readonly="readonly">
                                                <span
                                                    class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                    style="pointer-events: none;"><i
                                                        class="ri-calendar-2-line"></i></span>
                                            </div>
                                            @if($errors->has("attendance_date"))
                                                <div class="alert alert-danger mt-2">{{ $errors->first('attendance_date') }}
                                            </div>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label text-[#556476] font-medium">Check In</label>
                                                <div class="position-relative">
                                                    <input type="text" name="check_in" value=""
                                                        class="form-control timepicker-input" data-provider="timepickr"
                                                        data-time-basic="true" placeholder="Select time"
                                                        readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;"><i
                                                            class="ri-time-line"></i></span>
                                                </div>
                                                @if($errors->has("check_in"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('check_in') }}
                                                </div>@endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label text-[#556476] font-medium">Check Out</label>
                                                <div class="position-relative">
                                                    <input type="text" name="check_out" value=""
                                                        class="form-control timepicker-input" data-provider="timepickr"
                                                        data-time-basic="true" placeholder="Select time"
                                                        readonly="readonly">
                                                    <span
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                                                        style="pointer-events: none;"><i
                                                            class="ri-time-line"></i></span>
                                                </div>
                                                @if($errors->has("check_out"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('check_out') }}
                                                </div>@endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-theme-orange mt-4"
                                            onclick="AddAttendance()">Add Attendance</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-theme shadow-none rounded-3 border-0">
                        <div class="card-header border-0 bg-white p-3">
                            <h5 class="card-title mb-0 dashboard-title">Attendance Details</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables" class="display table konnect-table mb-0 attendence_table"
                                    style="width:100%">
                                    <tbody>
                                        <!-- Content loaded via AJAX -->
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
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/custom-dropdown.js') }}"></script>
<script>
    flatpickr(".flatpickr-input", {
        dateFormat: "n/j/Y",
    });

    flatpickr(".timepicker-input", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    flatpickr(".flatpickr-input", {
        dateFormat: "n/j/Y",
    });

    flatpickr(".timepicker-input", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    function GetDetails() {
        var user_id = document.getElementById("user").value; // Updated to get value from hidden input

        if (user_id == "") {
            alert("Please select a user");
            return false;
        } else {
            document.getElementById("add_attendence_section").style.display = "block";
            var date = document.getElementById("date").value;
            var url = '{{ url('get-attendence-details') }}';
            //Perform Ajax request.
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id: user_id,
                    date: date
                },
                success: function (html) {
                    $('.attendence_table').html(html);
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }
    }

    function AddAttendance() {
        var attendance_date = document.getElementsByName("attendance_date")[0].value;
        var check_in = document.getElementsByName("check_in")[0].value;
        var check_out = document.getElementsByName("check_out")[0].value;
        var user_id = document.getElementById("user").value; // Updated

        console.log(attendance_date);
        if (user_id == "") {
            alert("Please select a user");
            return false;
        }
        if (attendance_date == "") {
            alert("Please select a attendance date");
            return false;
        }
        if (check_in == "") {
            alert("Please select a check in time");
            return false;
        }
        if (check_out == "") {
            alert("Please select a check out time");
            return false;
        }

        // document.getElementById("add_attendence_section").style.display = "block"; // This seems redundant as it's already visible

        var url = '{{ url('add-attendence-details') }}';
        //Perform Ajax request.
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                user_id: user_id,
                attendance_date: attendance_date,
                check_in: check_in,
                check_out: check_out,
            },
            success: function (html) {
                GetDetails();
            },
            error: function (error) {
                console.log(error)
            }
        });
    }
</script>