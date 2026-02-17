@include('layouts.header')
<?php
use App\Models\AssetCategory;
use App\Models\OtherEmployeeDetails;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Assets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Assets</li>
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
                            <h5 class="card-title mb-0 dashboard-title">Assets List</h5>
                            <a href="{{url('add-asset')}}" class="btn btn-theme-orange">Add Asset</a>
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
                                            <th class="ps-4">Asset Name</th>
                                            <th>Category</th>
                                            <th>Asset Code</th>
                                            <th>Is Working</th>
                                            <th>Assign To</th>
                                            <th>Warranty Date</th>
                                            <th>Image</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assets as $asset) {
    $employee_name = OtherEmployeeDetails::where('user_id', $asset->employee)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $asset->employee)->value('last_name');
    $category_name = AssetCategory::where('id', $asset->category)->value('category');
                                    ?>
                                        <tr>
                                            <td class="ps-4">{{$asset->asset_name}} </td>
                                            <td>{{$category_name}} </td>
                                            <td>{{$asset->asset_code}} </td>
                                            <td>{{$asset->is_working}} </td>
                                            <td>{{$employee_name}} </td>
                                            <td>{{$asset->end_date}} </td>
                                            <td><a href="{{ asset('asset_images/' . $asset->image . '') }}"
                                                    class="text-primary text-decoration-underline" download>Download</a>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ url('edit-assets/' . $asset->id) }}"
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
                                                    <a href="{{ url('delete-assets/' . $asset->id) }}"
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
        $("#category").select2({
            placeholder: "Select Category",
            allowClear: true
        });
        $("#is_working").select2({
            placeholder: "Select Is Working",
            allowClear: true
        });
        $("#employee").select2({
            placeholder: "Select Employee",
            allowClear: true
        });
        $("#payer").select2({
            placeholder: "Select Payer",
            allowClear: true
        });
        $('#asset_note').summernote({
            tabsize: 2,
            height: 50
        });
    </script>