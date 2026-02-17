@include('layouts.header')
<?php
use App\Models\Designations;
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\PMProjectsEmployees;
use App\Models\OtherClientDetails;
use App\Models\PMTaskUsers;
use App\Models\OrganizationLocations;
use App\Models\LeaveTypes;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
foreach ($other_details as $other_detail)  {
    $name = $other_detail->name;
    $department = $other_detail->department;
    $phone = $other_detail->phone;
    $dob = $other_detail->dob;
    $image = $other_detail->image;
    $gender = $other_detail->gender;
    $department = $other_detail->department;
    $nic = $other_detail->nic;
    $employment_type = $other_detail->employment_type;
    $epf_no = $other_detail->epf_no;
    $appoinment_date = $other_detail->appoinment_date;
    $latitude = $other_detail->latitude;
    $longitude = $other_detail->longitude;
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
    $responsible_person = $other_detail->responsible_person;
    if($responsible_person == null){
     $responsible_person_name = "";
    }
    else{
     $responsible_person_name = OtherHRManagerDetails::where('user_id', $responsible_person)->value('first_name').' '.OtherHRManagerDetails::where('user_id', $responsible_person)->value('last_name').' (HRM)';
    }
}
foreach ($login_details as $login_details)  {
     $id = $login_details->id;
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
<style>
    .side-bar{
        border:1px solid #3a71c7;
        height: 350px;
    }


    .side-tab{
        background:#fff;
        color:#000;
        cursor: pointer;
    }
    .side-tab-active{
        background:#3a71c7;
        color:#fff;
        cursor: pointer;
    }
    .card .body .col-xs-12, .card .body .col-sm-12, .card .body .col-md-12, .card .body .col-lg-12 {
    margin-bottom: unset;
}
</style>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">
                        <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="#genaral" data-bs-toggle="tab" class="show active">
                                       Genarl
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile" data-bs-toggle="tab" class="">
                                       Profile
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#sallery" data-bs-toggle="tab">
                                        Set Sallery
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#leave" data-bs-toggle="tab">
                                        Leave
                                    </a>
                                </li>
                                <!--<li role="presentation">
                                    <a href="#core_hr" data-bs-toggle="tab">
                                        Core HR
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#project" data-bs-toggle="tab">
                                    Project & Task
                                    </a>
                                </li> -->
                                <li role="presentation">
                                    <a href="#payslip" data-bs-toggle="tab">
                                    Payslip
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="genaral">
                                    <div class="row">

                                    <div class="col-md-2 side-bar mt-4">
                                    <div class="row">
                                    <div class="col-md-12 side-tab genaraltabs side-tab-active" onclick="OpenTabGeneral(event, 'general_basic')">
                                    <h6 class="mt-3 mb-3">Basic</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_immigration')">
                                    <h6 class="mt-3 mb-3">Immigration</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_emergency')">
                                    <h6 class="mt-3 mb-3">Emergency Contacts</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_social')">
                                    <h6 class="mt-3 mb-3">Social Profile</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_document')">
                                    <h6 class="mt-3 mb-3">Document</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_qualification')">
                                    <h6 class="mt-3 mb-3">Qualification</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_work')">
                                    <h6 class="mt-3 mb-3">Work Experience</h6>
                                    </div>
                                    <div class="col-md-12 genaraltabs side-tab" onclick="OpenTabGeneral(event, 'general_bank')">
                                    <h6 class="mt-3 mb-3">Bank Account</h6>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-1 mt-4">
                                    </div>
                                    <div class="col-md-9 mt-4">
                                    @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif
                                    <div id="general_basic" class="genaraltabcontent">
                                    <form method="POST" action="{{ url('edit-authoriser-basic/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

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
                                            <input type="text" class="form-control" name="latitude" value="{{ $latitude}}">
                                            <label class="form-label">Latitude</label>
                                        </div>
                                    </div>
                                    @if($errors->has("latitude")) <div class="alert alert-danger mt-2">{{ $errors->first('latitude') }}</li></div>@endif
                                </div>
                                 <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="longitude" value="{{ $longitude }}">
                                            <label class="form-label">Longitude</label>
                                        </div>
                                    </div>
                                    @if($errors->has("longitude")) <div class="alert alert-danger mt-2">{{ $errors->first('longitude') }}</li></div>@endif
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
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nic" value="{{ $nic }}">
                                            <label class="form-label">NIC</label>
                                        </div>
                                    </div>
                                    @if($errors->has("nic")) <div class="alert alert-danger mt-2">{{ $errors->first('nic') }}</li></div>@endif
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


                                <div id="general_immigration" class="genaraltabcontent" style="display:none">
                                <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                                    <i class="material-icons">add</i>
                                    <span>Add Immigration</span>
                                </button>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Immigration</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-immigration/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="document_no" value="{{ old('document_no') }}" required>
                                            <label class="form-label">Document Number</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="document_type" required>

                                            <option selected hidden disabled>Document Type</option>
                                            <option value="Driving Licesnse">Driving Licesnse</option>
                                            <option value="Passport">Passport</option>
                                            <option value="National Id">National Id</option>
                                        </select></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="issue_date" class="flatPicker flatpickr-input active" placeholder="Issue Date" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="expire_date" class="flatPicker flatpickr-input active" placeholder="Expire Date" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="review_date" class="flatPicker flatpickr-input active" placeholder="Eligible Review Date" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="country" required>

                                            <option selected hidden disabled>Country</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select></div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Document</span>
                                                <input type="file" name="document" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Document No</th>
                                            <th class="">Document Type</th>
                                            <th class=""> Issue Date </th>
                                            <th class=""> Expire Date </th>
                                            <th class=""> Review Date </th>
                                            <th class="">Document</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($immigrations as $immigration){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td class="">{{$immigration->document_no}}</td>
                                            <td class="">{{$immigration->document_type}}</td>
                                            <td class="">{{$immigration->issue_date}}</td>
                                            <td class="">{{$immigration->expire_date}}</td>
                                            <td class="">{{$immigration->review_date}}</td>
                                            <td class=""><a href="{{ asset('immigration_documents/'.$immigration->document.'')  }}" download>Download</a></td>
                                            <td class="">
                                                <a href="{{ url('edit-immigration/'.$immigration->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-immigration/'.$immigration->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Document No</th>
                                            <th class="">Document Type</th>
                                            <th class=""> Issue Date </th>
                                            <th class=""> Expire Date </th>
                                            <th class=""> Review Date </th>
                                            <th class="">Document</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


                                <div id="general_emergency" class="genaraltabcontent" style="display:none">
                                <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add-general-emergency-modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Contact</span>
                                </button>
                                <div class="modal fade add-general-emergency-modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Contact</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-contact/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="relation">

                                            <option selected hidden disabled>Relation</option>
                                            <option value="Self">Self</option>
                                            <option value="Parent">Parent</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Child">Child</option>
                                            <option value="Sibling">Sibling</option>
                                            <option value="In Laws">In Laws</option>
                                        </select></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email_work" value="{{ old('email_work') }}">
                                            <label class="form-label">E-Mail Work</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email_personal" value="{{ old('email_personal') }}" required>
                                            <label class="form-label">E-Mail Personal</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="address_line1" value="{{ old('address_line1') }}" required>
                                            <label class="form-label">Address Line 1</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="address_line2" value="{{ old('address_line2') }}">
                                            <label class="form-label">Address Line 2</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mobile_work" value="{{ old('mobile_work') }}">
                                            <label class="form-label">Mobile Work</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mobile_ext" value="{{ old('mobile_ext') }}">
                                            <label class="form-label">Mobile Ext</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mobile_personal" value="{{ old('mobile_personal') }}" required>
                                            <label class="form-label">Mobile Personal</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mobile_home" value="{{ old('mobile_home') }}">
                                            <label class="form-label">Mobile Home</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                                            <label class="form-label">City</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="state_province" value="{{ old('state_province') }}">
                                            <label class="form-label">State/Province</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="zip" value="{{ old('zip') }}">
                                            <label class="form-label">ZIP</label>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="country">

                                            <option selected hidden disabled>Country</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select></div>
                                    </div>
                                </div>

                                <div class="col-sm-4">

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Relation</th>
                                            <th class="center">Name</th>

                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($contacts as $contact){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$contact->relation}}</td>
                                            <td >{{$contact->name}}</td>
                                            <td >
                                                <a href="{{ url('edit-contact/'.$contact->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-contact/'.$contact->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Relation</th>
                                            <th class="center">Name</th>

                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>



                                <div id="general_social" class="genaraltabcontent" style="display:none">
                                <form method="POST" action="{{ url('add-social-profile/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <?php
                if($social_profile == null || $social_profile->isEmpty()){
                $facebook_profile = "";
                $skype_profile = "";
                $linkedIn_profile = "";
                $twitter_profile = "";
                $whatsapp_profile = "";
                }
                else{
                foreach($social_profile as $social_pro){
                    $facebook_profile = $social_pro->facebook_profile;
                    $skype_profile = $social_pro->skype_profile;
                    $linkedIn_profile = $social_pro->linkedIn_profile;
                    $twitter_profile = $social_pro->twitter_profile;
                    $whatsapp_profile = $social_pro->whatsapp_profile;
                }
                }
                ?>
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="facebook_profile" value="{{ $facebook_profile }}" required>
                                            <label class="form-label">Facebok Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="skype_profile" value="{{ $skype_profile }}" required>
                                            <label class="form-label">Skype Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="linkedIn_profile" value="{{ $linkedIn_profile }}" required>
                                            <label class="form-label">LinkedIn Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="twitter_profile" value="{{ $twitter_profile }}" required>
                                            <label class="form-label">Twitter Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="whatsapp_profile" value="{{ $whatsapp_profile }}" required>
                                            <label class="form-label">Whats App Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">SAVE</span>

                                </button>
                                </div>

                    </div>
            </form>
                                </div>



                                <div id="general_document" class="genaraltabcontent" style="display:none">
                                <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_general_document_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Document</span>
                                </button>
                                <div class="modal fade add_general_document_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Document</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-document/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                            <label class="form-label">Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="document_type" required>

                                            <option selected hidden disabled>Document Type</option>
                                            <option value="Driving Licesnse">Driving Licesnse</option>
                                            <option value="Passport">Passport</option>
                                            <option value="National Id">National Id</option>
                                        </select></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="input-field col s12">
                                        <textarea id="textarea2" class="materialize-textarea" name="discription"></textarea>
                                        <label for="textarea2" class="">Description</label>
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Document</span>
                                                <input type="file" name="document" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                        <div class="form-line">
                                            <input id="myDatePicker" name="expire_date" class="flatPicker flatpickr-input active" placeholder="Expire Date" type="text" >
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">

                                    <label>
                                        <input type="checkbox" class="filled-in" name="send_notification">
                                        <span>Send Notification?
                                        (will get notification email before 3 days of expiry date)</span>
                                    </label>

                        </div>


                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Title</th>
                                            <th class="">Document Type</th>
                                            <th class="">Expire Date</th>
                                            <th class="">Send Notification</th>
                                            <th class="">Document</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($documents as $document){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td class="">{{$document->title}}</td>
                                            <td class="">{{$document->document_type}}</td>
                                            <td class="">{{$document->expire_date}}</td>
                                            <td class="">{{$document->send_notification}}</td>

                                            <td class=""><a href="{{ asset('genaral_document_documents/'.$document->document.'')  }}" download>Download</a></td>
                                            <td class="">
                                                <a href="{{ url('edit-document/'.$document->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-document/'.$document->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Title</th>
                                            <th class="">Document Type</th>
                                            <th class="">Expire Date</th>
                                            <th class="">Send Notification</th>
                                            <th class="">Document</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>



                                <div id="general_qualification" class="genaraltabcontent" style="display:none">
                                <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_general_qualification_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Qualifications</span>
                                </button>
                                <div class="modal fade add_general_qualification_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Qualifications</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-qulification/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="school_university" value="{{ old('school_university') }}" required>
                                            <label class="form-label">School/University</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="education_level" >

                                            <option selected hidden disabled>Education Level</option>
                                            <option value="BSC">BSC</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="BBA">BBA</option>
                                        </select></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="from" class="flatPicker flatpickr-input active" placeholder="From" type="text" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="to" class="flatPicker flatpickr-input active" placeholder="To" type="text" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="language" >

                                            <option selected hidden disabled>Language</option>
                                            <option value="English">English</option>
                                            <option value="Arabic">Arabic</option>

                                        </select></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="professional_skills" >

                                            <option selected hidden disabled>Professional Skills</option>
                                            <option value="MS Word">MS Word</option>
                                            <option value="Photoshop">Photoshop</option>

                                        </select></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="input-field col s12">
                                        <textarea id="textarea2" class="materialize-textarea" name="discription"></textarea>
                                        <label for="textarea2" class="">Description</label>
                                   </div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">School/University</th>
                                            <th class="">Education Level</th>
                                            <th class="">From</th>
                                            <th class="">To</th>
                                            <th class="">Language</th>
                                            <th class="">Professional Skills</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($qulifications as $qulification){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$qulification->school_university}}</td>
                                            <td >{{$qulification->education_level}}</td>
                                            <td>{{$qulification->from_date}}</td>
                                            <td >{{$qulification->to_date}}</td>
                                            <td >{{$qulification->language}}</td>
                                            <td >{{$qulification->professional_skills}}</td>
                                            <td>
                                                <a href="{{ url('edit-qulification/'.$qulification->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-qulification/'.$qulification->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">School/University</th>
                                            <th class="">Education Level</th>
                                            <th class="">From</th>
                                            <th class="">To</th>
                                            <th class="">Language</th>
                                            <th class="">Professional Skills</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>



                                <div id="general_work" class="genaraltabcontent" style="display:none">
                                <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_general_work_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Work Experience</span>
                                </button>
                                <div class="modal fade add_general_work_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Work Experience</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-work/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="company" value="{{ old('company') }}" required>
                                            <label class="form-label">Company</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="from_date" class="flatPicker flatpickr-input active" placeholder="From" type="text" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="myDatePicker" name="to_date" class="flatPicker flatpickr-input active" placeholder="To" type="text" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="post" value="{{ old('post') }}" required>
                                            <label class="form-label">Post</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="input-field col s12">
                                        <textarea id="textarea2" class="materialize-textarea" name="discription"></textarea>
                                        <label for="textarea2" class="">Description</label>
                                   </div>
                                </div>
                                <div class="col-sm-4">

                                </div>


                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Company</th>
                                            <th class="">From</th>
                                            <th class="">To</th>
                                            <th class="">Post</th>
                                            <th class="">Description</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($works as $work){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$work->company}}</td>
                                            <td >{{$work->from_date}}</td>
                                            <td >{{$work->to_date}}</td>
                                            <td >{{$work->post}}</td>
                                            <td >{{$work->discription}}</td>
                                            <td>
                                                <a href="{{ url('edit-work/'.$work->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-work/'.$work->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Company</th>
                                            <th class="">From</th>
                                            <th class="">To</th>
                                            <th class="">Post</th>
                                            <th class="">Description</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


                                <div id="general_bank" class="genaraltabcontent" style="display:none">
                                <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_general_bank_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Bank Account</span>
                                </button>
                                <div class="modal fade add_general_bank_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Bank Account</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-bank-account/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="account_title" value="{{ old('account_title') }}" required>
                                            <label class="form-label">Account Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}" required>
                                            <label class="form-label">Account Number</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}" required>
                                            <label class="form-label">Bank Name</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bank_code" value="{{ old('bank_code') }}" required>
                                            <label class="form-label">Bank Code</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bank_branch" value="{{ old('bank_branch') }}" required>
                                            <label class="form-label">Bank Branch</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">

                                </div>


                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Account Title</th>
                                            <th class="center">Account Number</th>
                                            <th class="center">Bank Name</th>
                                            <th class="center">Bank Code</th>
                                            <th class="center">Bank Branch</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($bank_accounts as $bank_account){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$bank_account->account_title}}</td>
                                            <td >{{$bank_account->account_number}}</td>
                                            <td >{{$bank_account->bank_name}}</td>
                                            <td >{{$bank_account->bank_code}}</td>
                                            <td >{{$bank_account->bank_branch}}</td>
                                            <td>
                                                <a href="{{ url('edit-bank-account/'.$bank_account->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-bank-account/'.$bank_account->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="center">Account Title</th>
                                            <th class="center">Account Number</th>
                                            <th class="center">Bank Name</th>
                                            <th class="center">Bank Code</th>
                                            <th class="center">Bank Branch</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>




                                    </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                <form method="POST" action="{{ url('change-authoriser-image/'.$id) }}" enctype="multipart/form-data">
                                 @csrf
                                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                <img src="{{ asset('user_images/'.$image.'') }}" alt="" style="width:50%;">
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">
                                <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Profile Image</span>
                                                <input type="file" name="image" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>

                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="sallery">
                                <div class="row">
                                <div class="col-md-2 side-bar mt-4">
                                    <div class="row">
                                    <div class="col-md-12 side-tab salarytabs side-tab-active" onclick="OpenTabSalary(event, 'sallery_basic')">
                                    <h6 class="mt-3 mb-3">Basic Salary</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_allowances')">
                                    <h6 class="mt-3 mb-3">Allowances</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_commissions')">
                                    <h6 class="mt-3 mb-3">Commissions</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_loan')">
                                    <h6 class="mt-3 mb-3">Loan</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_statutory_deductions')">
                                    <h6 class="mt-3 mb-3">Statutory Deductions</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_other_payment')">
                                    <h6 class="mt-3 mb-3">Other Payment</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_overtime')">
                                    <h6 class="mt-3 mb-3">Overtime</h6>
                                    </div>
                                    <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_pension')">
                                    <h6 class="mt-3 mb-3">Salary Pension</h6>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-1 mt-4">
                                    </div>

                                    <div class="col-md-9 mt-4">
                                    @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif

                                    <div id="sallery_basic" class="sallerytabcontent" >
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_basic_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Basic Salary</span>
                                </button>
                                <div class="modal fade add_salery_basic_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Basic Salary</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-basic-salary/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="payslip_type" required>

                                            <option selected hidden disabled>Payslip Type</option>
                                            <option value="Monthly Payslip">Monthly Payslip</option>
                                            <option value="Hourly Payslip">Hourly Payslip</option>
                                        </select></div>

                                </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="basic_salary" value="" required="">
                                            <label class="form-label"> Basic Salary</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Payslip Type</th>
                                            <th class="">Basic Salary</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($basic_salarys as $basic_salary){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$basic_salary->month_year}}</td>
                                            <td >{{$basic_salary->payslip_type}}</td>
                                            <td>{{$basic_salary->basic_salary}}</td>
                                            <td>
                                                <a href="{{ url('edit-basic-salary/'.$basic_salary->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-basic-salary/'.$basic_salary->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Payslip Type</th>
                                            <th class="">Basic Salary</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_allowances" class="sallerytabcontent" style="display:none;">
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_allowances_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Allowances</span>
                                </button>
                                <div class="modal fade add_salery_allowances_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Allowances</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-allowances/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                <div class="form-group default-select">
                                        <div class="select-wrapper focused"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-cc1ee713-46cf-5679-473b-6d23347bba08"><ul id="select-options-cc1ee713-46cf-5679-473b-6d23347bba08" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba080" tabindex="0" class="selected"><span>Odsad</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba081" tabindex="0"><span>Option 2</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba082" tabindex="0"><span>Option 3</span></li><li id="select-options-cc1ee713-46cf-5679-473b-6d23347bba083" tabindex="0"><span>Option 4</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                        <select class="form-control " tabindex="-1" name="allowance_type" required>

                                            <option selected hidden disabled>Allowance Type</option>
                                            <option value="Taxable">Taxable</option>
                                            <option value="Non-Taxable">Non-Taxable</option>
                                        </select></div>

                                </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="allowance_title" value="" required="">
                                            <label class="form-label">Allowance Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="allowance_amount" value="" required="">
                                            <label class="form-label">Allowance Amount</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Allowance Type</th>
                                            <th class="">Allowance Title</th>
                                            <th class="">Allowance Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($allowances as $allowance){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$allowance->month_year}}</td>
                                            <td >{{$allowance->allowance_type}}</td>
                                            <td>{{$allowance->allowance_title}}</td>
                                            <td>{{$allowance->allowance_amount}}</td>
                                            <td>
                                                <a href="{{ url('edit-allowances/'.$allowance->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-allowances/'.$allowance->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Allowance Type</th>
                                            <th class="">Allowance Title</th>
                                            <th class="">Allowance Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>
                                <div id="sallery_commissions" class="sallerytabcontent" style="display:none;">
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_commissions_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Commissions</span>
                                </button>
                                <div class="modal fade add_salery_commissions_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Commissions</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-commissions/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="commission_title" value="" required="">
                                            <label class="form-label">Commission Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="commission_amount" value="" required="">
                                            <label class="form-label">Commission Amount</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Commission Title</th>
                                            <th class="">Commission Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($commissions as $commission){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$commission->month_year}}</td>
                                            <td>{{$commission->commission_title}}</td>
                                            <td>{{$commission->commission_amount}}</td>
                                            <td>
                                                <a href="{{ url('edit-commissions/'.$commission->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-commissions/'.$commission->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Commission Title</th>
                                            <th class="">Commission Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_loan" class="sallerytabcontent" style="display:none;">
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_loan_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Loan</span>
                                </button>
                                <div class="modal fade add_salery_loan_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Loan</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-loan/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <select class="form-control " tabindex="-1" name="loan_option" required="">
                                            <option selected="" hidden="" disabled="">Loan Option</option>
                                            <option value="Social Security System Loan">Social Security System Loan</option>
                                            <option value="Home Development Mututal Fund Loan">Home Development Mututal Fund Loan</option>
                                            <option value="Other Loan">Other Loan</option>
                                        </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="" required="">
                                            <label class="form-label">Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="amount" value="" required="">
                                            <label class="form-label">Amount</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="number_of_installments" value="" required="">
                                            <label class="form-label">Number of Installments</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                <div class="input-field col s12">
                                        <textarea id="textarea2" class="materialize-textarea" name="reason" style="height: 36px;"></textarea>
                                        <label for="textarea2" class="">Reason</label>
                                   <span class="character-counter" style="float: right; font-size: 12px;">0</span></div>
                                </div>
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Loan Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class="">Number of Installments</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($loans as $loan){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$loan->month_year}}</td>
                                            <td>{{$loan->loan_option}}</td>
                                            <td>{{$loan->title}}</td>
                                            <td>{{$loan->amount}}</td>
                                            <td>{{$loan->number_of_installments}}</td>
                                            <td>
                                                <a href="{{ url('edit-loan/'.$loan->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-loan/'.$loan->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Loan Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class="">Number of Installments</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


                                <div id="sallery_statutory_deductions" class="sallerytabcontent" style="display:none;">
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_deductions_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Deductions</span>
                                </button>
                                <div class="modal fade add_salery_deductions_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Deductions</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-deduction/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <select class="form-control " tabindex="-1" name="deduction_option" required="">
                                            <option selected="" hidden="" disabled="">Deduction Option</option>
                                            <option value="Social Security System">Social Security System</option>
                                            <option value="Health insurance Coparation">Health insurance Coparation</option>
                                            <option value="Home Develpment Mutual Funds">Home Develpment Mutual Funds</option>
                                            <option value="Withdrowing Tax on Wages">Withdrowing Tax on Wages</option>
                                             <option value="Other Satuary Deductions">Other Satuary Deductions</option>
                                        </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="" required="">
                                            <label class="form-label">Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="amount" value="" required="">
                                            <label class="form-label">Amount</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Deduction Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($deductions as $deduction){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$deduction->month_year}}</td>
                                            <td>{{$deduction->deduction_option}}</td>
                                            <td>{{$deduction->title}}</td>
                                            <td>{{$deduction->amount}}</td>
                                            <td>
                                                <a href="{{ url('edit-deduction/'.$deduction->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-deduction/'.$deduction->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">Month/Year</th>
                                            <th class="">Deduction Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_other_payment" class="sallerytabcontent" style="display:none;">
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_other_payment_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Other Payment</span>
                                </button>
                                <div class="modal fade add_salery_other_payment_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Other Payment</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-payment/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="" required="">
                                            <label class="form-label">Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="amount" value="" required="">
                                            <label class="form-label">Amount</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($payments as $payment){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$payment->month_year}}</td>
                                            <td>{{$payment->title}}</td>
                                            <td>{{$payment->amount}}</td>
                                            <td>
                                                <a href="{{ url('edit-payment/'.$payment->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-payment/'.$payment->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_overtime" class="sallerytabcontent" style="display:none;">
                                    <button type="button" class="btn bg-blue waves-effect mt-4" data-bs-toggle="modal" data-bs-target=".add_salery_overtime_modal">
                                    <i class="material-icons">add</i>
                                    <span>Add Overtime</span>
                                </button>
                                <div class="modal fade add_salery_overtime_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Add Overtime</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                 <form method="POST" action="{{ url('add-overtime/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_year" value="" required="" id="datepicker">
                                            <label class="form-label">Month Year</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="" required="">
                                            <label class="form-label">Title</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="no_of_days" value="" required="">
                                            <label class="form-label">Number of Days</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="total_hours" value="" required="">
                                            <label class="form-label">Total Hours</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="rate" value="" required="">
                                            <label class="form-label">Rate</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">No of Days</th>
                                            <th class="">Total Hours</th>
                                            <th class="">Rate</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($overtimes as $overtime){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$overtime->month_year}}</td>
                                            <td>{{$overtime->title}}</td>
                                            <td>{{$overtime->no_of_days}}</td>
                                            <td>{{$overtime->total_hours}}</td>
                                            <td>{{$overtime->rate}}</td>
                                            <td>
                                                <a href="{{ url('edit-overtime/'.$overtime->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                                <a href="{{ url('delete-overtime/'.$overtime->id) }}">
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete_forever</i>
                                                </button>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">No of Days</th>
                                            <th class="">Total Hours</th>
                                            <th class="">Rate</th>
                                            <th class=""> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                            <div id="sallery_pension" class="sallerytabcontent" style="display:none;">
                            <form method="POST" action="{{ url('add-pension/'.$id) }}" enctype="multipart/form-data">
                 @csrf
                    <div class="row clearfix  mt-4">
                    <?php
                    if($pensions == null || $pensions->isEmpty()){
                        $pansion_type = null;
                        $amount = "";
                    }
                    else{
                    foreach ($pensions as $pansion)  {
                        $pansion_type = $pansion->pansion_type;
                        $amount = $pansion->amount;
                    }
                    }

                    ?>
                    <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <select class="form-control " tabindex="-1" name="pansion_type" required="">
                                            <?php
                                            if($pansion_type == null){ ?>
                                            <option selected="" hidden="" disabled="">Pansion Type</option>
                                           <?php }else{ ?>
                                            <option selected="" hidden="" >{{$pansion_type}}</option>
                                          <?php }
                                            ?>
                                            <option value="Fixed">Fixed</option>
                                             <option value="Presentage">Presentage</option>
                                        </select>
                                        </div>
                                    </div>
                     </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="amount" value="{{$amount}}" required="">
                                            <label class="form-label">Amount</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">

                                        <i class="material-icons">account_circle</i><span class="icon-name">ADD</span>

                                </button>
                                </div>

                    </div>
            </form>
                            </div>


                                    </div>


                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="leave">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Leave Type</th>
                                            <th class="center">Department</th>
                                            <th class="center">Employee</th>
                                            <th class="center">Leave Duration</th>
                                            <th class="center">Status</th>
                                            <th class="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($leaves as $leave){
                                        $employee_name = OtherEmployeeDetails::where('user_id', $leave->employee)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $leave->employee)->value('last_name');
                                        $department_name = OrganizationDepartments::where('id', $leave->department)->value('department');
                                        if($leave->leave_type == "special"){
                                            $leave_type_name =  "special";
                                        }
                                        else{
                                        $leave_type_name = LeaveTypes::where('id', $leave->leave_type)->value('leave_type');
                                    }
                                   ?>
                                        <tr class="odd gradeX">
                                            <td class="">{{$leave_type_name}} </td>
                                            <td class="">{{$department_name}} </td>
                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$leave->leave_duration}} </td>
                                            <td class="">{{$leave->status}} </td>
                                            <td>
                                                <a href="{{ url('view-leave/'.$leave->id) }}">
                                                <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="center">Leave Type</th>
                                            <th class="center">Department</th>
                                            <th class="center">Employee</th>
                                            <th class="center">Leave Duration</th>
                                            <th class="center">Status</th>
                                            <th class="center">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


 <div role="tabpanel" class="tab-pane fade" id="core_hr">
 <div class="row">
<div class="col-md-2 side-bar mt-4">
<div class="row">
<div class="col-md-12 side-tab corehrtabs side-tab-active" onclick="OpenTabCoreHR(event, 'corehr_promotions')">
<h6 class="mt-3 mb-3">Promotions</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_awards')">
<h6 class="mt-3 mb-3">Awards</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_travels')">
<h6 class="mt-3 mb-3">Travels</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_transfers')">
<h6 class="mt-3 mb-3">Transfers</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_resignations')">
<h6 class="mt-3 mb-3">Resignations</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_complaints')">
<h6 class="mt-3 mb-3">Complaints</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_warnings')">
<h6 class="mt-3 mb-3">Warnings</h6>
</div>
<div class="col-md-12 corehrtabs side-tab" onclick="OpenTabCoreHR(event, 'corehr_terminations')">
<h6 class="mt-3 mb-3">Terminations</h6>
</div>
</div>
</div>
<div class="col-md-1 mt-4">
</div>
<div class="col-md-9 mt-4">
@if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif

                            <div id="corehr_promotions" class="corehrtabcontent" >
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Promotion Title</th>
                                            <th class="center">Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_promotions as $corehr_promotion){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$corehr_promotion->title}}</td>
                                            <td>{{$corehr_promotion->promotion_date}}</td>
                                             <td >
                                                <a href="{{ url('view-core-hr-promotion/'.$corehr_promotion->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Promotion Title</th>
                                            <th class="center">Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>

                            <div id="corehr_awards" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Award Name</th>
                                            <th class="center">Gift</th>
                                            <th class="center">Award Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_awrds as $corehr_awrd){

                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$corehr_awrd->award_type}}</td>
                                            <td>{{$corehr_awrd->gift}}</td>
                                            <td>{{$corehr_awrd->award_date}}</td>
                                             <td >
                                                <a href="{{ url('view-core-hr-award/'.$corehr_awrd->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                     <th class="center">Award Name</th>
                                            <th class="center">Gift</th>
                                            <th class="center">Award Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                            <div id="corehr_travels" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Place of Visit</th>
                                            <th class="center">Purpose of Vist</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_travels as $corehr_travel){

                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$corehr_travel->visit_place}}</td>
                                            <td>{{$corehr_travel->visit_purpose}}</td>
                                            <td>{{$corehr_travel->start_date}}</td>
                                            <td>{{$corehr_travel->end_date}}</td>
                                             <td >
                                                <a href="{{ url('view-core-hr-travel/'.$corehr_travel->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Place of Visit</th>
                                            <th class="center">Purpose of Vist</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                            <div id="corehr_transfers" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">From Department</th>
                                            <th class="center">To Department</th>
                                            <th class="center">Transfer Date</th>

                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_transfers as $corehr_transfer){
                                    $from_department_name = OrganizationDepartments::where('id', $corehr_transfer->from_department)->value('department');
                                    $to_department_name = OrganizationDepartments::where('id', $corehr_transfer->to_department)->value('department');
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$from_department_name}}</td>
                                            <td>{{$to_department_name}}</td>
                                            <td>{{$corehr_transfer->transfer_date}}</td>

                                             <td >
                                                <a href="{{ url('view-core-hr-transfer/'.$corehr_transfer->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">From Department</th>
                                            <th class="center">To Department</th>
                                            <th class="center">Transfer Date</th>

                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                            <div id="corehr_resignations" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Department</th>
                                            <th class="center">Notice Date</th>
                                            <th class="center">Resignation Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_resignations as $corehr_resignation){
                                    $department = OrganizationDepartments::where('id', $corehr_resignation->department)->value('department');
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$department}}</td>
                                            <td>{{$corehr_resignation->notice_date}}</td>
                                            <td>{{$corehr_resignation->resignation_date}}</td>

                                             <td >
                                                <a href="{{ url('view-core-hr-resignations/'.$corehr_resignation->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Department</th>
                                            <th class="center">Notice Date</th>
                                            <th class="center">Resignation Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                            <div id="corehr_complaints" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Complaint From</th>
                                            <th class="center">Complaint Against</th>
                                            <th class="center">Complaint Title</th>
                                            <th class="center">Complaint Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_complaints as $corehr_complaint){
                                    $complaint_from = OtherEmployeeDetails::where('user_id', $corehr_complaint->complaint_from)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $corehr_complaint->complaint_from)->value('last_name');
                                    $complaint_against = OtherEmployeeDetails::where('user_id', $corehr_complaint->complaint_against)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $corehr_complaint->complaint_against)->value('last_name');
                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$complaint_from}}</td>
                                            <td >{{$complaint_against}}</td>
                                            <td>{{$corehr_complaint->complaint_title}}</td>
                                            <td>{{$corehr_complaint->complaint_date}}</td>

                                             <td >
                                                <a href="{{ url('view-core-hr-complaint/'.$corehr_complaint->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Complaint From</th>
                                            <th class="center">Complaint Against</th>
                                            <th class="center">Complaint Title</th>
                                            <th class="center">Complaint Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                            <div id="corehr_warnings" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Employee</th>
                                            <th class="center">Warning Type</th>
                                            <th class="center">Subject</th>
                                            <th class="center">Warning Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_warnings as $corehr_warning){
                                    $employee = OtherEmployeeDetails::where('user_id', $corehr_warning->employee)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $corehr_complaint->complaint_from)->value('last_name');

                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$employee}}</td>
                                            <td >{{$corehr_warning->warning_type}}</td>
                                            <td>{{$corehr_warning->subject}}</td>
                                            <td>{{$corehr_warning->warning_date}}</td>

                                             <td >
                                                <a href="{{ url('view-core-hr-warning/'.$corehr_warning->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Employee</th>
                                            <th class="center">Warning Type</th>
                                            <th class="center">Subject</th>
                                            <th class="center">Warning Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                            <div id="corehr_terminations" class="corehrtabcontent" style="display:none;">
                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Employee</th>
                                            <th class="center">Trmination Type</th>
                                            <th class="center">Termination Date</th>
                                            <th class="center">Notice Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($corehr_terminations as $corehr_termination){
                                    $employee = OtherEmployeeDetails::where('user_id', $corehr_termination->employee)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $corehr_termination->complaint_from)->value('last_name');

                                    ?>
                                        <tr class="odd gradeX">

                                            <td >{{$employee}}</td>
                                            <td >{{$corehr_termination->termination_type}}</td>
                                            <td>{{$corehr_termination->termination_date}}</td>
                                            <td>{{$corehr_termination->notice_date}}</td>

                                             <td >
                                                <a href="{{ url('view-core-hr-termination/'.$corehr_termination->id) }}">
                                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" data-bs-toggle="modal" data-bs-target=".edit-imigration-modal{{$immigration->id}}">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Employee</th>
                                            <th class="center">Trmination Type</th>
                                            <th class="center">Termination Date</th>
                                            <th class="center">Notice Date</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>


</div>
</div>
</div>



                                <div role="tabpanel" class="tab-pane fade" id="project">
                                <section class="">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>Projects</strong>
                            </h2>


                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                        <th class="center">Project Name</th>
                                            <th class="center">Priority</th>
                                            <th class="center">Assigned Employee</th>
                                            <th class="center">Client</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Progress</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($projects as $projects){
                                        $client = OtherClientDetails::where('user_id', $projects->client)->value('first_name').' '.OtherClientDetails::where('user_id', $projects->client)->value('last_name');
                                        if(PMProjectsEmployees::where('project_id', $projects->id)->where('employee_id', $id)->exists()){
                                            $assigned_empoyees = PMProjectsEmployees::where('project_id', $projects->id)->get();
                                        ?>
                                        <tr class="odd gradeX">
                                            <td class="">{{$projects->title}} </td>
                                            <td class="">{{$projects->priority}} </td>
                                            <td class="">
                                            <?php foreach($assigned_empoyees as $assigned_empoyee){
                                            echo OtherEmployeeDetails::where('user_id', $assigned_empoyee->employee_id)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $assigned_empoyee->employee_id)->value('last_name').',';
                                            } ?>
                                            </td>
                                            <td class="">{{$client}} </td>
                                            <td class="">{{$projects->start_date}} </td>
                                            <td class="">{{$projects->end_date}} </td>
                                            <td class="">
                                            <div class="progress">
                                            <div class="progress-bar width-per-{{$projects->progress}} " role="progressbar" aria-valuenow="{{$projects->progress}} " aria-valuemin="0" aria-valuemax="100">{{$projects->progress}} %</div>
                                            </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('view-project/'.$projects->id) }}">
                                                <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php
                                    }} ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Project Name</th>
                                            <th class="center">Priority</th>
                                            <th class="center">Assigned Employee</th>
                                            <th class="center">Client</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Progress</th>
                                            <th class="center"> Action </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="header mt-5">
                            <h2>
                                <strong>Tasks</strong>
                            </h2>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                    <tr>
                                            <th class="center">Title</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Status</th>
                                            <th class="center">Assigned Employees</th>
                                            <th class="center">Task Progress</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($tasks as $task){
                                        if(PMTaskUsers::where('task_id', $task->id)->where('user_id', $id)->exists()){
                                            $assigned_empoyees = PMTaskUsers::where('task_id', $task->id)->get();
                                        ?>
                                        <tr class="odd gradeX">
                                             <td class="">{{$task->title}} </td>
                                            <td class="">{{$task->start_date}} </td>
                                            <td class="">{{$task->end_date}} </td>
                                            <td class="">{{$task->status}} </td>
                                            <td class="">
                                            <?php foreach($assigned_empoyees as $assigned_empoyee){
                                            echo OtherEmployeeDetails::where('user_id', $assigned_empoyee->user_id)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $assigned_empoyee->user_id)->value('last_name').',';
                                            } ?>
                                            </td>
                                            <td class="">
                                            <div class="progress">
                                            <div class="progress-bar width-per-{{$task->progress}} " role="progressbar" aria-valuenow="{{$task->progress}} " aria-valuemin="0" aria-valuemax="100">{{$task->progress}} %</div>
                                            </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('view-task/'.$task->id) }}">
                                                <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">visibility</i>
                                                </button>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php
                                    }} ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="center">Title</th>
                                            <th class="center">Start Date</th>
                                            <th class="center">End Date</th>
                                            <th class="center">Status</th>
                                            <th class="center">Assigned Employees</th>
                                            <th class="center">Task Progress</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="payslip">
                                <a href="{{ url('download-pay-slip/'.$id) }}">
                                        <button type="button" class="btn btn-info  ">
                                        Download
                                        </button>
                                </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@include('layouts.footer')
<script>
    function OpenTabGeneral(evt, tabname) {
  var x, tabcontent, tabinks;
  tabcontent = document.getElementsByClassName("genaraltabcontent");
  for (x = 0; x < tabcontent.length; x++) {
    tabcontent[x].style.display = "none";
  }
  tabinks = document.getElementsByClassName("genaraltabs");
  for (x = 0; x < tabinks.length; x++) {
    tabinks[x].className = tabinks[x].className.replace(" side-tab-active", "");
  }
  document.getElementById(tabname).style.display = "block";
  evt.currentTarget.className += " side-tab-active";
}
function OpenTabSalary(evt, tabname) {
  var x, tabcontent, tabinks;
  tabcontent = document.getElementsByClassName("sallerytabcontent");
  for (x = 0; x < tabcontent.length; x++) {
    tabcontent[x].style.display = "none";
  }
  tabinks = document.getElementsByClassName("salarytabs");
  for (x = 0; x < tabinks.length; x++) {
    tabinks[x].className = tabinks[x].className.replace(" side-tab-active", "");
  }
  document.getElementById(tabname).style.display = "block";
  evt.currentTarget.className += " side-tab-active";
}
function OpenTabCoreHR(evt, tabname) {
  var x, tabcontent, tabinks;
  tabcontent = document.getElementsByClassName("corehrtabcontent");
  for (x = 0; x < tabcontent.length; x++) {
    tabcontent[x].style.display = "none";
  }
  tabinks = document.getElementsByClassName("corehrtabs");
  for (x = 0; x < tabinks.length; x++) {
    tabinks[x].className = tabinks[x].className.replace(" side-tab-active", "");
  }
  document.getElementById(tabname).style.display = "block";
  evt.currentTarget.className += " side-tab-active";
}
</script>
<script>
$("#company").select2( {
  placeholder: "Select Company",
  allowClear: true
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
<script>
$("#document_type2").select2( {
  placeholder: "Select Document Type",
  allowClear: true
  } );
    $("#country2").select2( {
  placeholder: "Select Country",
  allowClear: true
  } );

</script>
