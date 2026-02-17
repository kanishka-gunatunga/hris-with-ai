@include('layouts.header')
<?php
use App\Models\OtherHODDetails;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">HOD</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">HOD</li>
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
                            <h5 class="card-title mb-0 dashboard-title">HOD List</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                            <a href="{{url('add-hod')}}" class="btn btn-theme-orange">Add HOD</a>
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

                                .badge-soft-success {
                                    background-color: #d1fae5;
                                    color: #059669;
                                }

                                .badge-soft-danger {
                                    background-color: #ffe9e5;
                                    color: #ed2227;
                                }
                            </style>
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Image</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($hods as $hod) {
    $image = OtherHODDetails::where('user_id', $hod->id)->value('image');
    $name = OtherHODDetails::where('user_id', $hod->id)->value('name');
    $phone = OtherHODDetails::where('user_id', $hod->id)->value('phone');
    $department = OtherHODDetails::where('user_id', $hod->id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name = OrganizationLocations::where('id', $department_location)->value('location');
                                        ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="avatar-group">
                                                    <img src="{{ asset('user_images/' . $image . '') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </div>
                                            </td>
                                            <td>{{$name}}</td>
                                            <td>{{$phone}}</td>
                                            <td>{{$hod->email}}</td>
                                            <td>{{$department_name . ' (' . $selected_location_name . ')'}}</td>
                                            <td>
                                                <?php    if ($hod->status == "active") { ?>
                                                <span class="badge badge-soft-success">Active</span>
                                                <?php    } else { ?>
                                                <span class="badge badge-soft-danger">Inactive</span>
                                                <?php    } ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-hod/' . $hod->id) }}"
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
                                                    <a href="{{ url('deactivate-hod/' . $hod->id) }}"
                                                        class="btn-icon-soft-red" title="Deactivate">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ url('activate-hod/' . $hod->id) }}"
                                                        class="btn-icon-soft-green" title="Activate">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
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