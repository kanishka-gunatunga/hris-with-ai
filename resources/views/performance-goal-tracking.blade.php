@include('layouts.header')
<?php
use App\Models\PerformanceGoalType;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Goal Tracking</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Goal Tracking</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="col-lg-12">
                <div class="card card-theme shadow-none rounded-3 border-0">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 border-0 bg-white">
                        <h5 class="card-title mb-0 dashboard-title">Goal Tracking</h5>
                        <a href="{{ url('add-goal') }}" class="btn btn-theme-orange">Add Goal</a>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success m-3">{{ Session::get('success') }}</div>
                    @endif

                    <div class="card-body p-0">
                        <style>
                            #buttons-datatables_wrapper {
                                padding: 20px;
                            }

                            .konnect-table-wrapper {
                                overflow-x: auto !important;
                            }
                        </style>
                        <div class="konnect-table-wrapper table-responsive">
                            <table id="buttons-datatables" class="display table konnect-table mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Goal Type</th>
                                        <th>Target Achievement</th>
                                        <th>Start Date</th>
                                        <th>End Time</th>
                                        <th>Progress</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($goal_tracks as $goal_track) {
    $goal_type_name = PerformanceGoalType::where('id', $goal_track->goal_type)->value('goal_type');
                                     ?>
                                    <tr>
                                        <td class="ps-4">{{ $goal_type_name }} </td>
                                        <td>{{ $goal_track->target_achievement }} </td>
                                        <td>{{ $goal_track->start_date }} </td>
                                        <td>{{ $goal_track->end_date }} </td>
                                        <td>
                                            <div class="progress animated-progress custom-progress progress-label"
                                                style="height: 15px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $goal_track->progress }}%"
                                                    aria-valuenow="{{ $goal_track->progress }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="label">{{ $goal_track->progress }}%</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ url('edit-performance-goal-tracking/' . $goal_track->id) }}"
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
                                                <a href="{{ url('delete-performance-goal-tracking/' . $goal_track->id) }}"
                                                    class="btn-icon-soft-red" title="Delete">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
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