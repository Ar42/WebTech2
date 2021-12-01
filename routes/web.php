<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin/home', 'HomeController@index')->name('home');
Route::get('/admin/logout', 'Auth\LoginController@adminLogout')->name('admin.logout');

Route::get('/admin/student_add', 'HomeController@student_add')->name('student_add');
Route::post('/admin/student_add', 'HomeController@student_store')->name('student.add.submit');

Route::get('/admin/student_remove', 'HomeController@student_remove')->name('student_remove');
Route::post('/admin/student_remove', 'HomeController@student_delete')->name('student.remove.submit');

Route::get('/admin/teacher_add', 'HomeController@teacher_add')->name('teacher_add');
Route::post('/admin/teacher_add', 'HomeController@teacher_store')->name('teacher.add.submit');

Route::get('/admin/teacher_remove', 'HomeController@teacher_remove')->name('teacher_remove');
Route::post('/admin/teacher_remove', 'HomeController@teacher_delete')->name('teacher.remove.submit');

Route::get('/admin/assign_teacher', 'HomeController@assign_teacher')->name('assign_teacher');
Route::get('/admin/assign_teacher/semester/{sem}/courses', 'HomeController@semesterwise_courses');

Route::get('/admin/assign_teacher/semester/{sem}/{code}/teachers', 'HomeController@assign_teacher_show');
Route::post('/admin/assign_teacher/semester/{sem}/{code}/teachers', 'HomeController@assign_teacher_show_submit');

Route::get('/admin/register_student/year', 'HomeController@register_student_year')->name('register_student_year');
Route::get('/admin/register_student/year/{year}', 'HomeController@register_student')->name('register_student');
Route::get('/admin/register_student/year/{year}/semester/{sem}/courses', 'HomeController@semesterwise_courses1');

Route::get('/admin/register_student/year/{year}/semester/{sem}/courses/{code}/students', 'HomeController@register_student_show');
Route::post('/admin/register_student/year/{year}/semester/{sem}/courses/{code}/students', 'HomeController@register_student_show_submit');

Route::get('/admin/register_student/year/{year}/semester/{sem}/courses/{code}/students/all_selected', 'HomeController@select_all');
Route::post('/admin/register_student/year/{year}/semester/{sem}/courses/{code}/students/all_selected', 'HomeController@select_all_submit');

Route::get('/admin/change_password', 'HomeController@change_password')->name('admin.change_password');
Route::post('/admin/change_password', 'HomeController@change_password_submit')->name('admin.change_password.submit');

Route::get('/admin/course_add', 'HomeController@add_course')->name('add_course');
Route::post('/admin/course_add', 'HomeController@add_course_submit')->name('add_course_submit');

Route::get('/admin/course_remove', 'HomeController@remove_course')->name('remove_course');
Route::post('/admin/course_remove', 'HomeController@remove_course_submit')->name('remove_course.submit');





Route::get('/student/home', 'StudentController@index')->name('student_home');
Route::get('/student/logout', 'Auth\StudentLoginController@logout')->name('student.logout');

Route::get('/student/login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
Route::post('/student/login', 'Auth\StudentLoginController@login')->name('student.login.submit');

Route::get('/student/profile', 'StudentController@profile')->name('profile');
Route::get('/student/profile/update', 'StudentController@profile_update')->name('profile_update');
Route::post('/student/profile/update', 'StudentController@profile_store')->name('profile.update.submit');

Route::get('/student/change_password', 'StudentController@student_change_password')->name('student.change_password');
Route::post('/student/change_password', 'StudentController@student_change_password_submit')->name('student.change_password.submit');

Route::get('/student/total_result', 'StudentController@total_result')->name('student.total_result');
Route::get('/student/semester/{sem}/result', 'StudentController@semester_wise_result');



Route::get('/teacher/home', 'TeacherController@index')->name('teacher_home');
Route::get('/teacher/logout', 'Auth\TeacherLoginController@logout')->name('teacher.logout');

Route::get('/teacher/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher/login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');

Route::get('/teacher/profile', 'TeacherController@profile')->name('teacher_profile');

Route::get('/teacher/profile/update', 'TeacherController@profile_update')->name('teacher_profile_update');
Route::post('/teacher/profile/update', 'TeacherController@profile_store')->name('teacher_profile.update.submit');

Route::get('/teacher/my_courses', 'TeacherController@my_courses')->name('my_courses');
Route::get('/teacher/my_courses/{code}/marks', 'TeacherController@my_specific_course_marks');
Route::post('/teacher/my_courses/{code}/marks', 'TeacherController@my_specific_course_marks_submit');

Route::get('/teacher/view_student_profile', 'TeacherController@view_student_profile')->name('view_student_profile');
Route::get('/teacher/show_student_profile', 'TeacherController@show_student_profile')->name('show_student_profile');

Route::get('/teacher/change_password', 'TeacherController@teacher_change_password')->name('teacher.change_password');
Route::post('/teacher/change_password', 'TeacherController@teacher_change_password_submit')->name('teacher.change_password.submit');
