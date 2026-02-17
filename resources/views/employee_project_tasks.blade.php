@include('layouts.header')
<?php
use App\Models\PMProjectsEmployees;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\PMTaskUsers;

?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Projects and Tasks</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Projects and Tasks</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Projects</h5>

                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                <th class="center">Project Name</th>
                                            <th class="center">Priority</th>
                                            <th class="center">Assigned Employee</th>
                                            <th class="center">Client</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Progress</th>
                                            <th class="center"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($projects as $projects){
                                        $client = OtherClientDetails::where('user_id', $projects->client)->value('first_name').' '.OtherClientDetails::where('user_id', $projects->client)->value('last_name');
                                        if(PMProjectsEmployees::where('project_id', $projects->id)->where('employee_id', Auth::user()->id)->exists()){
                                            $assigned_empoyees = PMProjectsEmployees::where('project_id', $projects->id)->get();
                                        ?>
                                        <tr class="odd gradeX">
                                            <td class="">{{$projects->title}} </td>
                                            <td class="">{{$projects->priority}} </td>
                                            <td class="">
                                            <?php foreach($assigned_empoyees as $assigned_empoyee){
                                            echo OtherEmployeeDetails::where('user_id', $assigned_empoyee->employee_id)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $assigned_empoyee->employee_id)->value('last_name').',';
                                            } ?>
                                            </td>
                                            <td class="">{{$client}} </td>
                                            <td class="">{{$projects->start_date}} </td>
                                            <td class="">{{$projects->end_date}} </td>
                                            <td class="">

                                            <div class="progress animated-progress custom-progress progress-label">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{$projects->progress}}%" aria-valuenow="{{$projects->progress}}" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="label">{{$projects->progress}}%</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('view-project/'.$projects->id) }}">
                                                <i class="ri-eye-line"></i>
                                                </button>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php
                                    }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tasks</h5>

                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                <th class="center">Title</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Status</th>
                                            <th class="center">Assigned Employees</th>
                                            <th class="center">Task Progress</th>
                                            <th class="center"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($tasks as $task){
                                        if(PMTaskUsers::where('task_id', $task->id)->where('user_id', Auth::user()->id)->exists()){
                                            $assigned_empoyees = PMTaskUsers::where('task_id', $task->id)->get();
                                        ?>
                                        <tr class="odd gradeX">
                                             <td class="">{{$task->title}} </td>
                                            <td class="">{{$task->start_date}} </td>
                                            <td class="">{{$task->end_date}} </td>
                                            <td class="">{{$task->status}} </td>
                                            <td class="">
                                            <?php foreach($assigned_empoyees as $assigned_empoyee){
                                            echo OtherEmployeeDetails::where('user_id', $assigned_empoyee->user_id)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $assigned_empoyee->user_id)->value('last_name').',';
                                            } ?>
                                            </td>
                                            <td class="">

                                            <div class="progress animated-progress custom-progress progress-label">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{$task->progress}}%" aria-valuenow="{{$task->progress}}" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="label">{{$task->progress}}%</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('view-task/'.$task->id) }}">
                                                <i class="ri-eye-line"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php
                                    }} ?>
                            </tbody>
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
<script>
$("#company").select2( {
	placeholder: "Select Company",
	allowClear: true
	} );
    $("#employee").select2( {
	placeholder: "Select Employee",
	allowClear: true
	} );
    $("#department").select2( {
	placeholder: "Select Department",
	allowClear: true
	} );
    $("#award_type").select2( {
	placeholder: "Select Award Type",
	allowClear: true
	} );
</script>
