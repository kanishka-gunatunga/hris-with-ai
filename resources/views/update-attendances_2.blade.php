@include('layouts.header')
<?php
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
use App\Models\LeaveTypes;
use App\Models\OrganizationLocations;

?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Update Attendance</h4>
                            </li>

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
                                <div class="form-group">
                                        <div class="form-line mt-4">
                                            <input id="date" name="date" class="flatPicker flatpickr-input active" placeholder="Date" type="date" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    @if($errors->has("date")) <div class="alert alert-danger mt-2">{{ $errors->first('date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-3">
                                <label for="formrow-email-input" class="">Department</label>
                                <select name="department" id="department" style="width:100%" required onchange="GetEmployees();">
                                <option value=""></option>
                                <?php
                                foreach($departments as $department){
                                    $location_name = OrganizationLocations::where('id', $department->location)->value('location');
                                ?>
                                 <option value="{{$department->id}}">{{$department->department.' ('.$location_name.')'}}</option>
                                <?php } ?>
                                 </select>
                                @if($errors->has("department")) <div class="alert alert-danger mt-2">{{ $errors->first('department') }}</li></div>@endif
                                </div>

                                <div class="col-sm-3" id="employee_dropdown">
                                <label for="formrow-email-input" class="">Employee</label>
                                <select name="employee" id="employee" style="width:100%" required>
                                <option value=""></option>
                                 </select>
                                </div>

                                <div class="col-sm-12" style="display:none;" id="add_attendence_section">
                                <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line  mt-4">
                                            <input name="attendance_date" class="flatPicker flatpickr-input active" placeholder="Attendance Date" type="date" value="{{ old('attendance_date') }}" required>
                                        </div>
                                </div>
                                    @if($errors->has("attendance_date")) <div class="alert alert-danger mt-2">{{ $errors->first('attendance_date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">

                                            <input id="myTimePicker"  name="clock_in" placeholder="Clock In" type="text" class="flatpickr-input active" required>
                                        </div>
                                    </div>
                                    @if($errors->has("clock_in")) <div class="alert alert-danger mt-2">{{ $errors->first('clock_in') }}</li></div>@endif
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">

                                            <input id="myTimePicker"  name="clock_out" placeholder="Clock Out" type="text" class="flatpickr-input active">
                                        </div>
                                    </div>
                                    @if($errors->has("clock_out")) <div class="alert alert-danger mt-2">{{ $errors->first('clock_out') }}</li></div>@endif
                                 </div>
                                </div>
                                </div>

                                <div class="col-sm-4">
                                <button type="button" class="btn btn-success waves-effect mt-4" onclick="GetDetails()">Get Details
                                </button>
                                </div>
                                <div class="col-sm-4" >
                                <button type="submit" class="btn btn-info waves-effect mt-4" id="add_attendence_button" style="display:none;">Add Attendance
                                </button>
                                </div>

                    </div>
            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>Attendence</strong> Details
                            </h2>
                        </div>
                        <div class="body">
                        <div class="body table-responsive">
                            <table class="table table-bordered" id="attendence_table">
                                <thead>
                                    <tr>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>Total Work</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
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
$("#department").select2( {
	placeholder: "Select Department",
	allowClear: true
	} );
    $("#employee").select2( {
	placeholder: "Select Employee",
	allowClear: true
	} );
    $("#payment_mode").select2( {
	placeholder: "Select Payment Mode",
	allowClear: true
	} );
    $("#payer").select2( {
	placeholder: "Select Payer",
	allowClear: true
	} );

function GetEmployees() {
var department = document.getElementById("department");
var department_id = department.options[department.selectedIndex].value;
var url = '{{ url('attendence-get-employees') }}';
            //Perform Ajax request.
            $.ajax({
           url:url,
           method:'POST',
           data:{
            "_token":"{{ csrf_token() }}",
            department_id : department_id
                },
           success:function(html){
            $('#employee').html(html);
           },
           error:function(error){
              console.log(error)
           }
        });
}
function GetDetails() {
var department = document.getElementById("department");
var department_id = department.options[department.selectedIndex].value;
var employee = document.getElementById("employee");
var employee_id = employee.options[employee.selectedIndex].value;
if (department_id == "Select" || employee_id == "Select")
{
alert("Please select a department and employee");
return false;
}
else
{
document.getElementById("add_attendence_section").style.display = "block";
document.getElementById("add_attendence_button").style.display = "block";
var date = document.getElementById("date").value;
var url = '{{ url('get-attendence-details') }}';
            //Perform Ajax request.
            $.ajax({
           url:url,
           method:'POST',
           data:{
            "_token":"{{ csrf_token() }}",
            department_id : department_id,
            employee_id : employee_id,
            date : date
                },
           success:function(html){
            $('#attendence_table').html(html);
           },
           error:function(error){
              console.log(error)
           }
        });
}

}
</script>
