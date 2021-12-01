@extends('layouts.admin')


@section('content')
<br>
<div class="container center_div">
    @include('inc.message')
    <div class="card-body">
      <h4>Assign Teacher In Courses . . .</h4>
        <br>
        @if (count($all_courses) > 0)
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
                            <td><a href="/admin/assign_teacher/semester/{{$sem}}/{{$course->code}}/teachers">{{ $course->code }}</a></td>
                            <td><a href="/admin/assign_teacher/semester/{{$sem}}/{{$course->code}}/teachers">{{ $course->title }}</a></td>
                            <td>{{ $course->credit }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                  </table>

              </div>
      <!-- /.col -->
          </div>
      @else
          <h5> No course available. </h5>
      @endif
      <br>
    <!-- /.row -->
    </div>
</div>
@endsection