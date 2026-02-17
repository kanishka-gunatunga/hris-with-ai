@include('layouts.header')
<?php
use App\Models\PMProjectsEmployees;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\OrganizationDepartments;
use App\Models\EventsDepartments;
?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Events</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Events</li>
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
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Events</h5>

                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                <th class="center">Title</th>
                                            <th class="center">Department</th>
                                            <th class="center">Event Date</th>
                                            <th class="center">Event Time</th>
                                            <th class="center">Status</th>
                                            <th class="center">Event Note</th>
                                            <th class="center">Notification</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($events as $event){
                                        $departmets = EventsDepartments::where('event_id', $event->id)->get();
                                        foreach($departmets as $departmet){
                                        if($departmet->department_id == OtherEmployeeDetails::where('user_id',Auth::user()->id)->value('department')){
                                            $dep_name =  OrganizationDepartments::where('id', $departmet->department_id)->value('department');
                                        ?>
                                        <tr class="odd gradeX">

                                             <td class="">{{$event->event_title}} </td>
                                            <td class="">{{$dep_name}} </td>
                                            <td class="">{{$event->event_date}} </td>
                                            <td class="">{{$event->event_time}} </td>
                                            <td class="">{{$event->status}} </td>
                                            <td class="">{{$event->event_note}} </td>
                                            <td class="">{{$event->notification}} </td>
                                        </tr>
                                    <?php
                                    }}} ?>
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
