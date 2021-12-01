@extends('layouts.teacher')

@section('content')
<br>
<div class="container center_div">
    <div class="card-body">
        <h3>Course {{$code}}</h3>
        <br> <br>
        @if (count($all_students) > 0)
        <form method="POST" action="/teacher/my_courses/{{$code}}/marks" role="form" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Select a file to upload</span>
                </div>
                <div class="col-md-6">
                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}">
                    @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </div>
            </div>
        </form>


        <br> <br>


        <form method="POST" action="/teacher/my_courses/{{$code}}/marks">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Reg. No</th>
                                <th scope="col">TT-1 (Out of 20)</th>
                                <th scope="col">TT-2 (Out of 20)</th>
                                <th scope="col">Attendance (Out of 10)</th>
                                <th scope="col">Final Exam (Out of 70)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_students as $student)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$student->username}}</td>
                                <td><input class="form-control input-sm" id="inputsm" type="number" name="tt1[]" value="{{$student->pivot->tt1}}"></td>
                                <td><input class="form-control input-sm" id="inputsm" type="number" name="tt2[]" value="{{$student->pivot->tt2}}"></td>
                                <td><input class="form-control input-sm" id="inputsm" type="number" name="att[]" value="{{$student->pivot->att}}"></td>
                                <td><input class="form-control input-sm" id="inputsm" type="number" name="final[]" value="{{$student->pivot->final}}"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.col -->
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @else
        <h5> No student available. </h5>
        @endif
        <!-- /.row -->
    </div>

</div><!--  -->
@endsection