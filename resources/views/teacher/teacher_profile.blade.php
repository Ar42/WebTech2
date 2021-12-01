@extends('layouts.teacher')

@section('content')
<br>
<div class="container center_div">
    @include('inc.message')
    <div class="card-body">
        <h4>Profile</h4>
        <br>
        <div class="row">
            <div class="input-group mb-3" style="width: 700px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Name</span>
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $teacher->name }}</span>
                </div>
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
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $teacher->des }}</span>
                </div>

            </div>
            <div class="input-group mb-3" style="width: 700px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Email</span>
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $teacher->email }}</span>
                </div>

            </div>
            <div class="input-group mb-3" style="width: 700px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Contact Number</span>
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $teacher->phone }}</span>
                </div>

            </div>
        </div>
        <br>
        <h5><a href="{{route('teacher_profile_update')}}" class="button">Update Profile</a></h5>
        <!-- /.row -->
    </div>
</div><!--  -->
@endsection
