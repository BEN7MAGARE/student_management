<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Course;
use DateTime;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public $class;
    public $course;

    public function __construct()
    {
        $this->middleware('auth');
        $this->class = new Classes();
        $this->course = new Course();
    }

    public function index()
    {
        $classes = $this->class->with('course')->orderBy('id','DESC')->get();
        return view('classes.index',compact('classes'));
    }


    public function create()
    {
        return view('classes.create');
    }


    public function store(Request $request)
    {
        $validated = $this->class->validate($request);
        $course = $this->course->where('id',$request->course_id)->first();
        $code = $this->class->generateCode($request->course_id,$request->mode,$request->start_date);
        $date = new DateTime($request->date);
        $date = $date->modify('+'.$course->years." years");
        $end = $date->format('Y-m');
        $class = $this->class->create(['code'=>$code]+$validated+['end_date'=>$end]);
        return redirect()->back()->with('success','Class created successfully');
    }


    public function show($id)
    {
        $class = $this->class->with('course.qualification')->find($id);
        return json_encode($class);
    }


    public function edit($id)
    {
        //
    }

    public function get()
    {
        $classes = $this->class->with('course')->orderBy('id','desc')->get();
        return json_encode($classes);
    }


    public function update(Request $request)
    {
        $validated = $this->class->validate($request);
        $classe = $this->class->with('course')->where('id',$request->class_id)->first();
        $course = $classe->course;
        if ($request->start_date !== $classe->start_date) {
            $date = new DateTime($request->date);
            $date = $date->modify('+'.$course->years." years");
            $end = $date->format('Y-m');
            $classe->update($validated+['end_date'=>$end]);
        }else {
            $classe->update([$validated]);
        }
        return redirect()->back()->with('success','Class updated successfully');
    }


    public function destroy($id)
    {
        $this->class->find($id)->delete();
        return redirect()->back()->with('success', 'Class deleted successfully');
    }
}