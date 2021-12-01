<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Student;
use App\Teacher;
use App\Course;
use App\Course_Teacher;
use App\Course_Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $courses = Course::all();

        return view('admin.home')->with('students', $students)->with('teachers', $teachers)->with('courses', $courses);
    }

    public function student_add()
    {
        return view('admin.student_add');
    }
    public function student_store(Request $request)
    {
        $this->validate($request, [
            'ref' => 'required',
            'ret' => 'required'
        ]);

        $reg_nof = $request->input('ref');
        $reg_not = $request->input('ret');

        if ($reg_nof > $reg_not) {
            Session::flash('error', 'Starting registration number can not be larger than Ending registration number..');

            return redirect(route('student_add'));
        }

        while ($reg_nof <= $reg_not) {
            $student = new Student;
            $student->username = $reg_nof;
            $student->password = Hash::make($reg_nof);
            $student->year = substr($reg_nof, 0, 4);
            $student->save();


            if (($reg_nof[9] - '0') < 9)
                $reg_nof[9] = (($reg_nof[9] - '0') + 1) + '0';
            else {
                $reg_nof[9] = '0';

                if (($reg_nof[8] - '0') < 9)
                    $reg_nof[8] = (($reg_nof[8] - '0') + 1) + '0';
                else {
                    $reg_nof[8] = '0';
                    $reg_nof[7] = (($reg_nof[7] - '0') + 1) + '0';
                }
            }
        }

        Session::flash('success', 'Students have been added successfully..');

        return redirect()->intended(route('home'));
    }

    public function student_remove()
    {
        return view('admin.student_remove');
    }
    public function student_delete(Request $request)
    {
        $this->validate($request, [
            'reg' => 'required'
        ]);

        $student = Student::find($request->input('reg'));
        $student->delete();

        $all_courses = Course_Student::where('username', '=', $request->input('reg'))->get();
        foreach ($all_courses as $course) {
            $course->delete();
        }
        Session::flash('success', 'Student has been removed successfully..');

        return redirect()->intended(route('home'));
    }

    public function teacher_add()
    {
        return view('admin.teacher_add');
    }
    public function teacher_store(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
        ]);

        $teacher = new Teacher;
        $teacher->username = $request->input('user');
        $teacher->password = Hash::make('12345678');
        $teacher->save();

        Session::flash('success', 'Teacher has been added successfully..');

        return redirect()->intended(route('home'));
    }

    public function teacher_remove()
    {
        return view('admin.teacher_remove');
    }
    public function teacher_delete(Request $request)
    {
        $this->validate($request, [
            'user' => 'required'
        ]);

        $teacher = Teacher::find($request->input('user'));
        $teacher->delete();

        $all_courses = Course_Teacher::where('username', '=', $request->input('user'))->get();
        foreach ($all_courses as $course) {
            $course->delete();
        }
        Session::flash('success', 'Teacher has been removed successfully..');

        return redirect()->intended(route('home'));
    }

    public function assign_teacher()
    {
        return view('admin.assign_teacher');
    }

    public function semesterwise_courses($sem)
    {
        //return $id;
        $all_courses = Course::where('sem', '=', $sem)->get();
        //return $all_courses;

        $url =  url()->current();
        $check = 'assign_teacher';

        if (strpos($url, $check) !== false)
            return view('admin.assign_teacher_course')->with('all_courses', $all_courses)->with('sem', $sem);
        else
            return view('admin.register_student_course')->with('all_courses', $all_courses)->with('sem', $sem);
    }
    public function semesterwise_courses1($year, $sem)
    {
        //return $id;
        $all_courses = Course::where('sem', '=', $sem)->get();
        //return $all_courses;

        $url =  url()->current();
        $check = 'assign_teacher';

        if (strpos($url, $check) !== false)
            return view('admin.assign_teacher_course')->with('all_courses', $all_courses)->with('sem', $sem);
        else
            return view('admin.register_student_course')->with('all_courses', $all_courses)->with('sem', $sem)->with('year', $year);
    }

    public function assign_teacher_show($sem, $code)
    {
        $teachers = Course_Teacher::where('code', '=', $code)->get();
        //return $teachers;

        $all_teacher[] = "";
        $i = 0;
        foreach ($teachers as $teacher) {
            $all_teacher[$i] = $teacher->username;
            $i++;
        }

        $all_teachers = Teacher::whereNotIn('username', $all_teacher)->get();

        //return $all_teachers;

        return view('admin.assign_teacher_show')->with('code', $code)->with('all_teachers', $all_teachers)->with('sem', $sem);
    }
    public function assign_teacher_show_submit(Request $request, $sem, $code)
    {
        if ($request->teachers != null) {
            $teachers = $request->input('teachers');
            //return $teachers;

            $i = 0;
            foreach ($teachers as $teacher) {
                //return $teacher;
                $assigned_teacher = new Course_Teacher;
                $assigned_teacher->code = $code;
                $assigned_teacher->username = $teacher;
                $assigned_teacher->year = date('Y');
                $assigned_teacher->save();
                $i++;
            }
        }

        $success = 'Teacher has been assigned successfully..';
        if ($i > 1)
            $success = 'Teachers have been assigned successfully..';

        Session::flash('success', $success);
        return redirect("/admin/assign_teacher/semester/$sem/courses");
    }
    public function register_student_year()
    {
        return view('admin.register_student_year');
    }
    public function register_student($year)
    {
        return view('admin.register_student')->with('year', $year);
    }
    public function register_student_show($year, $sem, $code)
    {
        //return $code;
        $students = Course_Student::where([
            ['code', '=', $code],
            ['grade', '!=', 'F'],
            ['year', '=', date('Y')]
        ])->get();
        //return $students;

        $all_student[] = "";
        $i = 0;
        foreach ($students as $student) {
            $all_student[$i] = $student->username;
            $i++;
        }

        $all_students = Student::whereNotIn('username', $all_student)
            ->where('year', $year)->get();
        //return $all_students;

        return view('admin.register_student_show')->with('code', $code)->with('all_students', $all_students)->with('sem', $sem)->with('year', $year);
    }
    public function register_student_show_submit(Request $request, $year, $sem, $code)
    {
        if ($request->students != null) {
            $students = $request->input('students');
            //return $teachers;

            $i = 0;
            foreach ($students as $student) {
                //return $teacher;
                $registered_student = Course_Student::where('username', $student)
                                                    ->where('code', $code)->first();
                if($registered_student == null)
                {
                    $registered_student = new Course_Student;
                    $registered_student->code = $code;
                    $registered_student->username = $student;
                    $registered_student->year = date('Y');
                    $registered_student->grade = 'F';
                    $registered_student->save();
                    $i++;
                }
                else
                {
                    $registered_student->year = date('Y');
                    $registered_student->grade = 'F';
                    $registered_student->save();
                    $i++;
                }
            }
        }

        $success = 'Student has been registered successfully..';
        if ($i > 1)
            $success = 'Students have been registered successfully..';

        Session::flash('success', $success);

        return redirect("/admin/register_student/year/$year/semester/$sem/courses");
    }

    public function add_course()
    {
        return view('admin.course_add');
    }
    public function add_course_submit(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'title' => 'required',
            'credit' => 'required',
            'sem' => 'required'
        ]);

        $course = new Course;

        $course->code = $request->input('code');
        $course->title = $request->input('title');
        $course->credit = $request->input('credit');
        $course->desc = $request->input('desc');
        $course->sem = $request->input('sem');

        $course->save();

        Session::flash('success', 'Course has been added successfully..');

        return redirect('/admin/home');
    }

    public function remove_course()
    {
        return view('admin.course_remove');
    }
    public function remove_course_submit(Request $request)
    {
        $this->validate($request, [
            'code' => 'required'
        ]);

        $course = Course::find($request->input('code'));
        if ($course != null)
            $course->delete();

        return redirect()->intended(route('home'))->with('success', 'Course has been removed successfully..');
    }

    public function change_password()
    {
        return view('admin.change_password');
    }

    public function change_password_submit(Request $request)
    {
        $this->validate($request, [
            'cu_pa' => 'required',
            'ne_pa' => 'required',
            'co_pa' => 'required'
        ]);

        $old_password = Auth::User()->password;
        $current_password = $request->input('cu_pa');

        if (Hash::check($current_password, $old_password)) {
            $new_password = $request->input('ne_pa');
            $confirm_password = $request->input('co_pa');
            if ($new_password == $confirm_password) {
                $user = User::find(Auth::User()->username);
                $user->password = Hash::make($new_password);
                $user->save();
                return redirect('/admin/home')->with('success', 'Password has been changed successfully..');
            }
        }

        return redirect('/admin/change_password')->with('error', 'Invalid Current Password');
    }

    public function select_all($year, $sem, $code)
    {
        //$grade = ['null', 'F'];
        $students = Course_Student::where([
            ['code', '=', $code],
            ['grade', '!=', 'F'],
            ['year', '=', date('Y')]
        ])->get();
        //return $students;

        $all_student[] = "";
        $i = 0;
        foreach ($students as $student) {
            $all_student[$i] = $student->username;
            $i++;
        }

        $all_students = Student::whereNotIn('username', $all_student)
            ->where('year', $year)->get();
        //return $all_students;

        return view('admin.select_all')->with('code', $code)->with('all_students', $all_students)->with('sem', $sem)->with('year', $year);
    }
    public function select_all_submit(Request $request, $year, $sem, $code)
    {
        if ($request->students != null) {
            $students = $request->input('students');
            //return $teachers;

            $i = 0;
            foreach ($students as $student) {
                //return $teacher;
                $registered_student = new Course_Student;
                $registered_student->code = $code;
                $registered_student->username = $student;
                $registered_student->year = date('Y');
                $registered_student->grade = 'F';
                $registered_student->save();
                $i++;
            }
        }

        $success = 'Student has been registered successfully..';
        if ($i > 1)
            $success = 'Students have been registered successfully..';

        Session::flash('success', $success);

        return redirect("/admin/register_student/year/$year/semester/$sem/courses");
    }
}
