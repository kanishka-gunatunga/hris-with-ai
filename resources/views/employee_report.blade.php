@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OrganizationLocations;
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Employee Report</h4>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
               
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                         <div class="header">
                              @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif
                               @if(Session::has('fail')) <div class="alert alert-danger mb-4">{{ Session::get('fail') }}</li></div>@endif
                              <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="header">
                            <h2>
                               Select Columns
                            </h2>


                        </div>
                                    <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="employee_name_check">
                                                <span>Employee Name</span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="epf_no_check">
                                                <span>EPF No</span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="employment_type_check">
                                                <span>Employment Type</span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="appointment_date_check">
                                                <span>Appointment Date</span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="email_check">
                                                <span>Email</span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="phone_check">
                                                <span>Phone Number</span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="birthday_check">
                                                <span>Birthday </span>
                                            </label>

                                </div>
                                <div class="col-sm-2">

                                            <label class="checkbox-margin-top">
                                                <input type="checkbox" class="filled-in" checked="checked" name="department_check">
                                                <span>Department</span>
                                            </label>

                                </div>
                                </div>
                        
                        <div class="row mt-5">
                            
                             <div class="col-sm-2">
                                <div class="mb-3">
                                <label for="formrow-email-input" class="">Department</label>
                                <select name="department" id="department" style="width:100%" >
                                <option value=""></option>
                                <?php
                                foreach($departments as $department){
                                $location_name = OrganizationLocations::where('id', $department->location)->value('location');
                                ?>
                                 <option value="{{$department->id}}">{{$department->department.' ('.$location_name.')'}}</option>
                                <?php } ?>
                                 </select>

                                </div>
                                 </div>
                                  <div class="col-sm-2">
                                <div class="mb-3">
                                <label for="formrow-email-input" class="">Employment Type</label>
                                <select name="employment_type" id="employment_type" style="width:100%" >
                                <option  value=""></option>
                                 <option value="Full Time">Full Time</option>
                                 <option value="Part Time">Part Time</option>
                                 <option value="Intern">Intern</option>
                                 </select>
                                </div>
                                 </div>
                                  <div class="col-sm-2">
                                <button type="submit" class="btn btn-success waves-effect mt-3 btn-sm">
                                      Download Employee Report
                                </button>
                                </div>
                               
                        </div>
                         </form>
                         </div>
                        <div class="header">
                            <h2>
                                <strong>All</strong> Employees
                            </h2>


                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                            <th class="">Department</th>
                                            <th class="">Employee</th>
                                             <th class="">EPF No</th>
                                            <th class="">Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php if(Auth::user()->user_role == 1){ ?>
                                    
                                    <tbody>
                                    <?php foreach($employees as $employee){
                                        $user_role = $employee->user_role;
                                        if($user_role == 2){
                                        $employee_name = OtherHRManagerDetails::where('user_id',$employee->id)->value('first_name').' '.OtherHRManagerDetails::where('user_id',$employee->id)->value('last_name');
                                        $epf_no = OtherHRManagerDetails::where('user_id',$employee->id)->value('epf_no');
                                        $department = OtherHRManagerDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id', $department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                        }
                                        if($user_role == 3){
                                        $employee_name = OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
                                        $epf_no = OtherEmployeeDetails::where('user_id',$employee->id)->value('epf_no');
                                         $department = OtherEmployeeDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id',$department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                        }
                                        if($user_role == 5){
                                        $employee_name = OtherHODDetails::where('user_id',$employee->id)->value('name');  
                                         $epf_no = OtherHODDetails::where('user_id',$employee->id)->value('epf_no');
                                        $department = OtherHODDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id', $department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                            
                                        }
                                        if($user_role ==6){
                                        $employee_name = OtherAuthoriserDetails::where('user_id',$employee->id)->value('name');   
                                        $epf_no = OtherAuthoriserDetails::where('user_id',$employee->id)->value('epf_no');
                                        $department = OtherAuthoriserDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id', $department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                            
                                        }
                                        
                                       
                                   ?>
                                        <tr class="odd gradeX">
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$epf_no}} </td>
                                            <td class="">{{$employee->status}} </td>
                                           
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                     <?php } else {?>
                                    
                                    <tbody>
                                    <?php foreach($employees as $employee){
                                        
                                        
                                         $user_role = $employee->user_role;
                                        if($user_role == 2){
                                          $employee_name = OtherHRManagerDetails::where('user_id',$employee->id)->value('first_name').' '.OtherHRManagerDetails::where('user_id',$employee->id)->value('last_name');
                                        $epf_no = OtherHRManagerDetails::where('user_id',$employee->id)->value('epf_no');
                                        $department = OtherHRManagerDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id', $department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                         $responsible_person = OtherHRManagerDetails::where('user_id',$leave->employee)->value('responsible_person');  
                                         if($responsible_person == Auth::user()->id){ ?>
                                          <tr class="odd gradeX">
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                             <td class="">{{$epf_no}} </td>
                                            <td class="">{{$employee->status}} </td>
                                           
                                        </tr>
                                         <?php }}
                                        if($user_role == 3){
                                         $employee_name = OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
                                        $epf_no = OtherEmployeeDetails::where('user_id',$employee->id)->value('epf_no');
                                         $department = OtherEmployeeDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id',$department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                         $responsible_person = OtherEmployeeDetails::where('user_id',$leave->employee)->value('responsible_person'); 
                                       if($responsible_person == Auth::user()->id){ ?>
                                          <tr class="odd gradeX">
                                            <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                             <td class="">{{$epf_no}} </td>
                                            <td class="">{{$employee->status}} </td>
                                           
                                        </tr>
                                         <?php }}
                                        if($user_role == 5){
                                          $employee_name = OtherHODDetails::where('user_id',$employee->id)->value('name');  
                                         $epf_no = OtherHODDetails::where('user_id',$employee->id)->value('epf_no');
                                        $department = OtherHODDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id', $department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                            $responsible_person = OtherHODDetails::where('user_id',$leave->employee)->value('responsible_person');
                                         if($responsible_person == Auth::user()->id){ ?>
                                          <tr class="odd gradeX">
                                             <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                             <td class="">{{$epf_no}} </td>
                                            <td class="">{{$employee->status}} </td>
                                           
                                        </tr>
                                         <?php }}
                                        if($user_role ==6){
                                        $employee_name = OtherAuthoriserDetails::where('user_id',$employee->id)->value('name');   
                                        $epf_no = OtherAuthoriserDetails::where('user_id',$employee->id)->value('epf_no');
                                        $department = OtherAuthoriserDetails::where('user_id',$employee->id)->value('department');
                                        $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                        $department_location = OrganizationDepartments::where('id', $department)->value('location');
                                        $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                                        $final_location_data = $department_name.' ('.$selected_location_name.')';
                                          $responsible_person = OtherAuthoriserDetails::where('user_id',$leave->employee)->value('responsible_person');  
                                        if($responsible_person == Auth::user()->id){ ?>
                                          <tr class="odd gradeX">
                                             <td class="">{{$final_location_data}}</td>
                                            <td class="">{{$employee_name}} </td>
                                             <td class="">{{$epf_no}} </td>
                                            <td class="">{{$employee->status}} </td>
                                        </tr>
                                         <?php }}
                                        
                                   ?>
                                       
                                    <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                    <tfoot>
                                    <tr>
                                            <th class="">Department</th>
                                            <th class="">Employee</th>
                                            <th class="">EPF No</th>
                                            <th class="">Status</th>
                                            
                                            
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
