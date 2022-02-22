<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Classes;
use Illuminate\Http\Request;

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
            $applications = $this->application->with('class')->where('status','<>','registered')->latest()->get();
        }else {
            $applications = $this->application->with('class')->where('status','<>','registered')->where('user_id',auth()->id())->latest()->get();
        }
        return view('applications.index',compact('applications'));
    }

    public function create()
    {
        $classes = $this->class->where('start_date','>',date('Y-m-d'))->get();
        return view('applications.create', compact('classes'));
    }

    public function store(StoreApplicationRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('kcse_certficate')) {
            $filename = $request->kcse_index_no.strtotime(now()).$request->file('kcse_certficate')->getClientOriginalExtension();
            $kcsepath = $request->file('kcse_certificate')->storeAs('kcse_certificates',$filename);
        }
        if ($request->hasFile('kcse_certficate')) {
            $filename = $request->kcse_index_no.strtotime(now()).$request->file('kcse_certficate')->getClientOriginalExtension();
            $kcsepath = $request->file('kcse_certificate')->storeAs('kcse_certificates',$filename);
        }
        if ($request->hasFile('kcpe_certficate')) {
            $filename = $request->kcse_index_no.strtotime(now()).$request->file('kcpe_certficate')->getClientOriginalExtension();
            $kcpepath = $request->file('kcpe_certificate')->storeAs('kcpe_certificates',$filename);
        }
        $application = $this->application->create(['kcse_certificate' => $kcsepath ?? "", 'kcpe_certificate' => $kcpepath ?? ""]+$validated);
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
        $application = $this->application->with('class')->find($id);
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
