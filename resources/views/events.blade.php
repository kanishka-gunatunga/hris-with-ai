@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\EventsDepartments;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Events</h4>

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
                    <div class="card card-theme shadow-none rounded-3 border-0">
                        <div
                            class="card-header d-flex justify-content-between align-items-center p-3 border-0 bg-white">
                            <h5 class="card-title mb-0 dashboard-title">Events List</h5>
                            <a href="{{url('add-event')}}" class="btn btn-theme-orange">Add Event</a>
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
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Title</th>
                                            <th>Departments</th>
                                            <th>Event Date</th>
                                            <th>Event Time</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($events as $event) {
    $event_departments = EventsDepartments::where('event_id', $event->id)->get();
                                        ?>
                                        <tr>
                                            <td class="ps-4">{{$event->event_title}} </td>
                                            <td>
                                                <?php
    $dep_list = [];
    foreach ($event_departments as $event_department) {
        $dept = OrganizationDepartments::find($event_department->department_id);
        if ($dept) {
            $loc = OrganizationLocations::where('id', $dept->location)->value('location');
            $dep_list[] = $dept->department . ($loc ? ' (' . $loc . ')' : '');
        }
    }
    echo implode(', ', $dep_list);
                                                ?>
                                            </td>
                                            <td>{{$event->event_date}} </td>
                                            <td>{{$event->event_time}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-events/' . $event->id) }}"
                                                        class="btn-icon-soft-blue" title="Edit">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                            </path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('delete-events/' . $event->id) }}"
                                                        class="btn-icon-soft-red" title="Delete">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
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
</div>
@include('layouts.footer')