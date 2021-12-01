@extends('layouts.teacher')

@section('content')
<br>
<div class="container center_div">
    <div class="card-body">
        <h4>Course {{$id}}</h4>
        <br>
        <form  method="POST" action="/my_courses/{{$id}}">
            @csrf
            <div class="row"  style="width: 400px;">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 150px;">TT-1 Total Mark</span>
                    </div>
                    <input type="number" name="tt1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3" style="width: 500px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 150px;">TT-2 Total Mark</span>
                    </div>
                    <input type="number" name="tt2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3" style="width: 500px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 150px;">Total Attendance</span>
                    </div>
                    <input type="number" name="att" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
        
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- /.row -->
    </div>
</div>
@endsection