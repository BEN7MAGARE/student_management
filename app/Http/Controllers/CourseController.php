<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Unit;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public $course;
    public $courseunit;
    public $qualification;
    public function __construct()
    {
        $this->middleware('auth');
        $this->course = new Course();
        $this->qualification = new Qualification();
    }

    public function index()
    {
        $courses = $this->course->get();
        return view('courses.index',compact('courses'));
    }

    public function create()
    {
        $courses = $this->course->get();
        return view('courses.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $code = $this->course->generateCode($request->name,$request->mode);
        $courses = $this->course->where('code',$code)->get();
        if (count($courses) > 0) {
            return redirect()->back()->with('error','Course with similar name already exists');
        }else {
            $validated = $this->course->validate($request);
            DB::beginTransaction();
            $course = $this->course->create(['code'=>$code]+$validated);
            $qualification = $this->qualification->create(["course_id"=>$course->id]+$validated);
            DB::commit();
            return redirect()->back()->with('success','Course created successfully');
        }
    }

    public function get()
    {
        $courses = $this->course->get();
        return json_encode($courses);
    }

    public function show($id)
    {
        $course = $this->course->with('qualification')->find($id);
        return json_encode($course);
    }

    public function scheduleCourse(Request $request)
    {
        $this->courseunit->createSchedule($request);
        return json_encode(['status'=>'success']);
    }

    public function update(Request $request)
    {
        $validated = $this->course->validate($request);
        $course = $this->course->where('id',$request->course_id)->first();
        $qualification = $course->qualification;
        if (!is_null($qualification)) {
            $qualification->update($validated);
        }else {
            $this->qualification->create(['course_id'=>$course->id]+$validated);
        }
        $course->update($validated);
        return redirect()->back()->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {

    }
}