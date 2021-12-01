@extends('layouts.teacher')

@section('content')
<br>
<div class="container center_div">
    <div class="card-body">
        <h4>Student Profile "{{$reg}}"</h4>
        <br>
        @if ($student != null)
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
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 200px;">Address</span>
                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 500px;">{{ $student->address }}</span>
                </div>
            </div>

        </div>
        @else
            <h5> No profile avaiable. </h5>
        @endif
    </div>
    <div class="card-body">
        <h4>Courses & Results</h4>
        <br>
        @if (count($courses)>0)
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Title</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$course->code}}</td>
                            <td>{{$course->title}}</td>
                            <td>{{$course->credit}}</td>
                            <td>@if ($course->pivot->cgpa != null)
                                    {{$course->pivot->cgpa}}
                                @else
                                    F
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <h5> No result avaiable. </h5>
        @endif
    </div>
</div>
@endsection