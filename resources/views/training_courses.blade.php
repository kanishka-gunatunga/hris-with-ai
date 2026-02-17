@include('layouts.header')
<?php
use App\Models\PerformanceGoalType;
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Training Courses</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Training Courses</li>
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
                                <h5 class="card-title mb-0">Create Course</h5>
                            </div>
                        </div><!-- end card header -->

                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                @if(Session::has('success'))
                                <div class="alert alert-success mb-4">{{ Session::get('success') }}</div>@endif
                                <div class="live-preview">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ old('title') }}">
                                                @if($errors->has("title"))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Materials</label>
                                                <input type="file" class="form-control" name="materials[]" multiple>
                                                @if($errors->has("materials"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('materials') }}</li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Description</label>
                                                <textarea class="form-control" id="discription"
                                                    name="discription">{{ old('discription') }}</textarea>
                                                @if($errors->has("discription"))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('discription') }}</li>
                                                </div>@endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 mb-4">
                                            <button type="submit" class="btn btn-theme-orange">Save Course</button>
                                        </div>

                                    </div>
                                    <!--end row-->
                        </form>
                    </div>

                </div>
            </div>

        </div> <!-- end col -->

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card-theme">
                <div class="card-header">
                    <h5 class="card-title mb-0">Courses</h5>

                </div>
                <div class="card-body p-0">
                    <style>
                        #buttons-datatables_wrapper {
                            padding: 20px;
                        }

                        .konnect-table-wrapper {
                            overflow-x: auto !important;
                        }
                    </style>
                    <div class="konnect-table-wrapper">
                        <table id="buttons-datatables" class="display table konnect-table mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="ps-4">Title</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($courses as $course) { ?>
                                <tr>

                                    <td class="ps-4">{{$course->title}} </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ url('edit-training-course/' . $course->id) }}"
                                                class="btn-icon-soft-blue" title="Edit">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path
                                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="{{ url('delete-training-course/' . $course->id) }}"
                                                class="btn-icon-soft-red" title="Delete">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
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