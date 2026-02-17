@include('layouts.header')
<?php
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingList;
use App\Models\TrainingListEmployees;

?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Trainings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Trainings</li>
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
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Trainings</h5>

                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                <th class="center">Training Type</th>
                                            <th class="center">Trainer</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Training Cost</th>
                                            <th class="center">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($trainings as $training){
                                    if(TrainingListEmployees::where('list_id', $training->id)->where('employee_id', Auth::user()->id)->exists()){
                                    $assigned_empoyees = TrainingListEmployees::where('list_id', $training->id)->get();
                                    $training_type = TrainingType::where('id', $training->training_type)->value('training_type');
                                    $trainer = TrainingTrainers::where('id', $training->trainer)->value('first_name').' '.TrainingTrainers::where('id', $training->trainer)->value('last_name');
                                    ?>
                                        <tr class="odd gradeX">

                                             <td class="">{{$training_type}} </td>
                                            <td class="">{{$trainer}} </td>
                                            <td class="">{{$training->start_date}} </td>
                                            <td class="">{{$training->end_date}} </td>
                                            <td class="">{{$training->training_cost}} </td>
                                            <td class="">{{$training->discription}} </td>
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
