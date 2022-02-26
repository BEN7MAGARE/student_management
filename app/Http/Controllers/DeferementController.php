<?php

namespace App\Http\Controllers;

use App\Models\Deferment;
use Illuminate\Http\Request;

class DeferementController extends Controller
{
    public $deferment;
    public function __construct()
    {
        $this->middleware('auth');
        $this->deferment = new Deferment();
    }
    public function index()
    {
        if (auth()->user()->type === "administrator") {
            $deferments = $this->deferment->with('student')->latest()->get();
        }else {
            $user = auth()->user();
            $deferments = $user->deferments;;
        }
        return view('defers.index', compact('deferments'));
    }

    
    public function create()
    {
        return view('defers.create');
    }

    public function store(Request $request)
    {
        $deferments = $this->deferment->where('user_id',auth()->id())->where('status','<>','reinstated')->get();
        if ($deferments->count() > 0) {
            return redirect()->back()->withErrors(['You have an active deferment/Application']);
        }
        $validated = $this->deferment->validate($request);
        $deferment = $this->deferment->create(['user_id'=>auth()->id(),'status'=>"pending"]+$validated);
        return redirect()->back()->with('success', 'Deferment stored successfully');
    }

    public function show($id)
    {
        
        
    }

    public function approve($id)
    {
        $deferment = $this->deferment->find($id);
        $deferment->update(['status'=>'approved']);
        // send notification
        return redirect()->back()->with('success','Deferement approved successfully');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
