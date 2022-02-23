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
            <div class="card-header bg-blue">
                <a href="#" data-bs-toggle="modal" data-bs-target="#newCourseModal" class="btn btn-sm btn-primary align-right"><i class="fa fa-plus"></i>&nbsp;Add new</a>&nbsp;&nbsp;
            </div>

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
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
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
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$value->first_name." ".$value->last_name." ".$value->surname}}</td>
                                <td>{{ date("Y", strtotime($value->start_date))." ".$value->course }}</td>
                                <td>{{ $value->class }}</td>
                                <td>{{ $value->kcse_mean_grade }}</td>
                                <td>
                                    <li class="dropdown-toggle">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a href="{{ route('applications.show', $value->id) }}"><i class="bi bi-edit text-warning"></i>&nbsp;View</a></li>
                                            <li class="dropdown-item"><a href="{{ route('application.select', $value->id) }}"  data-id="{{$value->id}}"><i class="bi bi-edit text-warning"></i>&nbsp;Select</a></li>
                                            <li class="dropdown-item"><a href="#" id="" data-bs-toggle="modal" data-bs-target="#editCourseModal" data-id="{{$value->id}}"><i class="bi bi-edit text-warning"></i>&nbsp;Edit</a></li>
                                            <li class="dropdown-item"><a href="#" id="editCourseDetails" data-bs-toggle="modal" data-bs-target="#editCourseModal" data-id="{{$value->id}}"><i class="bi bi-edit text-warning"></i>&nbsp;Edit</a></li>
                                            <li class="dropdown-item"><a href="{{ route('courses.destroy', $value->id) }}"><i class="bi bi-trash text-warning"></i>&nbsp;Delete</a></li>
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