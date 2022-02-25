@extends('layouts.app')

@section('title')
    Apllications | @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.min.css")}}">
@endsection

@section('content')

<div class="pagetitle">
    <h1>Applications</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Applications</li>
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
                 <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pending Applications</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Selected Students</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-striped table-bordered dataTable" style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>KCSE Mean Grade</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($applications as $item => $value)
                                    @if ($value->status === "pending")
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$value->first_name." ".$value->last_name." ".$value->surname}}</td>
                                            <td>{{ $value->class." ".$value->course }}</td>
                                            <td>{{ $value->kcse_mean_grade }}</td>
                                            <td>
                                                <li class="dropdown-toggle">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-item"><a href="{{ route('applications.show', $value->id) }}"><i class="bi bi-edit text-warning"></i>&nbsp;View</a></li>
                                                        <li class="dropdown-item"><a href="{{ route('application.select', $value->id) }}"  data-id="{{$value->id}}"><i class="bi bi-edit text-warning"></i>&nbsp;Select</a></li>
                                                        <li class="dropdown-item"><a href="{{ route('applications.edit',$value->id) }}" ><i class="bi bi-edit text-warning"></i>&nbsp;Edit</a></li>
                                                        <li class="dropdown-item"><a href="{{ route('courses.destroy', $value->id) }}"><i class="bi bi-trash text-warning"></i>&nbsp;Delete</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-striped table-bordered dataTable" style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>KCSE Mean Grade</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($applications as $item => $value)
                                @if ($value->status === "selected")
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$value->first_name." ".$value->last_name." ".$value->surname}}</td>
                                        <td>{{ $value->class." ".$value->course }}</td>
                                        <td>{{ $value->kcse_mean_grade }}</td>
                                        <td>
                                            <li class="dropdown-toggle">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item"><a href="{{ route('applications.show', $value->id) }}"><i class="bi bi-edit text-warning"></i>&nbsp;View</a></li>
                                                    <li class="dropdown-item"><a href="{{ route('application.register', $value->id) }}"  data-id="{{$value->id}}"><i class="bi bi-edit text-warning"></i>&nbsp;Register</a></li>
                                                    <li class="dropdown-item"><a href="{{ route('applications.edit',$value->id) }}" ><i class="bi bi-edit text-warning"></i>&nbsp;Edit</a></li>
                                                    <li class="dropdown-item"><a href="{{ route('applications.destroy', $value->id) }}"><i class="bi bi-trash text-warning"></i>&nbsp;Delete</a></li>
                                                </ul>
                                            </li>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- End Default Tabs -->
                
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