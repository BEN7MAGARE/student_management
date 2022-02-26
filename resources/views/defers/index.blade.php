@extends('layouts.app')

@section('title')
    Deferment | @parent
@endsection

@section('header_styles')
        <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datepicker.min.css")}}">
@endsection

@section('content')

<div class="pagetitle">
    <h1>Deferment</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Deferments</li>
    </ol>
    </nav>
</div>

<div class=" mt-3">
    <div class="inner bg-container">
        <div class="card" style="padding: .5em; border-radius:10px;">
            <div class="card-header bg-blue">
                <a href="#" data-bs-toggle="modal" data-bs-target="#newClassModal" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i>&nbsp;Add new</a>&nbsp;&nbsp;
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
                        <th>Student</th>
                        <th>Academic year</th>
                        <th>Current Year</th>
                        <th>Current Semester</th>
                        <th>Period</th>
                        <th>Start date</th>
                        <th>Reason</th>
                        <th>Perio</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($deferments as $item => $value)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->academic_year }}</td>
                                <td>{{ $value->year }}</td>
                                <td>{{ $value->semester }}</td>
                                <td>{{ $value->start_date }}</td>
                                <td>{{ $value->period }}</td>
                                <td>{{ $value->reason }}</td>
                                <td>{{ $value->status }}</td>
                                <td>
                                    <li class="dropdown-toggle">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                        <ul class="dropdown-menu">
                                            @if ($value->status === "pending")
                                                <li class="dropdown-item"><a href="{{  }}"><i class="fa fa-edit text-warning"></i>&nbsp;Approve</a></li>
                                            @endif
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
    <script src="{{asset("assets/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{asset("assets/js/datetime_piker.js")}}"></script>
    <script src="{{ asset('assets/js/classes.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection