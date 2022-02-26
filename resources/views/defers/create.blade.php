@extends('layouts.app')

@section('title')
    New Deferment | @parent
@endsection

@section('header_styles')
    
@endsection

@section('content')
    
    <div class="pagetitle">
      <h1>New Deferment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}l">Home</a></li>
          <li class="breadcrumb-item active">New Deferment</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
        <div class="card" style="padding: .5em;border-radius: 15px;">
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
              <form action="{{ route('deferments.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Academic Year</label>
                    <input type="text" class="form-control form-control-sm" name="academic_year" value="{{ old("academic_year") }}" required placeholder="e.g 2021/2022">
                    </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Year</label>
                    <select name="year" id="year" class="form-control form-control-sm">
                        <option value="1">First Year</option>
                        <option value="2">Second Year</option>
                        <option value="3">Third Year</option>
                        <option value="4">Fourth Year</option>
                        <option value="5">Fifth Year</option>
                        <option value="6">Sixth Year</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Semester</label>
                    <select name="semester" id="semester" class="form-control form-control-sm">
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                        <option value="3">Third Semester</option>
                    </select>
                    </div>
                </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Preffered deferment start</label>
                    <input type="date" class="form-control form-control-sm" name="start_date" value="{{ old("start_date") }}" id="start_date" required>
                    </div>
                </div>
               
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Deferment period</label>
                    <select class="form-control form-control-sm" name="period" value="{{ old("period") }}" id="period">
                        <option value="1">1 Year</option>
                        <option value="2">2 Years</option>
                    </select>
                    </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Reason for transfer</label>
                    <textarea name="reason" id="reason" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
              </div>
              <br>
              
              <br>
                <div class="col-lg-12 text-center">
                    <button class="btn btn-primary btn-sm" type="submit" id="submit">
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
        
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/application.js') }}"></script>
@endsection