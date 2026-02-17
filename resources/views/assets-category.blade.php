@include('layouts.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
<div class="page-title-box">
                                <h4 class="mb-sm-0 dashboard-title">Asset Categories</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Asset Categories</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-theme shadow-none rounded-3 border-0">
                                <div class="card-header d-flex justify-content-between align-items-center p-3 border-0 bg-white">
                                    <h5 class="card-title mb-0 dashboard-title">Asset Categories</h5>
                                    <a href="{{url('add-asset-category')}}" class="btn btn-theme-orange">Add Asset Category</a>
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
                                                    <th class="ps-4">Category</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($categorys as $category){ ?>
                                                <tr>
                                                    <td class="ps-4">{{$category->category}}</td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="{{ url('delete-assets-category/'.$category->id) }}" class="btn-icon-soft-red" title="Delete">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
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
