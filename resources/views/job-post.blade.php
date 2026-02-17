@include('layouts.header')
<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\PMProjectsEmployees;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Job Posts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Job Posts</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Job Posts List</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                            <a href="{{url('add-job-post')}}" class="btn btn-theme-orange">Add Job Post</a>
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
                                            <th class="ps-4">Job Title</th>
                                            <th>Job Type</th>
                                            <th>Job Category</th>
                                            <th>No of Vacancy</th>
                                            <th>Date of Closing</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jobs as $job) { ?>
                                        <tr>
                                            <td class="ps-4">{{$job->job_title}} </td>
                                            <td>{{$job->job_type}} </td>
                                            <td>{{$job->job_category}} </td>
                                            <td>{{$job->no_of_vacancy}} </td>
                                            <td>{{$job->date_of_closing}} </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-job-post/' . $job->id) }}"
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
                                                    <a href="{{ url('delete-job-post/' . $job->id) }}"
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
    @include('layouts.footer')
    <script>
        $("#minimum_experience").select2({
            placeholder: "Select Minimum Experience",
            allowClear: true
        });
        $("#gender").select2({
            placeholder: "Select Gender",
            allowClear: true
        });
        $("#is_featured").select2({
            placeholder: "Select Is Deatured",
            allowClear: true
        });
        $("#job_category").select2({
            placeholder: "Select Job Category",
            allowClear: true
        });
        $("#job_type").select2({
            placeholder: "Select Job Type",
            allowClear: true
        });
        $("#status").select2({
            placeholder: "Select Status",
            allowClear: true
        });
        $('#long_discription').summernote({
            tabsize: 2,
            height: 200
        });

        let mySelect = new vanillaSelectBox("#employees", {

            search: true
        });
    </script>