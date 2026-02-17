@include('layouts.header')
<?php
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\OtherHODDetails;
use App\Models\OrganizationDepartments;
use App\Models\PMProjectsEmployees;
use App\Models\PMProjects;
use App\Models\PMTaskUsers;
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingListEmployees;
use App\Models\UserCheckInOutData;
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
                                <li class="breadcrumb-item active">HOD</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">




                <!--<div class="col-xxl-8">-->
                <!--    <div class="card card-height-100">-->
                <!--        <div class="card-header align-items-center d-flex">-->
                <!--            <h4 class="card-title mb-0 flex-grow-1">Balance Overview</h4>-->
                <!--            <div class="flex-shrink-0">-->
                <!--                <div class="dropdown card-header-dropdown">-->
                <!--                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                <!--                        <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Year<i class="mdi mdi-chevron-down ms-1"></i></span>-->
                <!--                    </a>-->
                <!--                    <div class="dropdown-menu dropdown-menu-end">-->
                <!--                        <a class="dropdown-item" href="#">Today</a>-->
                <!--                        <a class="dropdown-item" href="#">Last Week</a>-->
                <!--                        <a class="dropdown-item" href="#">Last Month</a>-->
                <!--                        <a class="dropdown-item" href="#">Current Year</a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="card-body px-0">-->
                <!--            <ul class="list-inline main-chart text-center mb-0">-->
                <!--                <li class="list-inline-item chart-border-left me-0 border-0">-->
                <!--                    <h4 class="text-primary">$584k <span class="text-muted d-inline-block fs-13 align-middle ms-2">Revenue</span></h4>-->
                <!--                </li>-->
                <!--                <li class="list-inline-item chart-border-left me-0">-->
                <!--                    <h4>$497k<span class="text-muted d-inline-block fs-13 align-middle ms-2">Expenses</span>-->
                <!--                    </h4>-->
                <!--                </li>-->
                <!--                <li class="list-inline-item chart-border-left me-0">-->
                <!--                    <h4><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block fs-13 align-middle ms-2">Profit Ratio</span></h4>-->
                <!--                </li>-->
                <!--            </ul>-->

                <!--            <div id="revenue-expenses-charts" data-colors='["--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="col-xxl-4 col-md-4">
                    <?php
$check_in_out_data = UserCheckInOutData::where('user_id', Auth::user()->id)->where('year_month_date', date("Y-m-d"))->orderBy('id', 'DESC')->first();
if ($check_in_out_data == null || $check_in_out_data->check_in_or_out == "check out") {
?>
                    <div class="card-theme">
                        <div class="card-header text-center">

                            <h6 class="card-title mb-0">Submit Check-In Time</h6>
                        </div>
                        <div class="card-body p-4 text-center">
                            <div class="mx-auto avatar-md mb-3">
                                <i class="bx bx-time-five text-primary-orange" style="font-size: 70px;"></i>
                            </div>
                            <p class="text-muted mb-4">Click below button to check-in for today.</p>
                            <form action="{{url('check-in-employee')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <button type="submit" class="btn-theme-orange w-100">Check-In</button>
                            </form>
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="card-theme">
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
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Birthdays & Anniversaries</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
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

                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Promotions</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Promotion Date</th>
                                            <th>Discription</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($promotions as $promotion) {

                                                ?>
                                        <tr>
                                            <td>{{$promotion->title}}</td>
                                            <td>{{$promotion->promotion_date}}</td>
                                            <td>{{$promotion->discription}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xxl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Awards</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Award Type</th>
                                            <th>Gift</th>
                                            <th>Cash</th>
                                            <th>Award Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($awards as $award) {
    $award_department = OrganizationDepartments::where('id', $award->department)->value('department');
                                    ?>
                                        <tr>
                                            <td>{{$award_department}}</td>
                                            <td>{{$award->award_type}}</td>
                                            <td>{{$award->gift}}</td>
                                            <td>{{$award->cash}}</td>
                                            <td>{{$award->award_date}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Travels</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Arrangment Type</th>
                                            <th>Visit Purpose</th>
                                            <th>Visit Place</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($travels as $travel) {
                                    ?>
                                        <tr>
                                            <td>{{$travel->arrangment_type}}</td>
                                            <td>{{$travel->visit_purpose}}</td>
                                            <td>{{$travel->visit_place}}</td>
                                            <td>{{$travel->start_date}}</td>
                                            <td>{{$travel->end_date}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Transfers</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>From Department</th>
                                            <th>To Department</th>
                                            <th>Transfer Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <tbody>
                                        <?php foreach ($transfers as $transfer) {
    $tr_from_department = OrganizationDepartments::where('id', $transfer->from_department)->value('department');
    $tr_to_department = OrganizationDepartments::where('id', $transfer->to_department)->value('department');
                                    ?>
                                        <tr>
                                            <td>{{$tr_from_department}}</td>
                                            <td>{{$tr_to_department}}</td>
                                            <td>{{$transfer->transfer_date}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xxl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Resignations</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Notice Date</th>
                                            <th>Resignation Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <tbody>
                                        <?php foreach ($resignations as $resignation) {
    $res_department = OrganizationDepartments::where('id', $resignation->department)->value('department');

                                    ?>
                                        <tr>
                                            <td>{{$res_department}}</td>
                                            <td>{{$resignation->notice_date}}</td>
                                            <td>{{$resignation->resignation_date}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xxl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Complaints</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Complaint From</th>
                                            <th>Complaint Against</th>
                                            <th>Complaint Title</th>
                                            <th>Complaint Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <tbody>
                                        <?php foreach ($coreHRComplaints as $coreHRComplaint) {
    $com_from_emp = OtherEmployeeDetails::where('user_id', $coreHRComplaint->complaint_from)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $coreHRComplaint->complaint_from)->value('last_name');
    $com_to_emp = OtherEmployeeDetails::where('user_id', $coreHRComplaint->complaint_against)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $coreHRComplaint->complaint_from)->value('last_name');
                                    ?>
                                        <tr>
                                            <td>{{$com_from_emp}}</td>
                                            <td>{{$com_to_emp}}</td>
                                            <td>{{$coreHRComplaint->complaint_title}}</td>
                                            <td>{{$coreHRComplaint->complaint_date}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Warnings</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Warning Type</th>
                                            <th>Subject</th>
                                            <th>Warning Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($warnings as $warning) {
                                    ?>
                                        <tr>
                                            <td>{{$warning->warning_type}}</td>
                                            <td>{{$warning->subject}}</td>
                                            <td>{{$warning->warning_date}}</td>
                                            <td>{{$warning->status}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Terminations</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Termination Type</th>
                                            <th>Termination Date</th>
                                            <th>Notice Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($terminations as $termination) {
                                    ?>
                                        <tr>
                                            <td>{{$termination->termination_type}}</td>
                                            <td>{{$termination->termination_date}}</td>
                                            <td>{{$termination->notice_date}}</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Projects</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Client</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Priority</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($projects as $project) {
    $currentDate = date("m/j/Y");
    $currentDate = date('Y-m-d', strtotime($currentDate));
    $startDate = date('Y-m-d', strtotime($project->start_date));
    $endDate = date('Y-m-d', strtotime($project->end_date));
    if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
        $pro_client = OtherClientDetails::where('user_id', $project->client)->value('first_name') . ' ' . OtherClientDetails::where('user_id', $project->client)->value('last_name');
        $pro_employees = PMProjectsEmployees::where('project_id', $project->id)->get();
        foreach ($pro_employees as $pro_employee) {
            if ($pro_employee->employee_id == Auth::user()->id) { ?>
                                        <tr>
                                            <td>{{$project->title}}</td>
                                            <td>{{$pro_client}}</td>
                                            <td>{{$project->start_date}}</td>
                                            <td>{{$project->end_date}}</td>
                                            <td>{{$project->priority}}</td>
                                        </tr>
                                        <?php            }
        }
    }
} ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tasks</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Project</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Estimated Hours</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($tasks as $tasks) {
    $tcurrentDate = date("m/j/Y");
    $tcurrentDate = date('Y-m-d', strtotime($tcurrentDate));
    $tstartDate = date('Y-m-d', strtotime($tasks->start_date));
    $tendDate = date('Y-m-d', strtotime($tasks->end_date));
    if (($tcurrentDate >= $tstartDate) && ($tcurrentDate <= $tendDate)) {
        $project_name = PMProjects::where('id', $tasks->project)->value('title');
        $task_employees = PMTaskUsers::where('task_id', $tasks->id)->get();
        foreach ($task_employees as $task_employee) {
            if ($task_employee->user_id == Auth::user()->id) { ?>
                                        <tr>
                                            <td>{{$tasks->title}}</td>
                                            <td>{{$project_name}}</td>
                                            <td>{{$tasks->start_date}}</td>
                                            <td>{{$tasks->end_date}}</td>
                                            <td>{{$tasks->estimated_hours}}</td>
                                        </tr>
                                        <?php            }
        }
    }
} ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Meetings</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Meeting Title</th>
                                            <th>Meeting Date</th>
                                            <th>Meeting Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($meetings as $meeting) {
    $mcurrentDate = date("m/j/Y");
    $mcurrentDate = date('Y-m-d', strtotime($mcurrentDate));
    $mDate = date('Y-m-d', strtotime($meeting->meeting_date));
    if (($mcurrentDate == $mDate)) { ?>
                                        <tr>
                                            <td>{{$meeting->meeting_title}}</td>
                                            <td>{{$meeting->meeting_date}}</td>
                                            <td>{{$meeting->meeting_time}}</td>
                                        </tr>
                                        <?php    }
} ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Events</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Event Title</th>
                                            <th>Event Date</th>
                                            <th>Event Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($events as $event) {
    $department_name = OrganizationDepartments::where('id', $event->department)->value('department');
    $ecurrentDate = date("m/j/Y");
    $ecurrentDate = date('Y-m-d', strtotime($ecurrentDate));
    $eDate = date('Y-m-d', strtotime($event->event_date));
    if (($ecurrentDate == $eDate)) { ?>
                                        <tr>
                                            <td>{{$event->event_title}}</td>
                                            <td>{{$department_name}}</td>
                                            <td>{{$event->event_date}}</td>
                                            <td>{{$event->event_time}}</td>
                                        </tr>
                                        <?php    }
} ?>
                                    </tbody>
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xxl-6">
                    <div class="card-theme card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Training Lists </h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Training Type</th>
                                            <th>Trainer</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($training_lists as $training_list) {
    $trcurrentDate = date("m/j/Y");
    $trcurrentDate = date('Y-m-d', strtotime($trcurrentDate));
    $trstartDate = date('Y-m-d', strtotime($training_list->start_date));
    $trendDate = date('Y-m-d', strtotime($training_list->end_date));
    if (($trcurrentDate >= $trstartDate) && ($trcurrentDate <= $trendDate)) {
        $trainer_name = TrainingTrainers::where('id', $training_list->trainer)->value('first_name') . ' ' . TrainingTrainers::where('id', $training_list->trainer)->value('last_name');
        $train_type = TrainingType::where('id', $training_list->training_type)->value('training_type');
        $train_employees = TrainingListEmployees::where('list_id', $training_list->id)->get();
        foreach ($train_employees as $train_employee) {
            if ($train_employee->employee_id == Auth::user()->id) { ?>
                                        <tr>
                                            <td>{{$train_type}}</td>
                                            <td>{{$trainer_name}}</td>
                                            <td>{{$training_list->start_date}}</td>
                                            <td>{{$training_list->end_date}}</td>
                                        </tr>
                                        <?php            }
        }
    }
} ?>
                                    </tbody>
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