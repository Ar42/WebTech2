@extends('layouts.teacher')

@section('content')
<br>
<div class="container center_div">
    <div class="card-body">
        <h4>Profile</h4>
        <br>
        <form  method="POST" action="{{ route('teacher_profile.update.submit') }}">
            @csrf
            <div class="row">
                <div class="input-group mb-3" style="width: 700px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Name</span>
                    </div>
                    <input type="text" name="name" value="{{ $teacher->name }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3" style="width: 700px;">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Username</span>
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $teacher->username }}</span>
                    </div>
                </div>
                <div class="input-group mb-3" style="width: 700px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Designation</span>
                    </div>
                    <input type="text" name="des" value="{{ $teacher->des }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3" style="width: 700px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Email</span>
                    </div>
                    <input type="text" name="email" value="{{ $teacher->email }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3" style="width: 700px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Contact Number</span>
                    </div>
                    <input type="text" name="phone" value="{{ $teacher->phone }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- /.row -->
    </div>
</div>
@endsection