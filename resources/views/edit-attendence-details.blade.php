@include('layouts.header')
<?php 
use App\Models\Departments;
use App\Models\OtherEmployeeDetails;
foreach ($attendence_details as $attendence_detail)  {
    $date = $attendence_detail->date;
    $department =$attendence_detail->department;
    $employee =$attendence_detail->employee;
    $attendance_date =$attendence_detail->attendance_date;
    $clock_in = $attendence_detail->clock_in;
    $clock_out =$attendence_detail->clock_out;
    $employee_name =OtherEmployeeDetails::where('user_id', $employee)->value('first_name').' '.OtherEmployeeDetails::where('user_id', $employee)->value('last_name');
    $department_name =Departments::where('id', $department)->value('department');
}
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Edit Attendance</h4>
                            </li>
                            <li class="breadcrumb-item bcrumb-1">
                                <a href="#">
                                    <i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item bcrumb-2">
                                <a href="#" onClick="return false;">Admins</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Attendance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                    
                        <div class="body">
                        <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">
                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif
                @if(Session::has('fail')) <div class="alert alert-danger mb-4">{{ Session::get('fail') }}</li></div>@endif
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line">
                                            <input id="date" name="date" class="flatPicker flatpickr-input active" placeholder="Date" type="date" value="{{ $date }}" required>
                                        </div>
                                    </div>
                                    @if($errors->has("date")) <div class="alert alert-danger mt-2">{{ $errors->first('date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                <label for="formrow-email-input" class="">Department</label>
                                <select name="department" id="department" style="width:100%" required onchange="GetEmployees();">
                                <option selected hidden  value="{{$department}}">{{$department_name}}</option>
                                <?php 
                                foreach($departments as $department){
                                ?>
                                 <option value="{{$department->id}}">{{$department->department}}</option>
                                <?php } ?>
                                 </select>
                                @if($errors->has("department")) <div class="alert alert-danger mt-2">{{ $errors->first('department') }}</li></div>@endif
                                </div>

                                <div class="col-sm-4" id="employee_dropdown">
                                <label for="formrow-email-input" class="">Employee</label>
                                <select name="employee" id="employee" style="width:100%" required>
                                <option selected hidden  value="{{$employee}}">{{$employee_name}}</option>
                                 </select>
                                </div>

                                <div class="col-sm-12" id="add_attendence_section">
                                <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                        <div class="form-line">
                                            <input name="attendance_date" class="flatPicker flatpickr-input active" placeholder="Attendance Date" type="date" value="{{ $attendance_date }}" required>
                                        </div>
                                </div>
                                    @if($errors->has("attendance_date")) <div class="alert alert-danger mt-2">{{ $errors->first('attendance_date') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                     
                                            <input id="myTimePicker"  name="clock_in" placeholder="Clock In" value="{{$clock_in}}" type="text" class="flatpickr-input active" required>
                                        </div>
                                    </div>
                                    @if($errors->has("clock_in")) <div class="alert alert-danger mt-2">{{ $errors->first('clock_in') }}</li></div>@endif
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                     
                                            <input id="myTimePicker"  name="clock_out" placeholder="Clock Out" value="{{$clock_out}}" type="text" class="flatpickr-input active">
                                        </div>
                                    </div>
                                    @if($errors->has("clock_out")) <div class="alert alert-danger mt-2">{{ $errors->first('clock_out') }}</li></div>@endif
                                 </div>
                                </div>
                                </div>

                                <div class="col-sm-2">
                                <button type="submit" class="btn btn-success waves-effect mt-4" >SAVE
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

</script>