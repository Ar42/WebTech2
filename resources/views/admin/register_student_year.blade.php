@extends('layouts.admin')


@section('content')
<br>
<div class="container center_div">

    <div class="card-body">
        <h4>Register Students In Course . . .</h4>
        <br>
        <div class="row">
            <div class="col-md-3">
                <br>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Year</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                        @for($i = 0; $i < 5; $i++)
                        <tr>
                            <th scope="row">{{$i + 1}}</th>
                            <td><a href="/admin/register_student/year/{{date('Y') - $i}}">{{date('Y') - $i}}</a></td>
                        </tr>
                    
                        @endfor
                    </tbody>
                </table>

            </div>
            <!-- /.col -->
        </div>
        <br>
    </div>
</div>
@endsection