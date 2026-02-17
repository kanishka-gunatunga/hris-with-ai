@include('layouts.header')

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Add Designation</h4>
                            </li>
                            <li class="breadcrumb-item bcrumb-1">
                                <a href="#">
                                    <i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item bcrumb-2">
                                <a href="#" onClick="return false;">Admins</a>
                            </li>
                            <li class="breadcrumb-item active">Add Designation</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                    
                        <div class="body">
            <form method="POST" action="{{ url('add-designation') }}" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix  mt-4">
                @if(Session::has('success')) <div class="alert alert-success mb-4">{{ Session::get('success') }}</li></div>@endif
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="designation" value="{{ old('designation') }}">
                                            <label class="form-label">Designation</label>
                                        </div>
                                    </div>
                                    @if($errors->has("designation")) <div class="alert alert-danger mt-2">{{ $errors->first('designation') }}</li></div>@endif
                                </div>
                                <div class="col-sm-4">
                                <label>
                                                <input type="checkbox" class="filled-in" checked="checked" name="status">
                                                <span>Active Designation</span>
                                            </label>
                                </div>
                                <div class="col-sm-4">
                                
                                </div>
                                <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect mt-4">
                            
                                       ADD DESIGNATION
                                 
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
                                <strong>All</strong> Designation
                            </h2>
                         
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="#" onClick="return false;" class="dropdown-toggle"
                                        data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu float-end">
                                        <li>
                                            <a href="#" onClick="return false;">Action</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="return false;">Another action</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="return false;">Something else here</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example contact_list">
                                    <thead>
                                        <tr>
                                           
                                            <th class="center">Designation</th>
                                            <th class="center">Status</th>
                                            <th class="center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($designations as $designation){ 
                                    
                                    ?>
                                        <tr class="odd gradeX">
                                        <form action="{{ url('edit-designation/'.$designation->id) }}" method="post">
                                            @csrf
                                            <td class=""> <input type="text" class="form-control" name="designation" value="{{$designation->designation}}" required></td>
                                            <td class="">
                                            <?php 
                                            if($designation->status == "active"){ 
                                            $check = "checked";
                                            }
                                            else{
                                            $check = "";
                                             }
                                            ?>
                                            <label>
                                                <input type="checkbox" class="filled-in" {{$check}} name="status">
                                                <span>Active</span>
                                            </label>
                                            </td>
                                            <td class="">
                                                <button type="submit" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">create</i>
                                                </button>
                                             
                                            </form>
                                               
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="center">Designation</th>
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
@include('layouts.footer')