@include('layouts.header')
<?php
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingListEmployees;
use App\Models\OtherEmployeeDetails;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Training Lists</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Training Lists</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-lg-12">
                    <div class="card-theme">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Training Lists</h5>
                            <a href="{{url('add-training-list')}}" class="btn btn-theme-orange">Add Training List</a>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success m-3">{{ Session::get('success') }}</div>@endif
                        <div class="card-body p-0">
                            <style>
                                #buttons-datatables_wrapper {
                                    padding: 20px;
                                }

                                .konnect-table-wrapper {
                                    overflow-x: auto !important;
                                }
                            </style>
                            <div class="konnect-table-wrapper">
                                <table id="buttons-datatables" class="display table konnect-table mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Training Type</th>
                                            <th class="">Employees</th>
                                            <th class="">Trainer</th>
                                            <th class="">Start Date</th>
                                            <th class="">End Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($lists as $list) {
        $training_type_name = TrainingType::where('id', $list->training_type)->value('training_type');
        $trainer_name = TrainingTrainers::where('id', $list->trainer)->value('first_name') . ' ' . TrainingTrainers::where('id', $list->trainer)->value('last_name');
        $assigned_empoyees = TrainingListEmployees::where('list_id', $list->id)->get();
                                        ?>
                                        <tr>

                                            <td class="ps-4">{{$training_type_name}} </td>
                                            <td class="">
                                                <?php    foreach ($assigned_empoyees as $assigned_empoyee) {
            echo OtherEmployeeDetails::where('user_id', $assigned_empoyee->employee_id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $assigned_empoyee->employee_id)->value('last_name') . ',';
        } ?>
                                            </td>
                                            <td class="">{{$trainer_name}} </td>
                                            <td class="">{{$list->start_date}} </td>
                                            <td class="">{{$list->end_date}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-training-list/' . $list->id) }}"
                                                        class="btn-icon-soft-blue" title="Edit">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                            </path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('delete-training-list/' . $list->id) }}"
                                                        class="btn-icon-soft-red" title="Delete">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
    @include('layouts.footer')
    <script>
        $("#company").select2({
            placeholder: "Select Company",
            allowClear: true
        });
        $("#employee").select2({
            placeholder: "Select Employee",
            allowClear: true
        });
        $("#department").select2({
            placeholder: "Select Department",
            allowClear: true
        });
        $("#award_type").select2({
            placeholder: "Select Award Type",
            allowClear: true
        });
    </script>