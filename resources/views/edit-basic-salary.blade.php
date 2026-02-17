@include('layouts.header')
<?php

foreach ($salary_details as $salary_detail)  {
    $month_year = $salary_detail->month_year;
    $payslip_type = $salary_detail->payslip_type;
    $basic_salary = $salary_detail->basic_salary;
}

?>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Basic Salary</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Basic Salary</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Basic Salary</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Basic Salary</button>

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
                                                        <label for="firstNameinput" class="form-label">Payslip Type</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="payslip_type" >
                                                        <option selected hidden value="{{$payslip_type}}">{{$payslip_type}}</option>
                               <option value="Monthly Payslip">Monthly Payslip</option>
                             <option value="Hourly Payslip">Hourly Payslip</option>
                                                        </select>
                                                        @if($errors->has("payslip_type")) <div class="alert alert-danger mt-2">{{ $errors->first('payslip_type') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Basic Salary</label>
                                                        <input type="text" class="form-control" name="basic_salary" value="{{$basic_salary}}">
                                                        @if($errors->has("basic_salary")) <div class="alert alert-danger mt-2">{{ $errors->first('basic_salary') }}</li></div>@endif
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
