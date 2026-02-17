<?php
use App\Models\OrganizationDesignations;
use App\Models\PerformanceGoalType;
use App\Models\OrganizationDepartments;
foreach ($indicator_details as $indicator_detail)  {
    $desigantion = $indicator_detail->desigantion;
    $customer_experience =$indicator_detail->customer_experience;
    $marketing =$indicator_detail->marketing;
    $administration =$indicator_detail->administration;
    $professionalism =$indicator_detail->professionalism;
    $integrity =$indicator_detail->integrity;
    $attendance =$indicator_detail->attendance;
    $designation_name = OrganizationDesignations::where('id', $desigantion)->value('designation');
}

?>
@include('layouts.header')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Indicator</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Indicator</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Indicator</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Indicator</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">


                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Desigantion</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="desigantion" >
                                                        <option selected hidden value="{{$desigantion}}">{{$designation_name}}</option>
                                <?php
                                foreach($designations as $designation){
                                ?>
                                 <option value="{{$designation->id}}">{{$designation->designation}}</option>
                                <?php } ?>
                                                        </select>
                                                        @if($errors->has("desigantion")) <div class="alert alert-danger mt-2">{{ $errors->first('desigantion') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                </div>
                                                <div class="col-md-6">
                        <h5><strong>Technical Competencies</strong></h5>
                        <div class="row clearfix  mt-4">
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Customer Experience</label>
                                 <select class="form-control" data-choices  id="choices-single-default" name="customer_experience" >
                                 <option selected hidden value="{{$customer_experience}}">{{$customer_experience}}</option>
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
                                 <option selected hidden value="{{$marketing}}">{{$marketing}}</option>
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
                                 <option selected hidden value="{{$administration}}">{{$administration}}</option>
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
                                 <option selected hidden value="{{$professionalism}}">{{$professionalism}}</option>
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
                                 <option selected hidden value="{{$integrity}}">{{$integrity}}</option>
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
                                 <option selected hidden value="{{$attendance}}">{{$attendance}}</option>
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
