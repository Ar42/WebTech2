@extends('layouts.admin')

@section('content')
<br>
<div class="container center_div">
  <div class="card-body">
    <h4>Register Students In Course</h4>
    <br>
    <div class="row">
      <div class="col-md-6">
        <br>
        <h5>First Year</h5>
        <table class="table" style="width: 400px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{1}}/courses">First Semester</a></th>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{2}}/courses">Second Semester</a></th>
            </tr>
          </thead>
        </table>

        <h5>Second Year</h5>
        <table class="table" style="width: 400px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{3}}/courses">First Semester</a></th>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{4}}/courses">Second Semester</a></th>
            </tr>
          </thead>
        </table>

        <h5>Third Year</h5>
        <table class="table" style="width: 400px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{5}}/courses">First Semester</a></th>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{6}}/courses">Second Semester</a></th>
            </tr>
          </thead>
        </table>

        <h5>Fourth Year</h5>
        <table class="table" style="width: 400px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{7}}/courses">First Semester</a></th>
              <th scope="col"><a href="/admin/register_student/year/{{$year}}/semester/{{8}}/courses">Second Semester</a></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <br>
  </div>
</div>
@endsection