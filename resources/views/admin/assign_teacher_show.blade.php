@extends('layouts.admin')

@section('content')
<br>
<div class="container center_div">
    <div class="card-body">
        <h4>Assign Teacher(s) In Course "{{$code}}"</h4>
        <br>
        @if (count($all_teachers) > 0)
        <form method="POST" action="/admin/assign_teacher/semester/{{$sem}}/{{$code}}/teachers">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Name</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_teachers as $teacher)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $teacher->username }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" name="teachers[]" value="{{ $teacher->username }}">
                                    </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        <!-- /.row -->
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @else
            <h5> No teacher available. </h5>
        @endif
    </div>

</div><!--  -->
@endsection