@include('layouts.header')
<?php
use App\Models\PMProjectsEmployees;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\OrganizationDepartments;

?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Meetings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Meetings</li>
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
                        <h5 class="card-title mb-0"  style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Meetings</h5>

                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                <th class="center">Meeting Title</th>
                                            <th class="center">Meeting Date</th>
                                            <th class="center">Meeting Time</th>
                                            <th class="center">Meeting Status</th>
                                            <th class="center">Meeting Note</th>
                                            <th class="center">Notification</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($meetings as $meeting){
                                    ?>
                                        <tr class="odd gradeX">

                                             <td class="">{{$meeting->meeting_title}} </td>
                                            <td class="">{{$meeting->meeting_date}} </td>
                                            <td class="">{{$meeting->meeting_time}} </td>
                                            <td class="">{{$meeting->status}} </td>
                                            <td class="">{{$meeting->meeting_note}} </td>
                                            <td class="">{{$meeting->notification}} </td>
                                        </tr>
                                    <?php
                                    } ?>
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
