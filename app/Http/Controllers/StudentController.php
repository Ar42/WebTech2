<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Student;
use App\Course;
use App\Course_Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        return view('student.student_home');
    }
    public function profile()
    {
        $student = Auth::user();
        return view('student.student_profile')->with('student', $student);
    }
    public function profile_update()
    {
        $student = Auth::user();
        return view('student.student_profile_update')->with('student', $student);
    }    

    
    public function profile_update_show()
    {
        $student = Auth::user();
        return view('student.student_profile_update_show')->with('student', $student);
    }
    public function profile_store(Request $request)
    {
        $id = Auth::user()->username;

        $student = Student::find($id);
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->dob = $request->input('dob');
        $student->phone = $request->input('phone');
        $student->address = $request->input('address');

        $student->save();
        
        Session::flash('success', 'Profile has been updated successfully..');

        return redirect("/student/profile");
    }

    public function student_change_password()
    {
        return view('student.change_password');
    }
    public function student_changed_password()
    {
        return view('student.changed_password');
    }
    
    public function student_change_password_submit(Request $request)
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
                $user = Student::find(Auth::User()->username);
                $user->password = Hash::make($new_password);
                $user->save();
                Session::flash('success', 'Password has been changed successfully');
                return redirect('/student/change_password');
            }
        }
        Session::flash('error', 'Invalid Current Password');
        return redirect('/student/change_password');
    }








    public function total_result()
    {
        $id = Auth::user()->username;
        $student = Student::find($id);
        
        $coursesx = Course_Student::where([['username', '=', $id],])->get();
        
        //return $coursesx;
        if(count($coursesx)< 1)
            return "No Result Found";
        
       $i=0;
       $all_courses[]="";
       $all_grades[]="";
       $all_cgpa[]="";
        foreach($coursesx as $course)
        {
            $all_courses[$i]=$course->code;
            $all_grades[$i]=$course->grade;
            $all_cgpa[$i]=$course->cgpa;
            $i++;
        }

        $courses = Course::whereIn('code', $all_courses)->get();
        $credits = 0;
        foreach($courses as $course)
            $credits += $course->credit;

        $total_gpa = 0;

        foreach($courses as $course)
        {
            foreach($coursesx as $y)
            {
                if($course->code == $y->code)
                    $total_gpa += ($course->credit * $y->cgpa);
            }
        }

        if($credits != 0)
            $total_gpa /= $credits;
        $total_gpa = number_format($total_gpa, 2, '.', '');

        if ($total_gpa == 4)
        {
            $tgrade = 'A+';
        }
        elseif ($total_gpa>3.74 && $total_gpa<4)
        {
            $tgrade = 'A';
        } 
        elseif ($total_gpa>3.49 && $total_gpa<3.75) 
        {
            $tgrade = 'A-';
        }
        elseif ($total_gpa>3.24 && $total_gpa<3.5) 
        {
            $tgrade = 'B+';
        }
        elseif ($total_gpa>2.99 && $total_gpa<3.25) 
        {
            $tgrade = 'B';
        }
        elseif ($total_gpa>2.74 && $total_gpa<3) 
        {
            $tgrade = 'B-';
        }
        elseif ($total_gpa>2.49 && $total_gpa<2.75) 
        {
            $tgrade = 'C+';
        }
        elseif ($total_gpa>2.24 && $total_gpa<2.5) 
        {
            $tgrade = 'C';
        }
        elseif ($total_gpa>1.99 && $total_gpa<2.25) 
        {
            $tgrade = 'C-';
        }
        else 
        {
            $tgrade = 'F';
        }
        return view('student.total_result')->with('student', $student)->with('courses', $courses)->with('credits', $credits)->with('total_gpa', $total_gpa)->with('tgrade', $tgrade)
                                            ->with('all_grades', $all_grades)->with('all_cgpa', $all_cgpa);
    }
    public function semester_wise_result($sem)
    {
        $id = Auth::user()->username;
        switch ($sem) {
            case '1':
                $year = 'First';
                $semester = 'First';
                break;
            case '2':
                $year = 'First';
                $semester = 'Second';
                break;
            case '3':
                $year = 'Second';
                $semester = 'First';
                break;
            case '4':
                $year = 'Second';
                $semester = 'Second';
                break;
            case '5':
                $year = 'Third';
                $semester = 'First';
                break;
            case '6':
                $year = 'Third';
                $semester = 'Second';
                break;
            case '7':
                $year = 'Fourth';
                $semester = 'First';
                break;
            case '8':
                $year = 'Fourth';
                $semester = 'Second';
                break;
            default:
                break;
        }
        $sem_courses = Course::where('sem', '=', $sem)->get();
        $all_courses[]="";
        $i=0;
        foreach($sem_courses as $course)
        {
            $all_courses[$i]=$course->code;
            $i++;
        }

        $student_courses = Course_Student::whereIn('code', $all_courses)
                            ->where('username', $id)
                            ->get();
        
        //if(count($x) < 1)
            //return 1;
        $sem_credits = 0;
        $sem_gpa = 0;
        $i=0;
        $grade[]="";
        $gpa[]="";
        foreach($sem_courses as $course)
        {
            if(count($student_courses) < 1)
            {
                $grade[$i] = 'F';
                $gpa[$i] = '0.00';
            }
            foreach($student_courses as $student_course)
            {
                if($course->code == $student_course->code)
                {
                    $grade[$i] = $student_course->grade;
                    $gpa[$i] = $student_course->cgpa;
                    $sem_credits += $course->credit;
                    $sem_gpa += ($course->credit * $student_course->cgpa);
                    break;
                }
                $grade[$i] = 'F';
                $gpa[$i] = '0.00';
            }
            $i++;
        }
        //return $cgpa;
        if($sem_credits != 0)
            $sem_gpa /= $sem_credits;
        $sem_gpa = number_format($sem_gpa, 2, '.', '');
        
        if ($sem_gpa == 4)
        {
            $sem_grade = 'A+';
        }
        elseif ($sem_gpa>3.74 && $sem_gpa<4)
        {
            $sem_grade = 'A';
        } 
        elseif ($sem_gpa>3.49 && $sem_gpa<3.75) 
        {
            $sem_grade = 'A-';
        }
        elseif ($sem_gpa>3.24 && $sem_gpa<3.5) 
        {
            $sem_grade = 'B+';
        }
        elseif ($sem_gpa>2.99 && $sem_gpa<3.25) 
        {
            $sem_grade = 'B';
        }
        elseif ($sem_gpa>2.74 && $sem_gpa<3) 
        {
            $sem_grade = 'B-';
        }
        elseif ($sem_gpa>2.49 && $sem_gpa<2.75) 
        {
            $sem_grade = 'C+';
        }
        elseif ($sem_gpa>2.24 && $sem_gpa<2.5) 
        {
            $sem_grade = 'C';
        }
        elseif ($sem_gpa>1.99 && $sem_gpa<2.25) 
        {
            $sem_grade = 'C-';
        }
        else 
        {
            $sem_grade = 'F';
        }

        return view('student.semester_wise_result')->with('year', $year)->with('semester', $semester)
                                                    ->with('sem_credits', $sem_credits)->with('sem_gpa', $sem_gpa)->with('sem_grade', $sem_grade)
                                                    ->with('sem_courses', $sem_courses)->with('gpa', $gpa)->with('grade', $grade);
    }
}
