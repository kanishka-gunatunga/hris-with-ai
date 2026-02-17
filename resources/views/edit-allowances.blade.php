@include('layouts.header')
<?php

foreach ($allowance_details as $allowance_detail)  {
    $month_year = $allowance_detail->month_year;
    $allowance_type =$allowance_detail->allowance_type;
    $allowance_title =$allowance_detail->allowance_title;
    $allowance_amount =$allowance_detail->allowance_amount;
}
?>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Allowances</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Allowances</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-xxl-12" style="margin:auto;">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Allowances</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Allowance</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Month Year</label>
                                                        <input name="month_year" value="{{$month_year}}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="Y-m" readonly="readonly" >
                                                        @if($errors->has("month_year")) <div class="alert alert-danger mt-2">{{ $errors->first('month_year') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Allowance Type</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="allowance_type" >
                                                        <option selected hidden value="{{$allowance_type}}">{{$allowance_type}}</option>
                                                        <option value="Taxable">Taxable</option>
                                                        <option value="Non-Taxable">Non-Taxable</option>
                                                        </select>
                                                        @if($errors->has("allowance_type")) <div class="alert alert-danger mt-2">{{ $errors->first('allowance_type') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Allowance Title</label>
                                                        <input type="text" class="form-control" name="allowance_title" value="{{$allowance_title}}">
                                                        @if($errors->has("allowance_title")) <div class="alert alert-danger mt-2">{{ $errors->first('allowance_title') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->


                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Allowance Amount</label>
                                                        <input type="text" class="form-control" name="allowance_amount" value="{{$allowance_amount}}">
                                                        @if($errors->has("allowance_amount")) <div class="alert alert-danger mt-2">{{ $errors->first('allowance_amount') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <!--end col-->

                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->

                        </div>



                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
@include('layouts.footer')
