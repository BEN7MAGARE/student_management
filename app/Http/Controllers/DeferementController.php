<?php

namespace App\Http\Controllers;

use App\Models\Deferment;
use Illuminate\Http\Request;

class DeferementController extends Controller
{
    public $deferemnt;
    public function __construct()
    {
        $this->middleware('auth');
        $this->deferment = new Deferment();
    }
    public function index()
    {
        $deferments = $this->deferemnt->with('student')->latest()->get();
        return view('defers.index', compact('deferments'));
    }

    
    public function create()
    {
        return view('defers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
