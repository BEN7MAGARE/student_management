@extends('layouts.app')

@section('title')
    Apllication | @parent
@endsection

@section('header_styles')
@endsection

@section('content')

<div class="pagetitle">
    <h1>Applications</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Application Details</li>
    </ol>
    </nav>
</div>

<div class=" mt-3">
    <div class="inner bg-container">

        @if(Session::has('success'))
            <div class="col-lg">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>
                    {{Session::get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @if ($errors->any())
            <div class="col-lg">
                <div class="alert alert-danger alert-dismissable">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $item)
                        <strong>Error!</strong>
                        {{$item}}
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="border-radius: 15px; padding: .8em">
                        <div class="card-body">
                            <h6><strong>Applicant Information</strong></h6>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Name</strong> </td>
                                        <td>{{ $application->first_name." ". $application->surname." ". $application->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>{{ $application->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone</strong></td>
                                        <td>{{ $application->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alt phone</strong></td>
                                        <td>{{ $application->alt_phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Next of Kin</strong></td>
                                        <td>{{ $application->next_of_kin_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Next of kin email</strong></td>
                                        <td>{{ $application->next_of_kin_email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Next of kin Phone</strong></td>
                                        <td>{{ $application->next_of_kin_phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td>{{ $application->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Home county</strong></td>
                                        <td>{{ $application->county }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>Constituency</strong></td>
                                        <td>{{ $application->constituency }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Location</strong></td>
                                        <td>{{ $application->location }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sub - location</strong></td>
                                        <td>{{ $application->sublocation }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Village</strong></td>
                                        <td>{{ $application->village }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 15px; padding: .8em">
                    <div class="card-body">
                        <h6><strong>Student Qualification</strong></h6>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>KCSE Year</strong></td>
                                    <td>{{ $application->kcse_year }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCSE Index NO</strong></td>
                                    <td>{{ $application->kcse_index_no }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCSE Mean Grade</strong></td>
                                    <td>{{ $application->kcse_mean_grade }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCSE Certificate</strong></td>
                                    <td>{{ $application->kcse_certificate }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCPE Year</strong></td>
                                    <td>{{ $application->kcpe_year }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCPE Index NO</strong></td>
                                    <td>{{ $application->kcpe_index_no }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCPE Mean Grade</strong></td>
                                    <td>{{ $application->kcpe_mean_grade }}</td>
                                </tr>
                                <tr>
                                    <td><strong>KCPE Certificate</strong></td>
                                    <td>{{ $application->kcpe_certificate }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>

                <div class="card">
                    <table class="table table-bordered">
                        <h6><strong>Course Aplied</strong></h6>
                        <tbody>
                            <tr>
                                <td><strong>Course</strong></td>
                                <td>{{ $application->class->code." ".$application->class->course->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Start date</strong></td>
                                <td>{{ date("j M, Y", strtotime($application->class->start_date)) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
           
    </div>
</div>


@endsection

@section('footer_scripts')
    <script src="{{asset("assets/js/dataTables.min.js")}}"></script>
    <script src="{{asset("assets/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{ asset('assets/js/course.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection