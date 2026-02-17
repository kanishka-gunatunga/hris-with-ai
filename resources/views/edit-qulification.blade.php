<?php

foreach ($qulification_details as $qulification_detail)  {
    $school_university = $qulification_detail->school_university;
    $education_level =$qulification_detail->education_level;
    $from_date =$qulification_detail->from_date;
    $to_date =$qulification_detail->to_date;
    $language =$qulification_detail->language;
    $professional_skills =$qulification_detail->professional_skills;
    $discription =$qulification_detail->discription;
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
                                <h4 class="mb-sm-0">Edit Qualification</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Qualification</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Qualification</h4>

                                </div><!-- end card header -->

                                <form  action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="submit" class="btn btn-info">Save Qualification</button>

                                </div>
                                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                    <div class="live-preview">

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">School/University</label>
                                                        <input type="text" class="form-control" name="school_university" value="{{ $school_university }}">
                                                        @if($errors->has("school_university")) <div class="alert alert-danger mt-2">{{ $errors->first('school_university') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Education Level</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="education_level" >
                                                        <option selected hidden value="{{$education_level}}">{{$education_level}}</option>
                                            <option value="BSC">BSC</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="BBA">BBA</option>
                                                        </select>
                                                        @if($errors->has("education_level")) <div class="alert alert-danger mt-2">{{ $errors->first('education_level') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">From</label>
                                                        <input name="from" value="{{ $from_date }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("meeting_date")) <div class="alert alert-danger mt-2">{{ $errors->first('from') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">To</label>
                                                        <input name="to" value="{{ $to_date }}" type="text" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="n/j/Y" readonly="readonly" >
                                                        @if($errors->has("to")) <div class="alert alert-danger mt-2">{{ $errors->first('to') }}</li></div>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Language</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="language" >

                                        <option selected hidden value="{{$language}}">{{$language}}</option>
                                            <option value="English">English</option>
                                            <option value="Arabic">Arabic</option>
                                                        </select>
                                                        @if($errors->has("language")) <div class="alert alert-danger mt-2">{{ $errors->first('language') }}</li></div>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Professional Skills</label>
                                                        <select class="form-control" data-choices  id="choices-single-default" name="professional_skills" >
                                                        <option selected hidden value="{{$professional_skills}}">{{$professional_skills}}</option>
                                            <option value="MS Word">MS Word</option>
                                            <option value="Photoshop">Photoshop</option>
                                                        </select>
                                                        @if($errors->has("professional_skills")) <div class="alert alert-danger mt-2">{{ $errors->first('professional_skills') }}</li></div>@endif
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Description</label>
                                                        <textarea class="form-control" name="discription" >{{ $discription }}</textarea>
                                                        @if($errors->has("discription")) <div class="alert alert-danger mt-2">{{ $errors->first('discription') }}</li></div>@endif
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
