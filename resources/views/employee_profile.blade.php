@include('layouts.header')
<?php
use App\Models\Designations;
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
foreach ($other_details as $other_detail)  {
    $first_name = $other_detail->first_name;
    $last_name = $other_detail->last_name;
    $phone = $other_detail->phone;
    $dob = $other_detail->dob;
    $gender = $other_detail->gender;
    $department = $other_detail->department;
    $designation = $other_detail->designation;
    $office_shift = $other_detail->office_shift;
     $employment_type = $other_detail->employment_type;
    $join_date = $other_detail->join_date;
    $epf_no = $other_detail->epf_no;
    $image = $other_detail->image;
    $appoinment_date= $other_detail->appoinment_date;
     $responsible_person = $other_detail->responsible_person;
    $responsible_person_user_role = User::where('id',$responsible_person)->value('user_role');
    if($responsible_person_user_role == 5){
     $responsible_person_name = OtherHODDetails::where('user_id', $responsible_person)->value('name').' (HOD)';
    }
    elseif($responsible_person_user_role == 2){
     $responsible_person_name = OtherHRManagerDetails::where('user_id', $responsible_person)->value('first_name').' '.OtherHRManagerDetails::where('user_id', $responsible_person)->value('last_name').' (HRM)';   
    }
    else{
       $responsible_person_name = OtherAuthoriserDetails::where('user_id', $responsible_person)->value('name').' (Authoriser)';  
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
                <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Profile</h4>
                            </li>

                        </ul>
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
                                    <a href="#core_hr" data-bs-toggle="tab">
                                        Core HR
                                    </a>
                                </li>

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
                                    <form method="POST" action="{{ url('edit-employee-basic/'.$id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="first_name" value="{{ $first_name }}" disabled>
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("first_name")) <div class="alert alert-danger mt-2">{{ $errors->first('first_name') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="last_name" value="{{ $last_name }}" disabled>
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("last_name")) <div class="alert alert-danger mt-2">{{ $errors->first('last_name') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{ $phone }}" disabled>
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{ $dob }}" disabled>
                                            <label class="form-label">Date of Birth</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{ $gender }}" disabled>
                                            <label class="form-label">Gender</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="<?php echo OrganizationDepartments::where('id', $department)->value('department'); ?>" disabled>
                                            <label class="form-label">Department</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="<?php echo Designations::where('id', $designation)->value('designation'); ?>" disabled>
                                            <label class="form-label">Designation</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{$office_shift}}" disabled>
                                            <label class="form-label">Office Shift</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{$employment_type}}" disabled>
                                            <label class="form-label">Employment Type</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{$join_date}}" disabled>
                                            <label class="form-label">Date of Joining</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="phone" value="{{$email}}" disabled>
                                            <label class="form-label">E-Mail</label>
                                        </div>
                                    </div>
                                    @if($errors->has("phone")) <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</li></div>@endif
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="user_name" value="{{ $user_name }}" disabled>
                                            <label class="form-label">User Name</label>
                                        </div>
                                    </div>
                                    @if($errors->has("user_name")) <div class="alert alert-danger mt-2">{{ $errors->first('user_name') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="epf_no" value="{{ $epf_no }}" disabled>
                                            <label class="form-label">EPF Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="epf_no" value="{{ $appoinment_date }}" disabled>
                                            <label class="form-label">Appoinment Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="epf_no" value="{{ $responsible_person_name }}" disabled>
                                            <label class="form-label">Responsible Person</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">

                                            <label>
                                                <input type="checkbox" class="filled-in" {{$check}} name="status" disabled>
                                                <span>Active Employee</span>
                                            </label>

                                </div>


                                </div>
                                </form>
                                    </div>


                                <div id="general_immigration" class="genaraltabcontent" style="display:none">


                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Document No</th>
                                            <th class="center">Document Type</th>
                                            <th class="center"> Issue Date </th>
                                            <th class="center"> Expire Date </th>
                                            <th class="center"> Review Date </th>
                                            <th class="center">Document</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($immigrations as $immigration){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td class="center">{{$immigration->document_no}}</td>
                                            <td class="center">{{$immigration->document_type}}</td>
                                            <td class="center">{{$immigration->issue_date}}</td>
                                            <td class="center">{{$immigration->expire_date}}</td>
                                            <td class="center">{{$immigration->review_date}}</td>
                                            <td class="center"><a href="{{ asset('immigration_documents/'.$immigration->document.'')  }}" download>Download</a></td>
                                            <td class="center">
                                                <a href="{{ url('view-immigration/'.$immigration->id) }}">
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
                                            <th class="center">Document No</th>
                                            <th class="center">Document Type</th>
                                            <th class="center"> Issue Date </th>
                                            <th class="center"> Expire Date </th>
                                            <th class="center"> Review Date </th>
                                            <th class="center">Document</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


                                <div id="general_emergency" class="genaraltabcontent" style="display:none">


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
                                                <a href="{{ url('view-contact/'.$contact->id) }}">
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
                                            <input type="text" class="form-control" name="facebook_profile" value="{{ $facebook_profile }}" disabled>
                                            <label class="form-label">Facebok Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="skype_profile" value="{{ $skype_profile }}" disabled>
                                            <label class="form-label">Skype Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="linkedIn_profile" value="{{ $linkedIn_profile }}" disabled>
                                            <label class="form-label">LinkedIn Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="twitter_profile" value="{{ $twitter_profile }}" disabled>
                                            <label class="form-label">Twitter Profile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="whatsapp_profile" value="{{ $whatsapp_profile }}" disabled>
                                            <label class="form-label">Whats App Profile</label>
                                        </div>
                                    </div>

                                </div>


                    </div>
            </form>
                                </div>



                                <div id="general_document" class="genaraltabcontent" style="display:none">

                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Title</th>
                                            <th class="center">Document Type</th>
                                            <th class="center">Expire Date</th>
                                            <th class="center">Send Notification</th>
                                            <th class="center">Document</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($documents as $document){
                                    ?>
                                        <tr class="odd gradeX">

                                            <td class="center">{{$document->title}}</td>
                                            <td class="center">{{$document->document_type}}</td>
                                            <td class="center">{{$document->expire_date}}</td>
                                            <td class="center">{{$document->send_notification}}</td>

                                            <td class="center"><a href="{{ asset('genaral_document_documents/'.$document->document.'')  }}" download>Download</a></td>
                                            <td class="center">
                                                <a href="{{ url('view-document/'.$document->id) }}">
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
                                            <th class="center">Title</th>
                                            <th class="center">Document Type</th>
                                            <th class="center">Expire Date</th>
                                            <th class="center">Send Notification</th>
                                            <th class="center">Document</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>



                                <div id="general_qualification" class="genaraltabcontent" style="display:none">

                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">School/University</th>
                                            <th class="center">Education Level</th>
                                            <th class="center">From</th>
                                            <th class="center">To</th>
                                            <th class="center">Language</th>
                                            <th class="center">Professional Skills</th>
                                            <th class="center"> Action </th>
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
                                                <a href="{{ url('view-qulification/'.$qulification->id) }}">
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
                                            <th class="center">School/University</th>
                                            <th class="center">Education Level</th>
                                            <th class="center">From</th>
                                            <th class="center">To</th>
                                            <th class="center">Language</th>
                                            <th class="center">Professional Skills</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>



                                <div id="general_work" class="genaraltabcontent" style="display:none">

                                <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="center">Company</th>
                                            <th class="center">From</th>
                                            <th class="center">To</th>
                                            <th class="center">Post</th>
                                            <th class="center">Description</th>
                                            <th class="center"> Action </th>
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


                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="center">Company</th>
                                            <th class="center">From</th>
                                            <th class="center">To</th>
                                            <th class="center">Post</th>
                                            <th class="center">Description</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


                                <div id="general_bank" class="genaraltabcontent" style="display:none">

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
                                <form method="POST" action="{{ url('change-employee-image/'.$id) }}" enctype="multipart/form-data">
                                 @csrf
                                <div class="row clearfix  mt-4">
                                <div class="col-sm-4">
                                <img src="{{ asset('user_images/'.$image.'') }}" alt="" style="width:50%;">
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
                                   <!-- <div class="col-md-12 salarytabs side-tab" onclick="OpenTabSalary(event, 'sallery_pension')">
                                    <h6 class="mt-3 mb-3">Salary Pension</h6>
                                    </div> -->
                                    </div>
                                    </div>
                                    <div class="col-md-1 mt-4">
                                    </div>

                                    <div class="col-md-9 mt-4">
                                    @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif

                                    <div id="sallery_basic" class="sallerytabcontent" >

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Payslip Type</th>
                                            <th class="">Basic Salary</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($basic_salarys as $basic_salary){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$basic_salary->month_year}}</td>
                                            <td >{{$basic_salary->payslip_type}}</td>
                                            <td>{{$basic_salary->basic_salary}}</td>


                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Payslip Type</th>
                                            <th class="">Basic Salary</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_allowances" class="sallerytabcontent" style="display:none;">

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th>Month/Year</th>
                                            <th class="">Allowance Type</th>
                                            <th class="">Allowance Title</th>
                                            <th class="">Allowance Amount</th>

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


                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Allowance Type</th>
                                            <th class="">Allowance Title</th>
                                            <th class="">Allowance Amount</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>
                                <div id="sallery_commissions" class="sallerytabcontent" style="display:none;">

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Commission Title</th>
                                            <th class="">Commission Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($commissions as $commission){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$commission->month_year}}</td>
                                            <td>{{$commission->commission_title}}</td>
                                            <td>{{$commission->commission_amount}}</td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Commission Title</th>
                                            <th class="">Commission Amount</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_loan" class="sallerytabcontent" style="display:none;">

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">/Year</th>
                                            <th class="center">Loan Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class="">Number of Installments</th>
                                            <th class="">Reason</th>

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
                                            <td>{{$loan->reason}}</td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">/Year</th>
                                            <th class="center">Loan Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>
                                            <th class="">Number of Installments</th>
                                            <th class="">Reason</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>


                                <div id="sallery_statutory_deductions" class="sallerytabcontent" style="display:none;">

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Deduction Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>

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

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">Month/Year</th>
                                            <th class="">Deduction Option</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_other_payment" class="sallerytabcontent" style="display:none;">

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($payments as $payment){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td >{{$payment->month_year}}</td>
                                            <td>{{$payment->title}}</td>
                                            <td>{{$payment->amount}}</td>


                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">Amount</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                                </div>

                                <div id="sallery_overtime" class="sallerytabcontent" style="display:none;">

                                    <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Month/Year</th>
                                            <th class="">Title</th>
                                            <th class="">No of Days</th>
                                            <th class="">Total Hours</th>
                                            <th class="">Rate</th>

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
                                    <b>Settings Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit
                                        mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                        aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                        gubergren
                                        sadipscing mel.
                                    </p>
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
                                    <b>Settings Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit
                                        mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                        aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                        gubergren
                                        sadipscing mel.
                                    </p>
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
    $("#attendence_type").select2( {
  placeholder: "Select Attendence Type",
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
