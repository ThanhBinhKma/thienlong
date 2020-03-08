<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Member;
use App\Models\Partner;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$partners = Partner::all();
    	$members  = Member::all();
    	$events = Event::all();
        return view('admin.index',compact('partners','members','events'));
    }
}
