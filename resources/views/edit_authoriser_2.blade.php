<?php
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
?>
@include('layouts.header')
<?php

foreach ($other_details as $other_detail)  {
    $name = $other_detail->name;
    $phone = $other_detail->phone;
     $dob = $other_detail->dob;
    $gender = $other_detail->gender;
    $department = $other_detail->department;
    $employment_type = $other_detail->employment_type;
    $epf_no = $other_detail->epf_no;
    $appoinment_date = $other_detail->appoinment_date;
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
    $responsible_person = $other_detail->responsible_person;
    if($responsible_person == null){
     $responsible_person_name = "";   
    }
    else{
    $responsible_person_user_role = User::where('id',$responsible_person)->value('user_role');
    if($responsible_person_user_role == 5){
     $responsible_person_name = OtherHODDetails::where('user_id', $responsible_person)->value('name').' (HOD)';
    }
    elseif($responsible_person_user_role == 2){
     $responsible_person_name = OtherHRManagerDetails::where('user_id', $responsible_person)->value('first_name').' '.OtherHRManagerDetails::where('user_id', $responsible_person)->value('last_name').' (HRM)';   
    } 
    }
    
    
}
foreach ($login_details as $login_details)  {
    $status = $login_details->status;
    $email =$login_details->email;
    $user_name =$login_details->user_name;
    if($status == "active"){
    $check = "checked";
    }
    else{
        $check = "";
    }
}
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Edit Authoriser</h4>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">
                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif
                @if(Session::has('fail')) <div class="alert alert-danger mb-4">{{ Session::get('fail') }}</li></div>@endif
                
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" value="{{ $name }}">
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("name")) <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{$phone }}">
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                        <div class="form-line">
                                            <input id="myDatePicker" name="dob" class="flatPicker flatpickr-input active" placeholder="Date of Birth" type="text" value="{{ $dob }}">
                                        </div>
                                    </div>
                                    @if($errors->has("dob")) <div class="alert alert-danger mt-2">{{ $errors->first('dob') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="gender">

                                            <option selected value="{{$gender}}">{{$gender}}</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select></div>
                                    </div>

                                    @if($errors->has("gender")) <div class="alert alert-danger mt-2">{{ $errors->first('gender') }}</li></div>@endif
                                </div>
                                 <div class="col-sm-3">
                                <div class="mb-3">
                                <label for="formrow-email-input" class="">Department</label>
                                <select name="department" id="department" style="width:100%" >
                                  <option selected value="{{$department}}">{{$department_name.' ('.$selected_location_name.')'}}</option>
                                <?php
                                foreach($departments as $department){
                                    $location_name = OrganizationLocations::where('id', $department->location)->value('location');
                                ?>
                                 <option value="{{$department->id}}">{{$department->department.' ('.$location_name.')'}}</option>
                                <?php } ?>
                                 </select>

                                </div>
                                @if($errors->has("department")) <div class="alert alert-danger mt-2">{{ $errors->first('department') }}</li></div>@endif
                                 </div>
                                   <div class="col-sm-3">
                                <div class="mb-3">
                                <label for="formrow-email-input" class="">Employment Type</label>
                                <select name="employment_type" id="employment_type" style="width:100%" >
                               <option selected value="{{$employment_type}}">{{$employment_type}}</option>
                                 <option value="Full Time">Full Time</option>
                                 <option value="Part Time">Part Time</option>
                                 <option value="Intern">Intern</option>
                                 </select>

                                </div>
                                @if($errors->has("employment_type")) <div class="alert alert-danger mt-2">{{ $errors->first('employment_type') }}</li></div>@endif
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="epf_no" value="{{ $epf_no }}">
                                            <label class="form-label">EPF Number</label>
                                        </div>
                                    </div>
                                    @if($errors->has("epf_no")) <div class="alert alert-danger mt-2">{{ $errors->first('epf_no') }}</li></div>@endif
                                </div>
                                  <div class="col-sm-3">
                                <div class="form-group">
                                <label class="form-label">Appoinment Date</label>
                                        <div class="form-line">
                                            <input id="myDatePicker" name="appoinment_date" class="flatPicker flatpickr-input active" placeholder="Date of Birth" type="text" value="{{ $appoinment_date }}">
                                        </div>
                                    </div>
                                    @if($errors->has("appoinment_date")) <div class="alert alert-danger mt-2">{{ $errors->first('appoinment_date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" value="{{ $email }}">
                                            <label class="form-label">E-Mail</label>
                                        </div>
                                    </div>
                                    @if($errors->has("email")) <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="user_name" value="{{ $user_name }}">
                                            <label class="form-label">User Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("user_name")) <div class="alert alert-danger mt-2">{{ $errors->first('user_name') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="current_password">
                                            <label class="form-label">Current Password</label>
                                        </div>
                                    </div>
                                    @if($errors->has("current_password")) <div class="alert alert-danger mt-2">{{ $errors->first('current_password') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password">
                                            <label class="form-label">New Password</label>
                                        </div>
                                    </div>
                                    @if($errors->has("password")) <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password_confirmation">
                                            <label class="form-label">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Image</span>
                                                <input type="file" name="image">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="mb-3">
                                <label for="formrow-email-input" class="">Responsible Person</label>
                                <select name="responsible_person" id="responsible_person" style="width:100%" >
                                <option  value="{{$responsible_person}}" selected>{{$responsible_person_name}}</option>
                                <?php
                                foreach($hods as $hod){
                                ?>
                                 <option value="{{$hod->id}}"><?php echo OtherHODDetails::where('user_id', $hod->id)->value('name').' (HOD)' ?></option>
                                <?php } ?>
                                <?php
                                foreach($hrms as $hrm){
                                ?>
                                 <option value="{{$hrm->id}}"><?php echo OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name').' '.OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name').' (HRM)' ?></option>
                                <?php } ?>
                                </select>
                                </div>
                                @if($errors->has("responsible_person")) <div class="alert alert-danger mt-2">{{ $errors->first('responsible_person') }}</li></div>@endif
                                 </div>
                                <div class="col-sm-3">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" {{$check}} name="status">
                                                <span>Active Authoriser</span>
                                            </label>

                                </div>

                                <div class="col-sm-12">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">update</i><span class="icon-name">Update</span>

                                </button>
                                </div>

                    </div>
            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@include('layouts.footer')
<script>
$("#company").select2( {
	placeholder: "Select Company",
	allowClear: true,
	} );
    $("#department").select2( {
	placeholder: "Select Department",
	allowClear: true
	} );
    $("#designation").select2( {
	placeholder: "Select Designation",
	allowClear: true
	} );
    $("#office_shift").select2( {
	placeholder: "Select Office Shift",
	allowClear: true
	} );
    $("#employment_type").select2( {
	placeholder: "Select Employment Type",
	allowClear: true
	} );
	$("#responsible_person").select2( {
	placeholder: "Select Responsible Person",
	allowClear: true
	} );
</script>
