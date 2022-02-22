@extends('layouts.app')

@section('title')
    Courses | @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.min.css")}}">
@endsection

@section('content')

<div class="pagetitle">
    <h1>Courses</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Courses</li>
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
                        <th>Code</th>
                        <th>Name</th>
                        <th>Years of study</th>
                        <th>Semester per year</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($courses as $item => $value)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$value->code}}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->years }}</td>
                                <td>{{ $value->semesters_per_year }}</td>
                                <td>
                                    <li class="dropdown-toggle">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-primary btn-sm">Action</a>
                                        <ul class="dropdown-menu">
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


<div class="modal fade" id="newCourseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><strong>New Course</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('courses.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="feedback"></div>

                <div class="row">
                    <div class="col-lg-4">
                        <label>Name <sup>*</sup></label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label>Years of Study </label>
                        <div class="input-group">
                            <input type="number" name="years" id="year" class="form-control form-control-sm @error('years') is-invalid @enderror" value="{{old('years')}}">
                        @error('years')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label>Semester per year <sup>*</sup></label>
                        <div class="input-group">
                            <input type="number" name="semesters_per_year" id="semesters_per_year" class="form-control form-control-sm @error('semesters_per_year') is-invalid @enderror" value="{{old('semesters_per_year')}}">
                        @error('semesters_per_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
                <hr>

                <h6><strong>Course Qualifications</strong></h6>

                <div class="row">
                    <div class="col-lg-12">
                        <label>Minimum mean grade <sup>*</sup></label>
                        <div class="input-group">
                            <input type="text" name="mean_grade" id="mean_grade" class="form-control form-control-sm @error('mean_grade') is-invalid @enderror" value="{{old('mean_grade')}}">
                        @error('mean_grade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <label>Other qualifications <sup>*</sup></label>
                        <div class="input-group">
                            <textarea name="qualifications" id="qualifications" class="form-control form-control-sm"></textarea>
                        @error('qualifications')
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


<div class="modal fade" id="editCourseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><strong>Edit Course</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('course.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="feedback"></div>

                    <input type="hidden" name="course_id" value="" id="editCourseID">

                    <div class="row">
                    <div class="col-lg-4">
                        <label>Name <sup>*</sup></label>
                        <div class="input-group">
                            <input type="text" name="name" id="editname" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label>Years of Study </label>
                        <div class="input-group">
                            <input type="number" name="years" id="editYears" class="form-control form-control-sm @error('years') is-invalid @enderror" value="{{old('years')}}">
                        @error('years')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label>Unit of measure <sup>*</sup></label>
                        <div class="input-group">
                            <input type="number" name="semesters_per_year" id="editSemesters_per_year" class="form-control form-control-sm @error('semesters_per_year') is-invalid @enderror" value="{{old('semesters_per_year')}}">
                        @error('semesters_per_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>

                <h6><strong>Course Qualifications</strong></h6>

                <div class="row">
                    <div class="col-lg-12">
                        <label>Minimum mean grade <sup>*</sup></label>
                        <div class="input-group">
                            <input type="text" name="mean_grade" id="editmean_grade" class="form-control form-control-sm @error('mean_grade') is-invalid @enderror" value="{{old('mean_grade')}}">
                        @error('mean_grade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <label>Other qualifications <sup>*</sup></label>
                        <div class="input-group">
                            <textarea name="qualifications" id="editqualifications" class="form-control form-control-sm"></textarea>
                        @error('qualifications')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                </div>

                <br>
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