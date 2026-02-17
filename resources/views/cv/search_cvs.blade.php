@include('layouts.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-sm-0 dashboard-title">Search CV's</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Search CV's</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-theme shadow-none rounded-3 border-0">
                        <div
                            class="card-header d-flex justify-content-between align-items-center p-3 border-0 bg-white">
                            <h5 class="card-title mb-0 dashboard-title">Search CV's</h5>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
                                rel="stylesheet">
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success m-3">{{ Session::get('success') }}</div>@endif

                        <div class="card-body p-3">
                            <form action="" method="post" enctype="multipart/form-data" class="mb-4">
                                @csrf
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-10">
                                        <label for="qualifications" class="form-label text-muted">Qualifications /
                                            Skills</label>
                                        <input type="text" class="form-control" name="qualifications"
                                            placeholder="Enter skills, qualifications, or keywords..." required>
                                        @if($errors->has("qualifications"))
                                            <div class="text-danger mt-1 small">{{ $errors->first('qualifications') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-theme-orange w-100">Search</button>
                                    </div>
                                </div>
                            </form>

                            <style>
                                #buttons-datatables_wrapper {
                                    padding: 0;
                                }

                                .konnect-table-wrapper {
                                    overflow-x: auto !important;
                                    border: 1px solid #E8E9EB;
                                    border-radius: 8px;
                                }
                            </style>

                            <div class="konnect-table-wrapper table-responsive">
                                <table class="display table konnect-table mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Job Post</th>
                                            <th>Candidate</th>
                                            <th>Contact</th>
                                            <th>Skills & Education</th>
                                            <th>Experience</th>
                                            <th>Match Score</th>
                                            <th class="text-center">CV Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($results) && count($results) > 0)
                                            @foreach($results as $res)
                                                <tr>
                                                    <td class="ps-4">{{ $res['job_title'] }}</td>
                                                    <td>
                                                        <div class="fw-bold">{{ $res['name'] }}</div>
                                                        <div class="small text-muted">{{ $res['role'] ?? 'N/A' }}</div>
                                                        @if(!empty($res['gender']) && $res['gender'] != 'N/A')
                                                            <span
                                                                class="badge bg-light text-dark border mt-1">{{ $res['gender'] }}</span>
                                                        @endif
                                                        @if(!empty($res['location']))
                                                            <div class="small text-muted mt-1"><i class="ri-map-pin-line"></i>
                                                                {{ $res['location'] }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div><a href="tel:{{ $res['phone'] }}"
                                                                class="text-body">{{ $res['phone'] }}</a></div>
                                                        <div><a href="mailto:{{ $res['email'] }}"
                                                                class="text-primary">{{ $res['email'] }}</a></div>
                                                    </td>
                                                    <td>
                                                        @if(!empty($res['university']) && $res['university'] != 'N/A')
                                                            <span
                                                                class="badge bg-soft-info text-info">{{ ucwords($res['university']) }}</span><br>
                                                        @endif
                                                        @if(!empty($res['degree']) && $res['degree'] != 'N/A')
                                                            <div class="small mt-1"><strong>Degree:</strong>
                                                                {{ ucwords($res['degree']) }}</div>
                                                        @endif
                                                        @if(!empty($res['skills']))
                                                            <div class="small text-muted mt-1"><strong>Skills:</strong>
                                                                {{ Str::limit($res['skills'], 50) }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-soft-warning text-warning">
                                                            {{ $res['experience'] ?? 0 }} Years
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $res['score'] >= 70 ? 'bg-soft-success text-success' : ($res['score'] >= 50 ? 'bg-soft-warning text-warning' : 'bg-soft-danger text-danger') }} fs-12">
                                                            {{ $res['score'] }}%
                                                        </span>
                                                        @if(!empty($res['matched_criteria']))
                                                            <div class="small text-muted mt-1">
                                                                {{ Str::limit($res['matched_criteria'], 30) }}</div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('recruitment_cvs/' . $res['cv']) }}" target="_blank"
                                                            class="btn-icon-soft-blue" title="View CV">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @elseif(isset($search_query))
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">No suitable candidates found for
                                                        "{{ $search_query }}"</div>
                                                </td>
                                            </tr>
                                        @endif
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