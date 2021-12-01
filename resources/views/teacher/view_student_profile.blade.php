@extends('layouts.teacher')

@section('content')
<br>
<div class="container center_div">
  <div class="card-body">
    <h4>Search For A Student</h4>
    <br>
  <form  method="GET" action="{{ route('show_student_profile')}}">
    @csrf
      <div class="row">
        <div class="input-group mb-3" style="width: 400px;">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 150px;">Registration No</span>
          </div>
          <input type="text" name="reg" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
      <!-- /.row -->
  </div>
</div>
@endsection