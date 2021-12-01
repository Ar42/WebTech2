@extends('layouts.student')

@section('content')
<br>
<div class="container center_div">
  @include('inc.message')
  <div class="card-body">
    <h4>Profile . .</h4>
    <br>
    <div class="row">
      <div class="input-group mb-3" style="width: 700px;">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Name</span>
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->name }}</span>
        </div>
      </div>
      <div class="input-group mb-3" style="width: 700px;">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Registration No</span>
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->username }}</span>
        </div>
      </div>
      <div class="input-group mb-3" style="width: 700px;">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Email</span>
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->email }}</span>
        </div>

      </div>
      <div class="input-group mb-3" style="width: 700px;">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Date of Birth(DD/MM/YY)</span>
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->dob }}</span>
        </div>

      </div>
      <div class="input-group mb-3" style="width: 700px;">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Contact Number</span>
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->phone }}</span>
        </div>

      </div>
      <div class="input-group mb-3" style="width: 700px;">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Address</span><br><br><br>
          <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->address }}</span>
        </div>
      </div>

    </div>
    <br>
    <h5><a href="{{ route('profile_update') }}" class="button">Update Profile</a></h5>
  </div>
</div>
@endsection
