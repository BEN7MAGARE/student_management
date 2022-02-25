@extends('layouts.app')

@section('title')
    New Application | @parent
@endsection

@section('header_styles')
    
@endsection

@section('content')
    
    <div class="pagetitle">
      <h1>New Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}l">Home</a></li>
          <li class="breadcrumb-item active">New Application</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
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
              <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <h6><strong>Basic Information</strong></h6>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">First name</label>
                    <input type="text" class="form-control form-control-sm" name="first_name" value="{{ old("first_name") }}" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Surname</label>
                    <input type="text" class="form-control form-control-sm" name="surname" value="{{ old("surname") }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Last name</label>
                    <input type="text" class="form-control form-control-sm" name="last_name" value="{{ old("last_name") }}" required>
                    </div>
                </div>
              </div>
              <br>
              <h6><strong>Contact Information</strong></h6>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" value="{{ old("email") }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control form-control-sm" name="phone" value="{{ old("phone") }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Alt Phone</label>
                    <input type="text" class="form-control form-control-sm" name="alt_phone" value="{{ old("alt_phone") }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control form-control-sm" name="address" value="{{ old("address") }}" required>
                    </div>
                </div>
              </div>
              <br>
              <h6><strong>Background Information</strong></h6>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Home County</label>
                    <select name="county" value="{{ old('county') }}" id="county" class="form-control form-control-sm" required>
                      <option value="">Select One</option>
                      <option value="Mombasa">Mombasa</option>
                      <option value="Kwale">Kwale</option>
                      <option value="Kisumu">Kisumu</option>
                      <option value="Nairobi">Nairobi</option>
                      <option value="Nyeri">Nyeri</option>
                      <option value="Machakos">Machakos</option>
                      <option value="Makueni">Makueni</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Constituency</label>
                    <input type="text" class="form-control form-control-sm" name="constituency" value="{{ old('constituency') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Location</label>
                    <input type="text" class="form-control form-control-sm" name="location" value="{{ old('location') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Sub-location</label>
                    <input type="text" class="form-control form-control-sm" name="sublocation" value="{{ old('sublocation') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Village</label>
                    <input type="text" class="form-control form-control-sm" name="village" value="{{ old('village') }}" required>
                    </div>
                </div>
              </div>
              <br>
              <h6><strong>Next of kin Information</strong></h6>
              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control form-control-sm" name="next_of_kin_name" value="{{ old('next_of_kin_name') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control form-control-sm" name="next_of_kin_email" value="{{ old('next_of_kin_email') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control form-control-sm" name="next_of_kin_phone" value="{{ old('next_of_kin_phone') }}" required>
                    </div>
                </div>
              </div>
              <br>
              <h6><strong>Academic Information</strong></h6>
              <div class="row">
                <div class="col-md-4">
                  <label for="">KCSE year</label>
                    <input type="text" class="form-control form-control-sm" name="kcse_year" value="{{ old('kcse_year') }}" required>
                </div>

                <div class="col-md-4">
                  <label for="">KCSE Index NO</label>
                  <input type="text" class="form-control form-control-sm" name="kcse_index_no" value="{{ old('kcse_index_no') }}" required>
                </div>
                <div class="col-md-4">
                  <label for="">KCSE Mean Grade</label>
                  <input type="text" class="form-control form-control-sm" name="kcse_mean_grade" value="{{ old('kcse_mean_grade') }}" required>
                </div>

                <div class="col-md-4">
                  <label for="">KCSE Certificate</label>
                  <input type="file" class="form-control form-control-sm" name="kcse_certificate" value="{{ old('kcse_certificate') }}" required>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <label for="">KCPE year</label>
                    <input type="text" class="form-control form-control-sm" name="kcpe_year" value="{{ old('kcpe_year') }}" required>
                </div>

                <div class="col-md-4">
                  <label for="">KCPE Index NO</label>
                  <input type="text" class="form-control form-control-sm" name="kcpe_index_no" value="{{ old('kcpe_index_no') }}" required>
                </div>
                <div class="col-md-4">
                  <label for="">KCPE Mean Grade</label>
                  <input type="text" class="form-control form-control-sm" name="kcpe_mean_grade" value="{{ old('kcpe_mean_grade') }}" required>
                </div>

                <div class="col-md-4">
                  <label for="">KCPE Certificate</label>
                  <input type="file" class="form-control form-control-sm" name="kcpe_certificate" value="{{ old('kcpe_certificate') }}" required>
                </div>
              </div>
            <br>
              <h6><strong>Course Information</strong></h6>
              <div class="row">
                <div class="col-md-12">
                  <label for="">Course</label>
                    <select name="class_id" id="classID" class="form-control form-control-sm" value="{{ old('class_id') }}" required>
                      <option value="">Select one</option>
                      @foreach ($classes as $item)
                          <option value="{{ $item->id }}">{{ date('Y',strtotime($item->start_date))." ".$item->code." ".$item->course->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-12 bg-">
                  <h6><strong>KCSE Minimum Grade: </strong> <span id="minimumMeanGrade"></span></h6>
                </div>
                <div class="col-md-12" id="courseDescription">
                  
                </div>
              </div>
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