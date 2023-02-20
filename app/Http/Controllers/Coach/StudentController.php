<?php

namespace App\Http\Controllers\Coach;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


use App\Models\Coach\Student;
use App\Models\Coach\Course;
use Validator;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  
    public function students(Request $request){
        $data['studentGroup']       =   'is-expanded active';
        $data['studentMenu']        =   'active';
        $data['title']              =   'Students';
        $data['students']           =   Student::students(auth()->user()->id);
        return view('coach.pages.students.list', $data);
    }
    
    public function student($id){
        $data['studentGroup']       =   'is-expanded active';
        $data['studentMenu']        =   'active';
        $student                    =   Student::student(auth()->user()->id,$id);
        $data['title']              =   $student->name;
        $data['student']            =   $student;
        $data['parentName']         =   Student::getParentName($student->parent);
        $data['regCourses']         =   Student::getRegCoursesByStudentId(auth()->user()->id,$student->user_id);
        return view('coach.pages.students.details', $data);
    }
    
    function updatePercent(Request $request){
        return Student::updateCoursePercent((object)$request->post());
    }
    
    function courseStudent($regId,$sId){
        $data['courseGroup']        =   'is-expanded active';
        $data['courseMenu']         =   'active';
        $data['title']              =   'Student Activities';
        $data['id']                 =   $sId; 
        $studActivities             =   Course::getStudentActivities(auth()->user()->id,$regId,$sId);
            $data['courseName']     =   Course::getCourseByRegCId(auth()->user()->id,$regId)->course_name;
            $data['studentName']    =   Course::getUserById($sId)->name;
            $data['activities']     =   $studActivities;
            return view('coach.pages.students.details.student_activities', $data);
    }
    
    function studSubmitActivity($id,$sid,$aid){
        $data['courseGroup']        =   'is-expanded active';
        $data['sActMenu']           =   'active';
        $activity                   =   Course::getSubmitedActivity(auth()->user()->id,$aid);
        if($activity){
            $data['title']          =   $activity->activity_name;
            $data['activity']       =   $activity;
            $data['badges']         =   Course::getBadges('dropdown');
            $data['medias']         =   Course::getSubmitedMedia(auth()->user()->id,$aid);
            return view('coach.pages.students.details.student_details', $data);
        }else{ return redirect("/coach/course/$id/$sid"); }
    }
}
