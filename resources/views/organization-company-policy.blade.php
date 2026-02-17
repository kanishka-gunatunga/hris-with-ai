@include('layouts.header')
<?php
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
                        <h4 class="mb-sm-0 dashboard-title">Company Policy</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Company Policy</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Policy List</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                            <a href="{{url('add-policy')}}" class="btn btn-theme-orange">Add Company Policy</a>
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
                            <div class="konnect-table-wrapper table-responsive">
                                <table id="buttons-datatables" class="display table konnect-table mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Title</th>
                                            <th>Description</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($policys as $policy) { ?>
                                        <tr>
                                            <form action="{{ url('edit-organization-company-policy/' . $policy->id) }}"
                                                method="post">
                                                @csrf
                                                <td class="ps-4"> <input type="text" class="form-control" name="title"
                                                        value="{{$policy->title}}" required></td>
                                                <td>
                                                    <textarea class="form-control" id="description" name="description"
                                                        required>{{$policy->description}}</textarea>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="submit" class="btn-icon-soft-blue border-0"
                                                            title="Update">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z">
                                                                </path>
                                                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                                                <polyline points="7 3 7 8 15 8"></polyline>
                                                            </svg>
                                                        </button>
                                            </form>
                                            <a href="{{ url('delete-organization-company-policy/' . $policy->id) }}"
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