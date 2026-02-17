@include('layouts.header')
<?php
use App\Models\OrganizationDesignations;
use App\Models\PerformanceGoalType;
use App\Models\OrganizationDepartments;
use App\Models\OtherEmployeeDetails;
?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0" style="display: none;">Appraisals</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Appraisals</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0" style="font-size: 24px; color: rgb(7, 7, 7); font-weight: 500; margin-left: 20px;">Appraisals</h5>
                        <a href="{{url('add-appraisal')}}"><button type="button" class="mt-4 btn btn-info">Add Appraisal</button></a>
                        @if(Session::has('success')) <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>@endif
                    </div>
                    <div class="card-body">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                <th class="">Employee</th>
                                            <th class="">Designation</th>
                                            <th class="">Department</th>
                                            <th class="">Appraisal Date</th>
                                            <th class="">Actions</th>
                                </tr>
                            </thead>

                                    <tbody>
                                    <?php foreach($appraisals as $appraisal){
                                     $designation_name = OrganizationDesignations::where('id', $appraisal->desigantion)->value('designation');
                                     $employee_name = OtherEmployeeDetails::where('user_id', $appraisal->employee)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $appraisal->employee)->value('last_name');
                                     $department = OrganizationDesignations::where('id', $appraisal->desigantion)->value('department');
                                     $department_name = OrganizationDepartments::where('id', $department)->value('department');
                                    ?>
                                        <tr class="odd gradeX">

                                            <td class="">{{$employee_name}} </td>
                                            <td class="">{{$designation_name}}  </td>
                                            <td class="">{{$department_name}} </td>
                                            <td class="">{{$appraisal->appraisal_date}} </td>
                                            <td >
                                                <a href="{{ url('edit-performance-appraisal/'.$appraisal->id) }}">
                                                <i class="ri-pencil-fill"></i>
                                                </a>
                                                <a href="{{ url('delete-performance-appraisal/'.$appraisal->id) }}">
                                                <i class="ri-delete-bin-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
    @include('layouts.footer')
