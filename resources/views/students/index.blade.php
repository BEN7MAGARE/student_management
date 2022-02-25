@extends('layouts.app')

@section('title')
    Students | @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.min.css")}}">
@endsection

@section('content')

<div class="pagetitle">
    <h1>Students</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Students</li>
    </ol>
    </nav>
</div>

<div class=" mt-3">
    <div class="inner bg-container">
        <div class="card">

            <div class="card-body">
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
                 @php
                     function asMoney($var)
                     {
                         return number_format($var,2);
                     }
                 @endphp
                 
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-striped table-bordered dataTable" style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Alt Phone</th>
                                <th>Next of kin</th>
                                <th>Address</th>
                                <th>County</th>
                                <th>Constituency</th>
                                <th>Location</th>
                                <th>Sublocation</th>
                                <th>Village</th>
                                <th>KCSE Yrs</th>
                                <th>KCSE Index NO</th>
                                <th>KCSE Mean Grade</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($students as $item => $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->first_name." ".$value->surname." ".$value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->alt_phone }}</td>
                                        <td>{{ $value->next_of_kin_name }}</td>
                                        <td>{{ $value->next_of_kin_email }}</td>
                                        <td>{{ $value->next_of_kin_phone }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ $value->county }}</td>
                                        <td>{{ $value->constituency }}</td>
                                        <td>{{ $value->location }}</td>
                                        <td>{{ $value->sublocation }}</td>
                                        <td>{{ $value->village }}</td>
                                        <td>{{ $value->kcse_year }}</td>
                                        <td>{{ $value->kcse_index_no }}</td>
                                        <td>{{ $value->kcse_mean_grade }}</td>
                                        <td>
                                            <li class="dropdown-toggle">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-item"><a href="{{ route('students.edit',$value->id) }}" ><i class="bi bi-edit text-warning"></i>&nbsp;Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{ route('students.destroy', $value->id) }}"><i class="bi bi-trash text-warning"></i>&nbsp;Delete</a></li>
                                                    </ul>
                                                </li>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('.dataTable').DataTable();
        });
    </script>
@endsection