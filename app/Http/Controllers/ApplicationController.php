<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public $class;
    public $application;
    public function __construct()
    {
        $this->middleware('auth');
        $this->class = new Classes();
        $this->application = new Application();
    }

    public function index()
    {
        if (auth()->user()->type == "administrator") {
            $applications = DB::select("SELECT A.*, B.`code` AS class, B.`start_date`, (SELECT `name` FROM `courses` WHERE `courses`.`id`=(SELECT `course_id` FROM `classes` WHERE `classes`.`id`=A.`id` LIMIT 1)) AS course FROM `applications` A INNER JOIN `classes` B ON A.`class_id`=B.`id` WHERE A.`status`='pending' ORDER BY `A`.`id` DESC");
        }else {
            $user_id = auth()->id();
            $applications = DB::select("SELECT A.*, B.`code` AS class, B.`start_date`, (SELECT `name` FROM `courses` WHERE `courses`.`id`=(SELECT `course_id` FROM `classes` WHERE `classes`.`id`=A.`id` LIMIT 1)) AS course FROM `applications` A INNER JOIN `classes` B ON A.`class_id`=B.`id` WHERE A.`status`='pending' AND A.`user_id`='$user_id' ORDER BY `A`.`id` DESC");
        }
        return view('applications.index',compact('applications'));
    }

    public function create()
    {
        $classes = $this->class->where('start_date','>',date('Y-m-d'))->get();
        return view('applications.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $this->application->validate($request);
        // if ($request->hasFile('kcse_certficate')) {
        //     $filename = $request->kcse_index_no.strtotime(now()).$request->file('kcse_certficate')->getClientOriginalExtension();
        //     $kcsepath = $request->file('kcse_certificate')->store('kcse_certificates/',$filename);
        // }
        if ($request->hasFile('kcse_certficate')) {
            $filename = $request->kcse_index_no.strtotime(now()).$request->file('kcse_certficate')->getClientOriginalExtension();
            $kcsepath = $request->file('kcse_certificate')->storeAs('kcse_certificates/',$filename);
            // $path = Storage::putFileAs('kcse_certificates', $request->file('kcse_certificate'),$filename);
        }
        if ($request->hasFile('kcpe_certficate')) {
            $filename = $request->kcse_index_no.strtotime(now()).$request->file('kcpe_certficate')->getClientOriginalExtension();
            $kcpepath = $request->file('kcpe_certificate')->storeAs('kcpe_certificates',$filename);
            // $path = Storage::putFileAs('kcpe_certificates', $request->file('kcpe_certificate'),$filename);
        }
        $application = $this->application->create(['kcse_certificate' => $kcsepath ?? "", 'kcpe_certificate' => $kcpepath ?? ""]+$validated+['status'=>'pending']);
        return redirect()->back()->with('success','Application was successful you will get an email communication when selected');
    }

    public function select($id)
    {
        $application = $this->application->find($id);
        $application->update(['status'=>"selected"]);
        // send select stuent notification
        return redirect()->back()->with('success','Applicant seected successfully');
    }

    public function show($id)
    {
        $application = DB::select("SELECT A.*, B.`code`, B.`start_date`, (SELECT `name` AS course FROM `courses` WHERE `courses`.`id`=(SELECT `course_id` FROM `classes` WHERE `classes`.`id`=A.`id` LIMIT 1)) AS course FROM `applications` A INNER JOIN `classes` B ON A.`class_id`=B.`id` WHERE A.`id`='$id' LIMIT 1");
        return view('applications.show', compact('application'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $this->application->find($id)->delete();
        return redirect()->back()->with('success', 'Application deleted successfully');
    }
}
