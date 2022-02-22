@extends('layouts.app')

@section('title')
    Classes | @parent
@endsection

@section('header_styles')
        <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datepicker.min.css")}}">
@endsection

@section('content')

<div class="pagetitle">
    <h1>Classes/Intakes</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Classes/Intakes</li>
    </ol>
    </nav>
</div>

<div class=" mt-3">
    <div class="inner bg-container">
        <div class="card">
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
                        <th>Code</th>
                        <th>Course</th>
                        <th>Mode of study</th>
                        <th>Start</th>
                        <th>Expected Completion</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($classes as $item => $value)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$value->code}}</td>
                                <td>{{ $value->course->name }}</td>
                                <td>{{ $value->mode }}</td>
                                <td>{{ date('j M Y', strtotime($value->start_date)) }}</td>
                                <td>{{ date('M Y', strtotime($value->end_date)) }}</td>
                                <td>
                                    <li class="dropdown-toggle">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a href="#" id="editClassDetails" data-bs-toggle="modal" data-bs-target="#ediClassModal" data-id="{{$value->id}}"><i class="fa fa-edit text-warning"></i>&nbsp;Edit</a></li>
                                            {{-- <li class="dropdown-item"><a href="{{URL::signedRoute("item.delete",$value->id)}}"><i class="fa fa-trash text-danger"></i>&nbsp;Delete</a></li> --}}
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


<div class="modal fade" id="newClassModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><strong>New Class/Intake</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('classes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="feedback"></div>

                <div class="row">
                    <div class="col-lg-12">
                        <label>Course <sup>*</sup></label>
                        <select name="course_id" id="courseID" class="chzn-select form-control form-control-sm @error('course_id') is-invalid @enderror" style="width: 100%;">

                        </select>
                    </div>

                    <div class="col-lg-6">
                        <label>Mode of study <sup>*</sup></label>
                        <div class="input-group">
                            <select name="mode" id="mode" class="form-control form-control-sm @error('mode') is-invalid @enderror">
                                <option value="">Select One</option>
                                <option value="part-time">Part-time</option>
                                <option value="full-time">Full-time</option>
                                <option value="online">Online</option>
                            </select>
                        @error('mode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label>Start date </label>
                        <div class="input-group input-prepend input-group-prepend"
                                data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <span class="input-group-text add-on border-left-0 rounded-right">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            <input class="form-control form-control-sm date" type="text" name="start_date" placeholder="yyyy-mm-dd" value="{{date("Y-m-d")}}">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>

                <div class="col-lg-12 text-center">
                    <button class="btn btn-primary btn-sm" type="submit" id="submitCreateItem">
                        <i class="bi bi-plus"></i>
                        Submit
                    </button>
                    <button class="btn btn-warning btn-sm" type="reset">
                        <i class="bi bi-refresh"></i>
                        reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



<div class="modal fade" id="ediClassModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><strong>Edit Class/Intake</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('class.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="feedback"></div>

                <div class="row">
                    <input type="hidden" name="class_id" id="editClassID">
                    <div class="col-lg-12">
                        <label>Course <sup>*</sup></label>
                        <select name="course_id" id="editcourseID" class="chzn-select form-control form-control-sm @error('course_id') is-invalid @enderror" style="width: 100%;">

                        </select>
                    </div>

                    <div class="col-lg-6">
                        <label>Mode of study <sup>*</sup></label>
                        <div class="input-group">
                            <select name="mode" id="edtmode" class="form-control form-control-sm @error('mode') is-invalid @enderror">
                                <option value="">Select One</option>
                                <option value="part-time">Part-time</option>
                                <option value="full-time">Full-time</option>
                                <option value="online">Online</option>
                            </select>
                        @error('mode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label>Start date </label>
                        <div class="input-group input-prepend input-group-prepend"
                                data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <span class="input-group-text add-on border-left-0 rounded-right">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            <input class="form-control form-control-sm date" type="text" name="start_date" placeholder="yyyy-mm-dd" id="editdate" value="{{date("Y-m-d")}}">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>

                <div class="col-lg-12 text-center">
                    <button class="btn btn-primary btn-sm" type="submit" id="submitCreateItem">
                        <i class="bi bi-plus"></i>
                        Submit
                    </button>
                    <button class="btn btn-warning btn-sm" type="reset">
                        <i class="bi bi-refresh"></i>
                        reset
                    </button>
                </div>
            </form>
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