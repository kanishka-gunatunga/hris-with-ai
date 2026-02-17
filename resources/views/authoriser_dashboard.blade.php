@include('layouts.header')
<?php
use App\Models\OtherAdminDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherEmployeeDetails;
use App\Models\OtherClientDetails;
use App\Models\OtherHODDetails;
use App\Models\OrganizationDepartments;
use App\Models\PMProjectsEmployees;
use App\Models\PMProjects;
use App\Models\PMTaskUsers;
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingListEmployees;
use App\Models\UserCheckInOutData;
?>
<style>
    .clock-in-out-widget-container{
	 margin-top: 20px;
	 margin-bottom: 20px;
	 background-color: #fff;
	 border-radius: 15px;
	 padding: 40px 40px;

text-align:center;
}
 .clock-in-out-widget-container .header h2{
     font-size:16px;
     font-weight:600;
     color:#12171d;
 }
</style>
<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-sm-0 dashboard-title">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Authoriser</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">




                        <!--<div class="col-xxl-8">-->
                        <!--    <div class="card card-height-100">-->
                        <!--        <div class="card-header align-items-center d-flex">-->
                        <!--            <h4 class="card-title mb-0 flex-grow-1">Balance Overview</h4>-->
                        <!--            <div class="flex-shrink-0">-->
                        <!--                <div class="dropdown card-header-dropdown">-->
                        <!--                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--                        <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Year<i class="mdi mdi-chevron-down ms-1"></i></span>-->
                        <!--                    </a>-->
                        <!--                    <div class="dropdown-menu dropdown-menu-end">-->
                        <!--                        <a class="dropdown-item" href="#">Today</a>-->
                        <!--                        <a class="dropdown-item" href="#">Last Week</a>-->
                        <!--                        <a class="dropdown-item" href="#">Last Month</a>-->
                        <!--                        <a class="dropdown-item" href="#">Current Year</a>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="card-body px-0">-->
                        <!--            <ul class="list-inline main-chart text-center mb-0">-->
                        <!--                <li class="list-inline-item chart-border-left me-0 border-0">-->
                        <!--                    <h4 class="text-primary">$584k <span class="text-muted d-inline-block fs-13 align-middle ms-2">Revenue</span></h4>-->
                        <!--                </li>-->
                        <!--                <li class="list-inline-item chart-border-left me-0">-->
                        <!--                    <h4>$497k<span class="text-muted d-inline-block fs-13 align-middle ms-2">Expenses</span>-->
                        <!--                    </h4>-->
                        <!--                </li>-->
                        <!--                <li class="list-inline-item chart-border-left me-0">-->
                        <!--                    <h4><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block fs-13 align-middle ms-2">Profit Ratio</span></h4>-->
                        <!--                </li>-->
                        <!--            </ul>-->

                        <!--            <div id="revenue-expenses-charts" data-colors='["--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="col-xxl-4 col-md-4">
                        <?php
$check_in_out_data = UserCheckInOutData::where('user_id',Auth::user()->id)->where('year_month_date',date("Y-m-d"))->orderBy('id', 'DESC')->first();
$latitude = OtherAuthoriserDetails::where('user_id',Auth::user()->id)->value('latitude');
$longitude = OtherAuthoriserDetails::where('user_id',Auth::user()->id)->value('longitude');
if($check_in_out_data == null || $check_in_out_data->check_in_or_out == "check out"){
?>
<input type="hidden" value ="{{$latitude}}" id="latitude">
<input type="hidden" value ="{{$longitude}}" id="longitude">
                        <div class="card-theme">
                                <div class="card-header text-center">

                                    <h6 class="card-title mb-0">Submit Check-In Time</h6>
                                </div>
                                <div class="card-body p-4 text-center">
                                    <div class="mx-auto avatar-md mb-3">
                                    <i class="bx bx-time-five text-primary-orange" style="font-size: 70px;"></i>
                                    </div>
                                    <form method="POST" action="{{ url('user-add-check-in-time') }}" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn-theme-orange w-100">
                                    Submit Check In Time
                                    </button>
                                    </form>
                                </div>
                        </div>
<?php } else {?>
                            <div class="card-theme">
                                <div class="card-header text-center">

                                    <h6 class="card-title mb-0">Submit Check-Out Time</h6>
                                </div>
                                <div class="card-body p-4 text-center">
                                    <div class="mx-auto avatar-md mb-3">
                                    <i class="bx bx-time-five text-primary-orange" style="font-size: 70px;"></i>
                                    </div>
                                    <form method="POST" action="{{ url('user-add-check-out-time') }}" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn-theme-orange w-100">
                                    Submit Check Out Time
                                    </button>
                                    </form>
                                </div>
                            </div>
<?php } ?>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">


                        <div class="col-xxl-6">
                            <div class="card-theme card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Birthdays & Anniversaries</h4>

                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-nowrap align-middle mb-0 table-theme">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 30%;">ID</th>
                                                    <th scope="col" style="width: 30%;">Name</th>
                                                    <th scope="col" style="width: 20%;">Phone</th>
                                                    <th scope="col" style="width: 20%;">Gender</th>
                                                    <th scope="col" style="width: 20%;">Appointment Date</th>
                                                    <th scope="col" style="width: 20%;">Birthdays or Anniversary</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                            <?php $employee_details_b = OtherEmployeeDetails::get();
                                            foreach($employee_details_b as $employee_b){
                                            $currentMD = date("m/j/Y");
                                            $currentMD = date('m-j', strtotime($currentMD));
                                            $birthMD= date('m-j', strtotime($employee_b->dob));
                                            $annverMD= date('m-j', strtotime($employee_b->appoinment_date));
                                            if ($birthMD == $currentMD){ ?>
                                        <tr>
                                            <td>{{$employee_b->user_id}}</td>
                                            <td>{{$employee_b->first_name.' '.$employee_b->last_name}}</td>
                                            <td>{{$employee_b->phone}}</td>
                                            <td>{{$employee_b->gender}}</td>
                                            <td>{{$employee_b->appoinment_date}}</td>
                                            <td><span class="label label-success">BIRTHDAY</span></td>
                                        </tr>
                                       <?php }
                                         if ($annverMD == $currentMD){ ?>
                                        <tr>
                                            <td>{{$employee_b->user_id}}</td>
                                            <td>{{$employee_b->first_name.' '.$employee_b->last_name}}</td>
                                            <td>{{$employee_b->phone}}</td>
                                            <td>{{$employee_b->gender}}</td>
                                            <td>{{$employee_b->appoinment_date}}</td>
                                            <td><span class="label label-info">ANNIVERSARY</span></td>
                                        </tr>
                                        <?php }}
                                        ?>
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div><!-- end table responsive -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        


                    </div><!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
    @include('layouts.footer')
    <script>
showPosition();
function showPosition() {
if(navigator.geolocation) {
navigator.geolocation.getCurrentPosition(function(position) {

let spotCoordinates = [position.coords.latitude, position.coords.longitude];
let latitude = document.getElementById("latitude").value;
let longitude = document.getElementById("longitude").value;
let center = {lat: latitude, lng: longitude};
let radius = 1

checkIfInside(spotCoordinates);

function checkIfInside(spotCoordinates) {

    let newRadius = distanceInKmBetweenEarthCoordinates(spotCoordinates[0], spotCoordinates[1], center.lat, center.lng);

    if( newRadius < radius ) {
        //point is inside the circle
       document.getElementById("check-container").style.display = "block";
    }
    else if(newRadius > radius) {
        //point is outside the circle
        console.log('outside')
    }
    else {
        //point is on the circle
        document.getElementById("check-container").style.display = "block";
    }

}
function distanceInKmBetweenEarthCoordinates(lat1, lon1, lat2, lon2) {
  var earthRadiusKm = 6371;

  var dLat = degreesToRadians(lat2-lat1);
  var dLon = degreesToRadians(lon2-lon1);

  lat1 = degreesToRadians(lat1);
  lat2 = degreesToRadians(lat2);

  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  return earthRadiusKm * c;
}

function degreesToRadians(degrees) {
  return degrees * Math.PI / 180;
}
            });
        } else {
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }


    }
</script>
