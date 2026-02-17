@include('layouts.header')
<?php
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\OtherHODDetails;
use App\Models\UserCheckInOutData;
use Carbon\Carbon;
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">HRM</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">




                <div class="col-xxl-8">
                    <div class="col-xl-12">
                        <div class="card card-theme crm-widget">
                            <div class="card-body p-0">
                                <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                                    <div class="col">
                                        <div class="py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of Employees</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-group-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_emp}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-md-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of HOD</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-user-settings-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_hod}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-md-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of HRM</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-user-star-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_hrm}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of Clients</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-user-heart-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{ $no_of_client}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of Projects</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-suitcase-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_projects}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of Tasks</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-shield-star-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_tasks}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of Departments</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-passport-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_departments}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of Locations</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-map-pin-2-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_locations}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">No of active job posts</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="widget-icon-wrapper">
                                                    <i class="ri-checkbox-fill"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h2 class="mb-0"><span class="counter-value"
                                                            data-target="{{$no_of_jobs}}">0</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->

                                </div><!-- end row -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end col -->

                <div class="col-xxl-4 col-md-4">
                    <?php
$check_in_out_data = UserCheckInOutData::where('user_id', Auth::user()->id)->where('year_month_date', date("Y-m-d"))->orderBy('id', 'DESC')->first();
if ($check_in_out_data == null || $check_in_out_data->check_in_or_out == "check out") {
?>
                    <div class="card card-theme">
                        <div class="card-header text-center">

                            <h6 class="card-title mb-0">Submit Check-In Time</h6>
                        </div>
                        <div class="card-body p-4 text-center">
                            <div class="mx-auto avatar-md mb-3">
                                <i class="bx bx-time-five text-primary-orange" style="font-size: 70px;"></i>
                            </div>
                            <form method="POST" action="{{ url('user-add-check-in-time') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn-theme-orange w-100">
                                    Submit Check In Time
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="card card-theme">
                        <div class="card-header text-center">

                            <h6 class="card-title mb-0">Submit Check-Out Time</h6>
                        </div>
                        <div class="card-body p-4 text-center">
                            <div class="mx-auto avatar-md mb-3">
                                <i class="bx bx-time-five text-primary-orange" style="font-size: 70px;"></i>
                            </div>
                            <form method="POST" action="{{ url('user-add-check-out-time') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn-theme-orange w-100">
                                    Submit Check Out Time
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">


                <div class="col-xxl-6">
                    <div class="card card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Birthdays & Anniversaries</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0 table-theme">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 30%;">ID</th>
                                            <th scope="col" style="width: 30%;">Name</th>
                                            <th scope="col" style="width: 20%;">Phone</th>
                                            <th scope="col" style="width: 20%;">Gender</th>
                                            <th scope="col" style="width: 20%;">Appointment Date</th>
                                            <th scope="col" style="width: 20%;">Birthdays or Anniversary</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php $employee_details_b = OtherEmployeeDetails::get();
foreach ($employee_details_b as $employee_b) {
    $currentMD = date("m/j/Y");
    $currentMD = date('m-j', strtotime($currentMD));
    $birthMD = date('m-j', strtotime($employee_b->dob));
    $annverMD = date('m-j', strtotime($employee_b->appoinment_date));
    if ($birthMD == $currentMD) { ?>
                                        <tr>
                                            <td>{{$employee_b->user_id}}</td>
                                            <td>{{$employee_b->first_name . ' ' . $employee_b->last_name}}</td>
                                            <td>{{$employee_b->phone}}</td>
                                            <td>{{$employee_b->gender}}</td>
                                            <td>{{$employee_b->appoinment_date}}</td>
                                            <td><span class="label label-success">BIRTHDAY</span></td>
                                        </tr>
                                        <?php    }
    if ($annverMD == $currentMD) { ?>
                                        <tr>
                                            <td>{{$employee_b->user_id}}</td>
                                            <td>{{$employee_b->first_name . ' ' . $employee_b->last_name}}</td>
                                            <td>{{$employee_b->phone}}</td>
                                            <td>{{$employee_b->gender}}</td>
                                            <td>{{$employee_b->appoinment_date}}</td>
                                            <td><span class="label label-info">ANNIVERSARY</span></td>
                                        </tr>
                                        <?php    }
}
                                        ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <!--<div class="col-xxl-6">-->
                <!--    <div class="card card-height-100">-->
                <!--        <div class="card-header align-items-center d-flex">-->
                <!--            <h4 class="card-title mb-0 flex-grow-1">Security Warnings</h4>-->

                <!--        </div>-->

                <!--        <div class="card-body">-->
                <!--            <div class="table-responsive">-->
                <!--                <table class="table table-bordered table-nowrap align-middle mb-0">-->
                <!--                    <thead>-->
                <!--                        <tr>-->
                <!--                            <th scope="col" style="width: 30%;">ID</th>-->
                <!--                            <th scope="col" style="width: 30%;">Name</th>-->
                <!--                            <th scope="col" style="width: 20%;">Phone</th>-->
                <!--                            <th scope="col" style="width: 20%;">Gender</th>-->
                <!--                            <th scope="col" style="width: 20%;">Appointment Date</th>-->
                <!--                            <th scope="col" style="width: 20%;">Birthdays or Anniversary</th>-->
                <!--                        </tr>-->
                <!--                    </thead>-->

                <!--                    <tbody>-->


                <!--                    </tbody>-->
                <!--                </table>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="col-xxl-6">
                    <div class="card card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Logins</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0 table-theme">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 30%;">ID</th>
                                            <th scope="col" style="width: 30%;">Name</th>
                                            <th scope="col" style="width: 20%;">User Name</th>
                                            <th scope="col" style="width: 20%;">Email</th>
                                            <th scope="col" style="width: 20%;">Last Login</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
if ($recent_logins == null || $recent_logins->isEmpty()) { ?>
                                        <tr>
                                            <td colspan="5">No Details Available</td>
                                        </tr>
                                        <?php } else {
    foreach ($recent_logins as $recent_login) {
        if ($recent_login->user_role == 1) {
            $name = OtherAdminDetails::where('user_id', $recent_login->id)->value('first_name') . ' ' . OtherAdminDetails::where('user_id', $recent_login->id)->value('last_name');
        }
        if ($recent_login->user_role == 2) {
            $name = OtherHRManagerDetails::where('user_id', $recent_login->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $recent_login->id)->value('last_name');
        }
        if ($recent_login->user_role == 3) {
            $name = OtherEmployeeDetails::where('user_id', $recent_login->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $recent_login->id)->value('last_name');
        }
        if ($recent_login->user_role == 4) {
            $name = OtherClientDetails::where('user_id', $recent_login->id)->value('first_name') . ' ' . OtherClientDetails::where('user_id', $recent_login->id)->value('last_name');
        }
        if ($recent_login->user_role == 5) {
            $name = OtherHODDetails::where('user_id', $recent_login->id)->value('name');
        }
                                        ?>
                                        <tr>
                                            <td>{{$recent_login->id}}</td>
                                            <td>{{$name}}</td>
                                            <td>{{$recent_login->user_name}}</td>
                                            <td>{{$recent_login->email}}</td>
                                            <td>{{$recent_login->last_login}}</td>
                                        </tr>
                                        <?php    }
}?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Blocked IP's</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0 table-theme">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 30%;">IP</th>
                                            <th scope="col" style="width: 30%;">Blocked Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
if ($recent_blocked_ips == null || $recent_blocked_ips->isEmpty()) { ?>
                                        <tr>
                                            <td colspan="2">No Details Available</td>
                                        </tr>
                                        <?php } else {
    foreach ($recent_blocked_ips as $recent_blocked_ip) {
                                        ?>
                                        <tr>
                                            <td>{{$recent_blocked_ip->ip}}</td>
                                            <td>{{$recent_blocked_ip->created_at}}</td>
                                        </tr>
                                        <?php    }
} ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Locked users</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0 table-theme">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 30%;">ID</th>
                                            <th scope="col" style="width: 30%;">Name</th>
                                            <th scope="col" style="width: 30%;">User Name</th>
                                            <th scope="col" style="width: 30%;">Email</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
if ($recent_blocked_users == null || $recent_blocked_users->isEmpty()) { ?>
                                        <tr>
                                            <td colspan="4">No Details Available</td>
                                        </tr>
                                        <?php } else {
    foreach ($recent_blocked_users as $recent_blocked_user) {
        if ($recent_blocked_user->user_role == 1) {
            $name = OtherAdminDetails::where('user_id', $recent_blocked_user->id)->value('first_name') . ' ' . OtherAdminDetails::where('user_id', $recent_blocked_user->id)->value('last_name');
        }
        if ($recent_blocked_user->user_role == 2) {
            $name = OtherHRManagerDetails::where('user_id', $recent_blocked_user->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $recent_blocked_user->id)->value('last_name');
        }
        if ($recent_blocked_user->user_role == 3) {
            $name = OtherEmployeeDetails::where('user_id', $recent_blocked_user->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $recent_blocked_user->id)->value('last_name');
        }
        if ($recent_blocked_user->user_role == 4) {
            $name = OtherClientDetails::where('user_id', $recent_blocked_user->id)->value('first_name') . ' ' . OtherClientDetails::where('user_id', $recent_blocked_user->id)->value('last_name');
        }
        if ($recent_blocked_user->user_role == 5) {
            $name = OtherHODDetails::where('user_id', $recent_blocked_user->id)->value('name');
        }
                                        ?>
                                        <tr>
                                            <td>{{$recent_blocked_user->id}}</td>
                                            <td>{{$name}}</td>
                                            <td>{{$recent_blocked_user->user_name}}</td>
                                            <td>{{$recent_blocked_user->email}}</td>
                                        </tr>
                                        <?php    }
} ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->


            </div><!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('layouts.footer')
    <script>
        //check the console for date click event
        //Fixed day highlight
        //Added previous month and next month view

        function CalendarControl() {
            const calendar = new Date();
            const calendarControl = {
                localDate: new Date(),
                prevMonthLastDate: null,
                calWeekDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                calMonthName: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec"
                ],
                daysInMonth: function (month, year) {
                    return new Date(year, month, 0).getDate();
                },
                firstDay: function () {
                    return new Date(calendar.getFullYear(), calendar.getMonth(), 1);
                },
                lastDay: function () {
                    return new Date(calendar.getFullYear(), calendar.getMonth() + 1, 0);
                },
                firstDayNumber: function () {
                    return calendarControl.firstDay().getDay() + 1;
                },
                lastDayNumber: function () {
                    return calendarControl.lastDay().getDay() + 1;
                },
                getPreviousMonthLastDate: function () {
                    let lastDate = new Date(
                        calendar.getFullYear(),
                        calendar.getMonth(),
                        0
                    ).getDate();
                    return lastDate;
                },
                navigateToPreviousMonth: function () {
                    calendar.setMonth(calendar.getMonth() - 1);
                    calendarControl.attachEventsOnNextPrev();
                },
                navigateToNextMonth: function () {
                    calendar.setMonth(calendar.getMonth() + 1);
                    calendarControl.attachEventsOnNextPrev();
                },
                navigateToCurrentMonth: function () {
                    let currentMonth = calendarControl.localDate.getMonth();
                    let currentYear = calendarControl.localDate.getFullYear();
                    calendar.setMonth(currentMonth);
                    calendar.setYear(currentYear);
                    calendarControl.attachEventsOnNextPrev();
                },
                displayYear: function () {
                    let yearLabel = document.querySelector(".calendar .calendar-year-label");
                    yearLabel.innerHTML = calendar.getFullYear();
                },
                displayMonth: function () {
                    let monthLabel = document.querySelector(
                        ".calendar .calendar-month-label"
                    );
                    monthLabel.innerHTML = calendarControl.calMonthName[calendar.getMonth()];
                },
                selectDate: function (e) {
                    console.log(
                        `${e.target.textContent} ${calendarControl.calMonthName[calendar.getMonth()]
                        } ${calendar.getFullYear()}`
                    );
                },
                plotSelectors: function () {
                    document.querySelector(
                        ".calendar"
                    ).innerHTML += `<div class="calendar-inner"><div class="calendar-controls">
          <div class="calendar-prev"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M88.2 3.8L35.8 56.23 28 64l7.8 7.78 52.4 52.4 9.78-7.76L45.58 64l52.4-52.4z"/></svg></a></div>
          <div class="calendar-year-month">
          <div class="calendar-month-label"></div>
          <div>-</div>
          <div class="calendar-year-label"></div>
          </div>
          <div class="calendar-next"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M38.8 124.2l52.4-52.42L99 64l-7.77-7.78-52.4-52.4-9.8 7.77L81.44 64 29 116.42z"/></svg></a></div>
          </div>
          <div class="calendar-today-date">Today:
            ${calendarControl.calWeekDays[calendarControl.localDate.getDay()]},
            ${calendarControl.localDate.getDate()},
            ${calendarControl.calMonthName[calendarControl.localDate.getMonth()]}
            ${calendarControl.localDate.getFullYear()}
          </div>
          <div class="calendar-body"></div></div>`;
                },
                plotDayNames: function () {
                    for (let i = 0; i < calendarControl.calWeekDays.length; i++) {
                        document.querySelector(
                            ".calendar .calendar-body"
                        ).innerHTML += `<div>${calendarControl.calWeekDays[i]}</div>`;
                    }
                },
                plotDates: function () {
                    document.querySelector(".calendar .calendar-body").innerHTML = "";
                    calendarControl.plotDayNames();
                    calendarControl.displayMonth();
                    calendarControl.displayYear();
                    let count = 1;
                    let prevDateCount = 0;

                    calendarControl.prevMonthLastDate = calendarControl.getPreviousMonthLastDate();
                    let prevMonthDatesArray = [];
                    let calendarDays = calendarControl.daysInMonth(
                        calendar.getMonth() + 1,
                        calendar.getFullYear()
                    );
                    // dates of current month
                    for (let i = 1; i < calendarDays; i++) {
                        if (i < calendarControl.firstDayNumber()) {
                            prevDateCount += 1;
                            document.querySelector(
                                ".calendar .calendar-body"
                            ).innerHTML += `<div class="prev-dates"></div>`;
                            prevMonthDatesArray.push(calendarControl.prevMonthLastDate--);
                        } else {
                            document.querySelector(
                                ".calendar .calendar-body"
                            ).innerHTML += `<div class="number-item" data-num=${count} onclick="CheckHolidays(this);"><a class="dateNumber" href="#"  >${count++}</a></div>`;
                        }
                    }
                    //remaining dates after month dates
                    for (let j = 0; j < prevDateCount + 1; j++) {
                        document.querySelector(
                            ".calendar .calendar-body"
                        ).innerHTML += `<div class="number-item" data-num=${count} onclick="CheckHolidays(this);"><a class="dateNumber" href="#">${count++}</a></div>`;
                    }
                    calendarControl.highlightToday();
                    calendarControl.plotPrevMonthDates(prevMonthDatesArray);
                    calendarControl.plotNextMonthDates();
                },
                attachEvents: function () {
                    let prevBtn = document.querySelector(".calendar .calendar-prev a");
                    let nextBtn = document.querySelector(".calendar .calendar-next a");
                    let todayDate = document.querySelector(".calendar .calendar-today-date");
                    let dateNumber = document.querySelectorAll(".calendar .dateNumber");
                    prevBtn.addEventListener(
                        "click",
                        calendarControl.navigateToPreviousMonth
                    );
                    nextBtn.addEventListener("click", calendarControl.navigateToNextMonth);
                    todayDate.addEventListener(
                        "click",
                        calendarControl.navigateToCurrentMonth
                    );
                    for (var i = 0; i < dateNumber.length; i++) {
                        dateNumber[i].addEventListener(
                            "click",
                            calendarControl.selectDate,
                            false
                        );
                    }
                },
                highlightToday: function () {
                    let currentMonth = calendarControl.localDate.getMonth() + 1;
                    let changedMonth = calendar.getMonth() + 1;
                    let currentYear = calendarControl.localDate.getFullYear();
                    let changedYear = calendar.getFullYear();
                    if (
                        currentYear === changedYear &&
                        currentMonth === changedMonth &&
                        document.querySelectorAll(".number-item")
                    ) {
                        document
                            .querySelectorAll(".number-item")
                        [calendar.getDate() - 1].classList.add("calendar-today");
                    }
                },
                plotPrevMonthDates: function (dates) {
                    dates.reverse();
                    for (let i = 0; i < dates.length; i++) {
                        if (document.querySelectorAll(".prev-dates")) {
                            document.querySelectorAll(".prev-dates")[i].textContent = dates[i];
                        }
                    }
                },
                plotNextMonthDates: function () {
                    let childElemCount = document.querySelector('.calendar-body').childElementCount;
                    //7 lines
                    if (childElemCount > 42) {
                        let diff = 49 - childElemCount;
                        calendarControl.loopThroughNextDays(diff);
                    }

                    //6 lines
                    if (childElemCount > 35 && childElemCount <= 42) {
                        let diff = 42 - childElemCount;
                        calendarControl.loopThroughNextDays(42 - childElemCount);
                    }

                },
                loopThroughNextDays: function (count) {
                    if (count > 0) {
                        for (let i = 1; i <= count; i++) {
                            document.querySelector('.calendar-body').innerHTML += `<div class="next-dates">${i}</div>`;
                        }
                    }
                },
                attachEventsOnNextPrev: function () {
                    calendarControl.plotDates();
                    calendarControl.attachEvents();
                },
                init: function () {
                    calendarControl.plotSelectors();
                    calendarControl.plotDates();
                    calendarControl.attachEvents();
                }
            };
            calendarControl.init();
        }

        const calendarControl = new CalendarControl();

    </script>


    <script type="text/javascript">
        function CheckHolidays(day) {
            var day_no = day.getAttribute("data-num")
            var holiday_name = document.getElementById("holiday_name" + day_no).value;
            var holiday_discription = document.getElementById("holiday_discription" + day_no).value;
            swal({
                title: holiday_name,
                text: holiday_discription,
            });
        }
    </script>

    <script>
        showPosition();
        function showPosition() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";

                    let spotCoordinates1 = [position.coords.latitude, position.coords.longitude];

                    let center = { lat: 41.536558, lng: -8.627487 };
                    let radius = 25

                    checkIfInside(spotCoordinates1);

                    function checkIfInside(spotCoordinates) {

                        let newRadius = distanceInKmBetweenEarthCoordinates(spotCoordinates[0], center.lat, center.lng);
                        console.log(newRadius)

                        if (newRadius < radius) {
                            //point is inside the circle
                            console.log('inside')
                        }
                        else if (newRadius > radius) {
                            //point is outside the circle
                            console.log('outside')
                        }
                        else {
                            //point is on the circle
                            console.log('on the circle')
                        }

                    }
                });
            } else {
                alert("Sorry, your browser does not support HTML5 geolocation.");
            }


        }
    </script>