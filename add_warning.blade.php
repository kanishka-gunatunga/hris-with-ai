<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationLocations;
use App\Models\OrganizationDepartments;
?>
@include('layouts.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"style="display: none;">Add Warning</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Add Warning</li>
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
                                    <div class="vertical-center-heading">
                                    <h4 class="card-title mb-0 flex-grow-1"style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px; margin-top: 20px; margin-bottom: 20px;"
                                    >Add Warning</h4>
                                </div>
                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save as Warning</button>
                                <a href="{{url('core-hr-warnings')}}"><button type="button" class="btn btn-light">Back</button></a>
                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Employee</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="employee" >
                                                        <?php
                                foreach($employees as $employee){
                                ?>
                                 <option value="{{$employee->user_id}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                                <?php } ?>
                                                        </select>
                                                        @if($errors->has("employee")) <div class="alert alert-danger mt-2">{{ $errors->first('employee') }}</li></div>@endif
                                                    </div>
                                                </div>
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Warning Type</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="warning_type" >
                                                        <?php
                                if(old('warning_type')){
                                ?>
                                <option selected value="{{old('warning_type')}}">{{old('warning_type')}}</option>
                                <?php }?>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                                        </select>
                                                        @if($errors->has("warning_type")) <div class="alert alert-danger mt-2">{{ $errors->first('warning_type') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Subject</label>
                                                        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                                                        @if($errors->has("subject")) <div class="alert alert-danger mt-2">{{ $errors->first('subject') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Warning Date</label>
                                                        <input name="warning_date" value="{{ old('warning_date') }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("warning_date")) <div class="alert alert-danger mt-2">{{ $errors->first('warning_date') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Status</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="status" >
                                                        <?php
                                if(old('status')){
                                ?>
                                <option selected value="{{old('status')}}">{{old('status')}}</option>
                                <?php }?>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                                        </select>
                                                        @if($errors->has("status")) <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Description</label>
                                                        <textarea class="form-control" name="discription" >{{ old('discription') }}</textarea>
                                                        @if($errors->has("discription")) <div class="alert alert-danger mt-2">{{ $errors->first('discription') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <!--end col-->



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
