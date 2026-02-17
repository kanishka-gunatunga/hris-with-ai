@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OtherHODDetails;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationDesignations;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Employees</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employees</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Employees List</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                            <a href="{{url('add-employee')}}" class="btn btn-theme-orange">Add Employees</a>
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
                                            <th>Branch</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Employment Type</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
if (Auth::user()->user_role == 5) { ?>
                                        <?php    foreach ($employees as $employee) {
        $image = OtherEmployeeDetails::where('user_id', $employee->id)->value('image');
        $name = OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
        $phone = OtherEmployeeDetails::where('user_id', $employee->id)->value('phone');
        $emplyment_type = OtherEmployeeDetails::where('user_id', $employee->id)->value('employment_type');
        $department = OtherEmployeeDetails::where('user_id', $employee->id)->value('department');
        $designation = OtherEmployeeDetails::where('user_id', $employee->id)->value('designation');
        $designation_name = OrganizationDesignations::where('id', $designation)->value('designation') ?? '-';
        $department_name = OrganizationDepartments::where('id', $department)->value('department') ?? '-';
        $company = OtherEmployeeDetails::where('user_id', $employee->id)->value('company');
        if ($department == OtherHODDetails::where('user_id', Auth::user()->id)->value('department')) {
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
                                            <td>{{$company}}</td>
                                            <td>{{$department_name}}</td>
                                            <td>{{$designation_name}}</td>
                                            <td>{{$emplyment_type}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>
                                                <?php            if ($employee->status == "active") { ?>
                                                <span class="badge badge-soft-success">Active</span>
                                                <?php            } else { ?>
                                                <span class="badge badge-soft-danger">Inactive</span>
                                                <?php            } ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-employee/' . $employee->id) }}"
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
                                                    <a href="{{ url('deactivate-employee/' . $employee->id) }}"
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
                                                    <a href="{{ url('activate-employee/' . $employee->id) }}"
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
                                        <?php        }
    } ?>
                                        <?php } else { ?>
                                        <?php    foreach ($employees as $employee) {
        $image = OtherEmployeeDetails::where('user_id', $employee->id)->value('image');
        $company = OtherEmployeeDetails::where('user_id', $employee->id)->value('company');
        $name = OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
        $phone = OtherEmployeeDetails::where('user_id', $employee->id)->value('phone');
        $emplyment_type = OtherEmployeeDetails::where('user_id', $employee->id)->value('employment_type');
        $department = OtherEmployeeDetails::where('user_id', $employee->id)->value('department');
        $department_name = OrganizationDepartments::where('id', $department)->value('department') ?? '-';
        $designation = OtherEmployeeDetails::where('user_id', $employee->id)->value('designation');
        $designation_name = OrganizationDesignations::where('id', $designation)->value('designation') ?? '-';
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
                                            <td>{{$company}}</td>
                                            <td>{{$department_name}}</td>
                                            <td>{{$designation_name}}</td>
                                            <td>{{$emplyment_type}}</td>
                                            <td>{{$employee->email}}</td>

                                            <td>
                                                <?php        if ($employee->status == "active") { ?>
                                                <span class="badge badge-soft-success">Active</span>
                                                <?php        } else { ?>
                                                <span class="badge badge-soft-danger">Inactive</span>
                                                <?php        } ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-employee/' . $employee->id) }}"
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
                                                    <a href="{{ url('deactivate-employee/' . $employee->id) }}"
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
                                                    <a href="{{ url('activate-employee/' . $employee->id) }}"
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
                                        <?php    } ?>
                                        <?php }?>

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