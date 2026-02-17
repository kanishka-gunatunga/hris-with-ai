<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationDepartments;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
?>
@include('layouts.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Department Directory</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Department Directory</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xxl-12" style="margin:auto;">
                    <div class="card-theme">
                        <div class="card-header align-items-center d-flex">
                            <div class="vertical-center-heading">
                                <h5 class="card-title mb-0">Department Directory</h5>
                            </div>
                        </div><!-- end card header -->


                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="button" class="btn btn-theme-orange" onclick="GetEmployeeDetails()">View
                                    Details</button>

                            </div>

                            <div class="live-preview">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Select Employee</label>
                                            <select class="form-control" data-choices name="choices-single-default"
                                                name="employee" id="employee">
                                                <?php
foreach ($hrms as $hrm) {
    $department = OtherHRManagerDetails::where('user_id', $hrm->id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $name = OtherHRManagerDetails::where('user_id', $hrm->id)->value('first_name') . ' ' . OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name');
                                ?>
                                                <option value="{{$hrm->id}}">
                                                    <?php    echo $name . ' (' . $department_name . ')' ?>
                                                </option>
                                                <?php } ?>
                                                <?php
foreach ($employees as $employee) {
    $department = OtherEmployeeDetails::where('user_id', $employee->id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $name = OtherEmployeeDetails::where('user_id', $employee->id)->value('first_name') . ' ' . OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
                                ?>
                                                <option value="{{$employee->id}}">
                                                    <?php    echo $name . ' (' . $department_name . ')' ?>
                                                </option>
                                                <?php } ?>
                                                <?php
foreach ($hods as $hod) {
    $department = OtherHODDetails::where('user_id', $hod->id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $name = OtherHODDetails::where('user_id', $hod->id)->value('name');
                                ?>
                                                <option value="{{$hod->id}}">
                                                    <?php    echo $name . ' (' . $department_name . ')' ?>
                                                </option>
                                                <?php } ?>
                                                <?php
foreach ($authorizers as $authorizer) {
    $department = OtherAuthoriserDetails::where('user_id', $authorizer->id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $name = OtherAuthoriserDetails::where('user_id', $authorizer->id)->value('name');
                                ?>
                                                <option value="{{$authorizer->id}}">
                                                    <?php    echo $name . ' (' . $department_name . ')' ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            @if($errors->has("complaint_from"))
                                                <div class="alert alert-danger mt-2">
                                                    {{ $errors->first('complaint_from') }}</li>
                                            </div>@endif
                                        </div>
                                    </div>

                                    @if(Session::has('success'))
                                        <div class="alert alert-success mb-4">
                                            {{ Session::get('success') }}
                                    </div>@endif
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <div class="row mt-5" id="employee_details">

                                </div>

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
        $("#employee").select2({
            placeholder: "Select Employee",
            allowClear: true,
        });
    </script>
    <script>
        function GetEmployeeDetails() {

            var user = document.getElementById("employee");
            var user_id = user.options[user.selectedIndex].value;

            var url = '{{ url('get-employee-details') }}';
            //Perform Ajax request.
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id: user_id
                },
                success: function (html) {
                    $('#employee_details').html(html);
                },
                error: function (error) {
                    console.log(error)
                }
            });


        }
    </script>