<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Teacher;
use App\Student;
use App\Course;
use App\Course_Student;
use App\Course_Teacher;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher')->except('my_specific_course_marks_submit');
    }

    public function index()
    {
        return view('teacher.teacher_home');
    }

    public function profile()
    {
        $teacher = Auth::user();
        return view('teacher.teacher_profile')->with('teacher', $teacher);
    }

    public function profile_update()
    {
        $teacher = Auth::user();
        return view('teacher.teacher_profile_update')->with('teacher', $teacher);
    }

    public function profile_update_show()
    {
        return view('teacher.teacher_profile_update_show');
    }

    public function profile_store(Request $request)
    {
        $id = Auth::user()->username;

        $teacher = Teacher::find($id);
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->des = $request->input('des');
        $teacher->phone = $request->input('phone');;

        $teacher->save();

        Session::flash('success', 'Profile has been updated successfully..');
        
        return redirect("/teacher/profile");
    }

    public function my_courses()
    {
        $id = Auth::User()->username;
        $username = Teacher::find($id);
        $all_courses = $username->courses()->wherePivot('year', '=', date('Y'))->get();

        return view('teacher.my_courses')->with('all_courses', $all_courses);
    }

    public function my_specific_course($id)
    {
        return view('teacher.my_specific_course')->with('id', $id);
    }

    public function my_specific_course_marks($id)
    {
        $all_students = Course::find($id)->students()->orderBy('username')->get();

        $data = array(
            'code' => $id,
            'all_students' => $all_students
        );

        return view('teacher.my_specific_course_mark')->with($data);
    }
    public function my_specific_course_marks_submit(Request $request, $code)
    {
        $upload=$request->file('file');
        if($upload != null)
        {
            //dd($upload);
            $filePath=$upload->getRealPath();

            $file=fopen($filePath, 'r');

            $headers= fgetcsv($file);

            $headerlist=[];
            foreach ($headers as $header) {
                $header=strtolower($header);
                array_push($headerlist, $header);
            }
            
            while($columns=fgetcsv($file))
            {
                //dd($columns);
                if($columns[0]=="")
                {
                    continue;
                }

                $data= array_combine($headerlist, $columns);
                //dd($data);

                $reg_no=$data['reg no'];
                $tt1=$data['tt1'];
                $tt2=$data['tt2'];
                $att=$data['attendence'];
                $final=$data['final'];

                $indv_std = Course_Student::where('username', $reg_no)
                                                ->where('code' , $code)->first();

                if($indv_std == null)
                    continue;
                if($tt1 != null)
                    $indv_std->tt1 = $tt1;
                if($tt2 != null)
                    $indv_std->tt2 = $tt2;
                if($att != null)
                    $indv_std->att = $att;
                if($final != null)
                    $indv_std->final = $final;
                //dd($indv_std);
                $cal = ($indv_std->tt1 + $indv_std->tt2)/2;
                $cal += $indv_std->att;
                $cal += $indv_std->final*.7;

                if ($cal>79)
                {
                    $indv_std->grade = 'A+';
                    $indv_std->cgpa = '4.00';
                }
                elseif ($cal>74 && $cal<80)
                {
                    $indv_std->grade = 'A';
                    $indv_std->cgpa = '3.75';
                } 
                elseif ($cal>69 && $cal<75) 
                {
                    $indv_std->grade = 'A-';
                    $indv_std->cgpa = '3.50';
                }
                elseif ($cal>64 && $cal<70) 
                {
                    $indv_std->grade = 'B+';
                    $indv_std->cgpa = '3.25';
                }
                elseif ($cal>59 && $cal<65) 
                {
                    $indv_std->grade = 'B';
                    $indv_std->cgpa = '3.00';
                }
                elseif ($cal>54 && $cal<60) 
                {
                    $indv_std->grade = 'B-';
                    $indv_std->cgpa = '2.75';
                }
                elseif ($cal>49 && $cal<55) 
                {
                    $indv_std->grade = 'C+';
                    $indv_std->cgpa = '2.50';
                }
                elseif ($cal>44 && $cal<50) 
                {
                    $indv_std->grade = 'C';
                    $indv_std->cgpa = '2.25';
                }
                elseif ($cal>39 && $cal<45) 
                {
                    $indv_std->grade = 'C-';
                    $indv_std->cgpa = '2.00';
                }
                else 
                {
                    $indv_std->grade = 'F';
                    $indv_std->cgpa = '0.00';
                }

                $indv_std->save();
            }
        }
        else
        {
            $all_students = Course::find($code)->students()->orderBy('username')->get();

            if (count($all_students))
            {
                $i = 0;
                foreach ($all_students as $student)
                {
                    $indv_std = Course_Student::where('username', $student->username)
                                                ->where('code' , $code)->first();
                    
                    if($request->tt1[$i] != null)
                        $indv_std->tt1 = $request->tt1[$i];
                    if($request->tt2[$i] != null)
                        $indv_std->tt2 = $request->tt2[$i];
                    if($request->att[$i] != null)
                        $indv_std->att = $request->att[$i];
                    if($request->final[$i] != null)
                        $indv_std->final = $request->final[$i];
                    

                    $cal = ($indv_std->tt1 + $indv_std->tt2)/2;
                    $cal += $indv_std->att;
                    $cal += $indv_std->final*.7;

                    if ($cal>79)
                    {
                        $indv_std->grade = 'A+';
                        $indv_std->cgpa = '4.00';
                    }
                    elseif ($cal>74 && $cal<80)
                    {
                        $indv_std->grade = 'A';
                        $indv_std->cgpa = '3.75';
                    } 
                    elseif ($cal>69 && $cal<75) 
                    {
                        $indv_std->grade = 'A-';
                        $indv_std->cgpa = '3.50';
                    }
                    elseif ($cal>64 && $cal<70) 
                    {
                        $indv_std->grade = 'B+';
                        $indv_std->cgpa = '3.25';
                    }
                    elseif ($cal>59 && $cal<65) 
                    {
                        $indv_std->grade = 'B';
                        $indv_std->cgpa = '3.00';
                    }
                    elseif ($cal>54 && $cal<60) 
                    {
                        $indv_std->grade = 'B-';
                        $indv_std->cgpa = '2.75';
                    }
                    elseif ($cal>49 && $cal<55) 
                    {
                        $indv_std->grade = 'C+';
                        $indv_std->cgpa = '2.50';
                    }
                    elseif ($cal>44 && $cal<50) 
                    {
                        $indv_std->grade = 'C';
                        $indv_std->cgpa = '2.25';
                    }
                    elseif ($cal>39 && $cal<45) 
                    {
                        $indv_std->grade = 'C-';
                        $indv_std->cgpa = '2.00';
                    }
                    else 
                    {
                        $indv_std->grade = 'F';
                        $indv_std->cgpa = '0.00';
                    }

                    $indv_std->save();

                    $i = $i+1;
                }
            }
        }
        Session::flash('success', 'Results Updated successfully');
        return redirect(route('my_courses'));
    }
    public function view_student_profile()
    {
        return view('teacher.view_student_profile');
    }
    
    public function show_student_profile(Request $request)
    {
        $reg = $request->input('reg');
        $student = Student::find($reg);

        $courses = $student->courses()->get();

        $data = array(
            'student' => $student,
            'courses' => $courses
        );
        return view('teacher.show_student_profile')->with($data)->with('reg', $reg);
    }

    public function teacher_change_password()
    {
        return view('teacher.change_password');
    }
    public function teacher_changed_password()
    {
        return view('teacher.changed_password');
    }
    public function teacher_change_password_submit(Request $request)
    {
        $this->validate($request, [
            'cu_pa' => 'required',
            'ne_pa' => 'required',
            'co_pa' => 'required'
        ]);
        
        $old_password = Auth::User()->password;
        //return $old_password;
        $current_password = $request->input('cu_pa');
        
        if (Hash::check($current_password, $old_password))
        {
            //return 2;
            $new_password = $request->input('ne_pa');
            $confirm_password = $request->input('co_pa');
            if ($new_password == $confirm_password)
            {
                $user = Teacher::find(Auth::User()->username);
                $user->password = Hash::make($new_password);
                $user->save();
                return redirect()->intended(route('teacher_home'))->with('success', 'Password has been changed successfully..');
            }
        }
        return redirect('/teacher/change_password')->with('error', 'Invalid Current Password');
    }
}
