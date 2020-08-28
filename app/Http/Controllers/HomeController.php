<?php

namespace App\Http\Controllers;

use App\Information;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $AllFacts = Information::all();
        return view('home',compact('Facts'));
    }

    public function create()
    {
        return view('home');
    }

    public function addnew(Request $request)
    {
        $Facts = new Information();
        $Facts->the_fact = $request->the_fact;
        $Facts->created_by = Auth::user()->id;
        $Facts->save();
        return redirect()->route('home')->with('status', 'New DidYouKnow added successfully.');

    }

    public function delete($id)
    {
        $Facts = Information::find($id);
        $Facts->deleted_at = Carbon::now();
        $Facts->save();
        return redirect()->route('home')->with('status', 'DidYouKnow information deleted successfully.');
    }
}
