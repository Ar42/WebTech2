@extends('layouts.admin')


@section('content')
<br>
<div class="container center_div">
    @include('inc.message')
    <div class="card-body">
        <h4>Register Students In Course . . .</h4>
        <br>
        <div class="row">
            <div class="col-md-9">
                <br>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Title</th>
                            <th scope="col">Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_courses as $course)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><a href="/admin/register_student/year/{{$year}}/semester/{{$sem}}/courses/{{$course->code}}/students">{{ $course->code }}</a></td>
                            <td><a href="/admin/register_student/year/{{$year}}/semester/{{$sem}}/courses/{{$course->code}}/students">{{ $course->title }}</a></td>
                            <td>{{ $course->credit }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.col -->
        </div>
        <br>
        <!-- /.row -->
    </div>
</div>
@endsection