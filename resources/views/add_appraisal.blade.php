<?php
use App\Models\OrganizationDesignations;
use App\Models\PerformanceGoalType;
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;


?>
@include('layouts.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"style="display: none;">Add Appraisal</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Add Appraisal</li>
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
                                    >Add Appraisal</h4>
                                </div>
                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Appraisal</button>
                                <a href="{{url('performance-appraisal')}}"><button type="button" class="btn btn-light">Back</button></a>
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
                                                        <label for="firstNameinput" class="form-label">Desigantion</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="desigantion" >
                                                        <?php
                                foreach($designations as $designation){
                                ?>
                                 <option value="{{$designation->id}}">{{$designation->designation}}</option>
                                <?php } ?>
                                                        </select>
                                                        @if($errors->has("desigantion")) <div class="alert alert-danger mt-2">{{ $errors->first('desigantion') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Appraisal Date</label>
                                                        <input name="appraisal_date" value="{{ old('appraisal_date') }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("appraisal_date")) <div class="alert alert-danger mt-2">{{ $errors->first('appraisal_date') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                        <h5><strong>Technical Competencies</strong></h5>
                        <div class="row clearfix  mt-4">
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Customer Experience</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="customer_experience" >
                                 <?php
                                if(old('customer_experience')){
                                ?>
                                <option selected value="{{old('customer_experience')}}">{{old('customer_experience')}}</option>
                                <?php }?>
                                 <option value="None">None</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermidiate">Intermidiate</option>
                                 <option value="Advanced">Advanced</option>
                                 <option value="Expert/Leader">Expert/Leader</option>
                                </select>
                                @if($errors->has("customer_experience")) <div class="alert alert-danger mt-2">{{ $errors->first('customer_experience') }}</li></div>@endif
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Marketing</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="marketing" >
                                 <?php
                                if(old('marketing')){
                                ?>
                                <option selected value="{{old('marketing')}}">{{old('marketing')}}</option>
                                <?php }?>
                                 <option value="None">None</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermidiate">Intermidiate</option>
                                 <option value="Advanced">Advanced</option>
                                 <option value="Expert/Leader">Expert/Leader</option>
                                </select>
                                @if($errors->has("marketing")) <div class="alert alert-danger mt-2">{{ $errors->first('marketing') }}</li></div>@endif
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Administration</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="administration" >
                                 <?php
                                if(old('administration')){
                                ?>
                                <option selected value="{{old('administration')}}">{{old('administration')}}</option>
                                <?php }?>
                                 <option value="None">None</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermidiate">Intermidiate</option>
                                 <option value="Advanced">Advanced</option>
                                 <option value="Expert/Leader">Expert/Leader</option>
                                </select>
                                @if($errors->has("administration")) <div class="alert alert-danger mt-2">{{ $errors->first('administration') }}</li></div>@endif
                        </div>
                        </div>
                        </div>
                        </div>
                       <div class="col-md-6">
                       <h5><strong>Organizational Competencies</strong></h5>
                       <div class="row clearfix  mt-4">
                       <div class="col-md-6">
                       <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Professionalism</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="professionalism" >
                                 <?php
                                if(old('professionalism')){
                                ?>
                                <option selected value="{{old('professionalism')}}">{{old('professionalism')}}</option>
                                <?php }?>
                                 <option value="None">None</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermidiate">Intermidiate</option>
                                 <option value="Advanced">Advanced</option>
                                 <option value="Expert/Leader">Expert/Leader</option>
                                </select>
                                @if($errors->has("professionalism")) <div class="alert alert-danger mt-2">{{ $errors->first('professionalism') }}</li></div>@endif
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Integrity</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="integrity" >
                                 <?php
                                if(old('integrity')){
                                ?>
                                <option selected value="{{old('integrity')}}">{{old('integrity')}}</option>
                                <?php }?>
                                 <option value="None">None</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermidiate">Intermidiate</option>
                                 <option value="Advanced">Advanced</option>
                                 <option value="Expert/Leader">Expert/Leader</option>
                                </select>
                                @if($errors->has("integrity")) <div class="alert alert-danger mt-2">{{ $errors->first('integrity') }}</li></div>@endif
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Attendance</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="attendance" >
                                 <?php
                                if(old('attendance')){
                                ?>
                                <option selected value="{{old('attendance')}}">{{old('attendance')}}</option>
                                <?php }?>
                                 <option value="None">None</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermidiate">Intermidiate</option>
                                 <option value="Advanced">Advanced</option>
                                 <option value="Expert/Leader">Expert/Leader</option>
                                </select>
                                @if($errors->has("attendance")) <div class="alert alert-danger mt-2">{{ $errors->first('attendance') }}</li></div>@endif
                        </div>
                    </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Remarks</label>
                                                        <textarea class="form-control" name="remarks" >{{ old('remarks') }}</textarea>
                                                        @if($errors->has("remarks")) <div class="alert alert-danger mt-2">{{ $errors->first('remarks') }}</li></div>@endif
                                                    </div>
                                                </div>
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
<script>

    $('#discription').summernote({
        tabsize: 2,
        height: 200
      });
</script>
